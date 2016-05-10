<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends CommonController {
    public function _initialize (){
        parent::_initialize();
    }
    public function index(){
        $this->display();
    }
    public function startTest(){
        $no = I('get.no');
        $province = $_SESSION['me']['province_id'];

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
        echo 'grade:'.$grade;
        $where['id'] = array('in',$errors);
        $error_question = M("question")->where($where)->select();
    }
    function test(){
        $a = gcookie('person_test_result');
        
    }
}