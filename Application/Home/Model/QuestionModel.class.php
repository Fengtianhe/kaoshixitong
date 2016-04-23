<?php
namespace Home\Model;
use Think\Model;
class QuestionModel extends Model {

	function  getInfoById($id) {
		$where['id'] = $id;
		$quesion = $this->getQuestionByWhere($where);
		$question_info = current($question['question']);
		$question_info['question_stem'] = $quesion['stem'][$question_info['id']];
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
}