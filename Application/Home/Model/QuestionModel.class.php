<?php
namespace Home\Model;
use Think\Model;
class QuestionModel extends Model {

	function  getInfoById($id) {
		$where['id'] = $id;
		$question = $this->getQuestionByWhere($where);
		$question_infos = $question['question'];
		$question_info = current($question_infos);
		$question_info['question_stem'] = $question['stem'][$question_info['id']];
		return $question_info;
	}
	function getQuestionByWhere($where)
	{
		$question = $this->where($where)->select();
		foreach ($question as $key=>$value) {
			$ids[] = $value['id'];
		}
		$stem_where['question_id'] = array('in',$ids);
		$question_stem = D('Question_stem')->where($stem_where)->select();
		foreach ($question_stem as $qvalue) {
			$stems[$qvalue['question_id']][] = $qvalue;
		}
		$result = array('question'=>$question, 'stem'=>$stems);
		return $result;
	}
	function getSimpleQuestionByWhere($where) {
		$question = $this->where($where)->select();
		return $question;
	}
}