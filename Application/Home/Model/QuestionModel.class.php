<?php
namespace Home\Model;
use Think\Model;
class QuestionModel extends Model {

	function  getInfoById($id) {
		$where['id'] = $id;
		$question = $this->getQuestionByWhere($where);
		$question_infos = $question['question'];
		$question_info = current($question_infos);
		$question_stem = $question['stem'][$question_info['id']];
		shuffle($question_stem);
		$question_info['question_stem'] = $question_stem;
		return $question_info;
	}
	function getQuestionByWhere($where)
	{
		$question = $this->where($where)->select();
		if (is_array($question) && !empty($question)) {
			foreach ($question as $key=>$value) {
				$ids[] = $value['id'];
			}
			$stem_where['question_id'] = array('in',$ids);
			$question_stem = D('Question_stem')->where($stem_where)->select();
			foreach ($question_stem as $qvalue) {
				$stems[$qvalue['question_id']][] = $qvalue;
			}
			
		} else {
			$question = array();
			$stems = array();
		}
		$result = array('question'=>$question, 'stem'=>$stems);
		return $result;
	}
	function getSimpleQuestionByWhere($where,$offset=0,$limit=0) {
		$question = $this->where($where)->limit($offset, $limit)->select();
		return $question;
	}
	/**
	 * 单选 多选 各50道
	 * @return array()
	 */
	function getFreeQuestion(){
		$where['category'] = 3;
		$where['question_type'] = 1;
		$radio_question = $this->getSimpleQuestionByWhere($where,0,50);
		$where['question_type'] = 2;
		$checkbox_question = $this->getSimpleQuestionByWhere($where,0,50);
		return  array_merge($radio_question, $checkbox_question);
	}

	function getTestQuestion($no, $province = 0){
		$offset = 0;
		$limit = 1000;
		switch($no) {
			//试卷一
			case 1:
				//科目1 单选
				$where_one_radio['category'] = 1;
				$where_one_radio['question_type'] = 1;

				//科目2 单选
				$where_two_radio['category'] = 2;
				$where_two_radio['question_type'] = 1;
				

				//科目1 多选
				$where_one_checkbox['category'] = 1;
				$where_one_checkbox['question_type'] = 2;
				

				//科目2 多选
				$where_two_checkbox['category'] = 2;
				$where_two_checkbox['question_type'] = 2;
				
				
				break;
			//试卷二
			case 2:
				//科目3 单选
				$where_one_radio['category'] = 3;
				$where_one_radio['question_type'] = 1;

				//科目4 多选
				$where_two_radio['category'] = 4;
				$where_two_radio['question_type'] = 1;
				$where_two_radio['province_id'] = $province;

				//科目3 单选
				$where_one_checkbox['category'] = 3;
				$where_one_checkbox['question_type'] = 2;

				//科目4 多选
				$where_two_checkbox['category'] = 4;
				$where_two_checkbox['question_type'] = 2;
				$where_two_checkbox['province_id'] = $province;
				break;
		}
		$one_radio = $this->getSimpleQuestionByWhere($where_one_radio,$offset,$limit);
		$two_radio = $this->getSimpleQuestionByWhere($where_two_radio,$offset,$limit);
		$one_checkbox = $this->getSimpleQuestionByWhere($where_one_checkbox,$offset,$limit);
		$two_checkbox = $this->getSimpleQuestionByWhere($where_two_checkbox,$offset,$limit);
		//随机打乱之后获取目标题
		shuffle($one_radio);
		shuffle($two_radio);
		shuffle($one_checkbox);
		shuffle($two_checkbox);
		$first_radio = array_slice($one_radio,0,30);
		$second_radio = array_slice($two_radio,0,30);
		$first_checkbox = array_slice($one_checkbox,0,35);
		$second_checkbox = array_slice($two_checkbox,0,35);
		$all_radio = array_merge($first_radio,$second_radio);
		$all_checkbox = array_merge($first_checkbox,$second_checkbox);
		shuffle($all_radio);
		shuffle($all_checkbox);
		$result['radio'] = $all_radio;
		$result['checkbox'] = $all_checkbox;
		return $result;
	}
}