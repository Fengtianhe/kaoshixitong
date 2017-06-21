<?php
namespace Home\Model;
use Think\Model;
class CompetResultModel extends Model {

	//判断用户是否参与过竞赛
	public function checkUserIsJoin($user_id, $compet_id) {
		$data = $this->where(array('user_id'=>$user_id, 'compet_id'=>$compet_id))->find();
		if (is_array($data) && !empty($data)) {
			return true;
		} 
		return false;
	}

	//保存用户竞赛答案
	public function saveUserResult($user_id, $compet_id, $score, $answer) {
		$id = 0;
		$isJoin = $this->checkUserIsJoin($user_id, $compet_id);
		if (!$isJoin) {
			$answer = serialize($answer);
			$data = array('user_id'=>$user_id, 'compet_id'=>$compet_id, 'score'=>$score, 'answer'=>$answer);
			$id = $this->add($data);
		}
		
		return $id;
	}
}