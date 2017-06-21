<?php
namespace Home\Model;
use Think\Model;
class CompetModel extends Model {
	public function getInfoById($id) {
		$data = $this->where(array('id'=>$id))->find();
		$data['question'] = unserialize($data['question']);
		return $data;
	}
}