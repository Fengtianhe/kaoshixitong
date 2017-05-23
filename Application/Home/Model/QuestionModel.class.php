<?php
namespace Home\Model;
use Think\Model;
class QuestionModel extends Model {

	function  getInfoById($id) {
		$where['id'] = $id;
		$question = $this->getQuestionByWhere($where);
		$question_infos = $question['question'];
		$question_info = current($question_infos);
		if ($question_info['question_type'] == 3) {
			$question_stem = array(
					array(
						'sn' 		=> 1,
						'is_true' 	=> $question_info['is_true'] ? 1 : 0 ,
						'stem_content' => "是"
						),
					array(
						'sn' 		=> 0,
						'is_true' 	=> $question_info['is_true'] ? 0 : 1 ,
						'stem_content' => "否"
						)
				);
		} else {
			$question_stem = $question['stem'][$question_info['id']];
			shuffle($question_stem);
		}
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
	function getSimpleQuestionInIds($where){
		$where['id']=array('in',$where);
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
		$question = $this->where($where)->limit($offset, $limit)->field('id')->select();
		return $question;
	}
	/**
	 * 单选或多选 100道
	 * @return array()
	 */
	function getFreeQuestion($type){
		$where['category'] = 3;
		$where['question_type'] = $type;
		$question = $this->getSimpleQuestionByWhere($where,0,100);
		return $question;
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

				//科目1 判断
				$where_one_truefalse['category'] = 1;
				$where_one_truefalse['question_type'] = 3;
				//科目2 判断
				$where_two_truefalse['category'] = 2;
				$where_two_truefalse['question_type'] = 3;
				
				
				break;
			//试卷二
			case 2:
				//科目3 单选
				$where_one_radio['category'] = 3;
				$where_one_radio['question_type'] = 1;
				//科目4 单选
				$where_two_radio['category'] = 4;
				$where_two_radio['question_type'] = 1;
				$where_two_radio['province_id'] = $province;

				//科目3 多选
				$where_one_checkbox['category'] = 3;
				$where_one_checkbox['question_type'] = 2;
				//科目4 多选
				$where_two_checkbox['category'] = 4;
				$where_two_checkbox['question_type'] = 2;
				$where_two_checkbox['province_id'] = $province;

				//科目1 判断
				$where_one_truefalse['category'] 		= 3;
				$where_one_truefalse['question_type'] 	= 3;
				//科目2 判断
				$where_two_truefalse['category'] 		= 4;
				$where_two_truefalse['question_type'] 	= 3;
				$where_two_truefalse['province_id'] 	= $province;
				break;
		}
		$one_radio = $this->getSimpleQuestionByWhere($where_one_radio,$offset,$limit);
		$two_radio = $this->getSimpleQuestionByWhere($where_two_radio,$offset,$limit);
		$one_checkbox = $this->getSimpleQuestionByWhere($where_one_checkbox,$offset,$limit);
		$two_checkbox = $this->getSimpleQuestionByWhere($where_two_checkbox,$offset,$limit);

		$one_truefalse = $this->getSimpleQuestionByWhere($where_one_truefalse,$offset,$limit);
		$two_truefalse = $this->getSimpleQuestionByWhere($where_two_truefalse,$offset,$limit);
		//随机打乱之后获取目标题
		shuffle($one_radio);
		shuffle($two_radio);
		shuffle($one_checkbox);
		shuffle($two_checkbox);
		shuffle($one_truefalse);
		shuffle($two_truefalse);
		$first_radio = array_slice($one_radio,0,40);
		$second_radio = array_slice($two_radio,0,40);
		$first_checkbox = array_slice($one_checkbox,0,15);
		$second_checkbox = array_slice($two_checkbox,0,15);
		$first_truefalse = array_slice($one_truefalse,0,15);
		$second_truefalse = array_slice($two_truefalse,0,15);
		$all_radio = array_merge($first_radio,$second_radio);
		$all_checkbox = array_merge($first_checkbox,$second_checkbox);
		$all_truefalse = array_merge($first_truefalse,$second_truefalse);
		shuffle($all_radio);
		shuffle($all_checkbox);
		shuffle($all_truefalse);
		$result['radio'] = $all_radio;
		$result['checkbox'] = $all_checkbox;
		$result['truefalse'] = $all_truefalse;
		return $result;
	}
}