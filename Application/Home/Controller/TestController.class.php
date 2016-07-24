<?php
namespace Home\Controller;
use Home\Controller;
class TestController extends CommonController {
    public function _initialize (){
        parent::_initialize();
    }
    public function index(){
        $open = M('system')->where(array('id'=>1))->find();
        if ($open['simulation'] == '-1') {
            echo '<script>alert("模拟考试尚未开放");history.back();</script>';
        }else{
            $program=M();
            $strSql="select max(create_time) as max from ks_question ";
            $res=$program->query($strSql);
            $maxtime= $res[0]['max'];

            $question = M('question');
            $dan_list = $question->where(array('question_type'=>1))->select();
            $dan_count = count($dan_list);
            $duo_list = $question->where(array('question_type'=>2))->select();
            $duo_count = count($duo_list);
            $this->assign("dan_count",$dan_count);
            $this->assign("duo_count",$duo_count);
            $this->assign("maxtime",$maxtime);
            $this->display();
        }
    }
    public function startTest(){
        $no = I('get.no');
        $province = $_SESSION['me']['province'];
        scookie('person_test_result',null);
        $question = D('Question')->getTestQuestion($no, $province);
        scookie('person_test', $question);
        $first_question = current($question['radio']);
        $this->assign('first_question', $first_question);
        $this->assign('question', $question);
        $this->display();
    }
    public function ajaxGetQuestion(){
        $id = I('post.id');
        $question_info = D('Question')->getInfoById($id);
    	$result['question_info'] = $question_info;
        $result['question_info']['sn'] = I('post.sn',1);
        $answer = gcookie('person_test_result');
        $result['question_answer'] = isset($answer[$id])? $answer[$id] : array();
    	$result['status'] = $status;
        $this->ajaxReturn($result);
    }
    public function handleTest(){
    	//$user_id = I('session.me.id');
    	//$user_id 		= $_SESSION['me']['id'];
    	$question_id 	= I('post.id');
        $select         = I('post.select');
        $selected       = I('post.selected');
        $type           = I('post.type');
        $answer = gcookie('person_test_result');
        $selected = explode(',', trim($selected,','));
        $answer[$question_id] = array('select'=>$select, 'type'=>$type,'selected'=>$selected);
        scookie('person_test_result',$answer);
        $result['status'] = 'OK';
        $this->ajaxReturn($result);
    }
    public function finishTest(){
        $answer = gcookie('person_test_result');
        $grade = 0;
        foreach($answer as $key=>$value){
            if ($value['select'] == 'error') {
                $errors[] = $key; 
            } else {
                $grade += $value['type'] * 0.5;
            }
        }
        if (is_array($errors) && !empty($errors)) {
            $where['id'] = array('in',$errors);
            $error_question = M("question")->where($where)->select();
            
        }
        $stem = M('question_stem');
        foreach ($error_question as $k => &$v) {
            $map['question_id'] = $v['id'];
            $map['is_true'] = 1;
            $v['true'] = $stem->where($map)->getField('stem_content', true);
            $v['true'] = implode(',',$v['true']);
            $v['tid'] = $k+1;
        }
        //$error_question 是打错的所有题
        $Level = getGradeLevel($grade);
        $this->assign('grade',$grade);
        $this->assign('level',$Level);
        $this->assign('error',$error_question);
        $this->display('finishTest');
    }
    function test(){
        $a = gcookie('person_test_result');
        
    }
}