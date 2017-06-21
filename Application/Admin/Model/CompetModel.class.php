<?php
namespace Admin\Model;
use Think\Model;
class CompetModel extends Model {
	public function getTestQuestion() {
		//todo  Admin/Home 统一question model 
		$data = D('question')->getTestQuestion(1);
		$data = serialize($data);
		return $data;
	}
}