<?php
namespace Home\Controller;
use Think\Controller;
class PracticeController extends CommonController {
    public function _initialize (){
        parent::_initialize();
    }
    public function index(){
        $this->display();
    }
    public function startPractice(){
        $category = I('get.category');
        $question = D('Question')->getSimpleQuestionByWhere(array('category'=>$category));
        $this->assign('question', $question);
        $this->display();
    }
    public function ajaxGetQuestion(){
        $id = I('post.id');
        $question_info = D('Question')->getInfoById($id);
    	$result['question_info'] = $question_info;
    	$result['status'] = $status;
        $this->ajaxReturn($result);
    }
    public function handlePractice(){
    	//$user_id = I('session.me.id');
    	$user_id 		= $_SESSION['me']['id'];
    	$question_id 	= I('post.id');
    }
}