<?php
namespace Home\Model;
use Think\Model;
class UserResultModel extends Model {

	protected $tableName = 'user_result_0'; //默认使用第一个表的结构

	/**
	 * 保存答题记录
	 * @Author   Maying
	 * @DateTime 2017-04-18
	 * @E-mail   1977905246@qq.com
	 * @param    [type]            $user_id     [description]
	 * @param    [type]            $question_id [description]
	 * @param    [type]            $answer      [description]
	 * @return   [type]                         [description]
	 */
	public function saveResult($user_id, $question_id,$answer) {
		$tableName = $this->getTable($user_id);
		$info =  $this->getResultInfo($user_id, $question_id);
		$data['is_true'] = ($answer['select']=='ok')?1:0;
		$data['result'] = serialize($answer);
		if (is_array($info) && !empty($info)) {
			$data['update_time'] = date('Y-m-d H:i:s');
			$this->table($tableName)->where(array('user_id'=>$user_id, 'question_id'=>$question_id))->save($data);
			echo $this->getLastSql();
		} else {
			$data['question_id'] = $question_id;
			$data['user_id'] 	 = $user_id;
			$data['create_time'] = $data['update_time'] = date('Y-m-d H:i:s');
			$this->table($tableName)->add($data);
		}
		return true;
	}
	public function getResult($user_id, $question_id=0) {
		$result = array();
		$info = $this->getResultInfo($user_id, $question_id);
		if (is_array($info) && !empty($info)) {
			$result = unserialize($info['result']);
		}
		return $result;
	}
	public function  getResultInfo($user_id, $question_id=0) {
		$tableName = $this->getTable($user_id);
		$data 	   = $this->table($tableName)->where(array('user_id'=>$user_id, 'question_id'=>$question_id))->limit(1)->find();
		return $data;
	}

	/**
	 * 获取用户表
	 * @Author   Maying
	 * @DateTime 2017-04-18
	 * @E-mail   1977905246@qq.com
	 * @param    [type]            $user_id [description]
	 * @return   [type]                     [description]
	 */
	public function getTable($user_id) {
		if (!$user_id) {
			return false;
		}
		$sn = $user_id % 32;
		return 'ks_user_result_'.$sn;
	}

	/**
	 * 获取用户答题记录
	 * @Author   Maying
	 * @DateTime 2017-04-18
	 * @E-mail   1977905246@qq.com
	 * @param    $user_id [description]
	 * @return   array()
	 */
	public function getUserResult($user_id) {
		$result = array();
		if (!$user_id) {
			return $result;
		}
		$tableName = $this->getTable($user_id);
		$data 	   = $this->table($tableName)->where(array('user_id'=>$user_id))->select();
		if (is_array($data) && !empty($data)) {
			foreach($data as $v) {
				$result[$v['question_id']] = unserialize($v['result']);
			}
		}
		return $result;
	}

}