<?php
namespace Home\Controller;
use Home\Controller;
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
        $first_question = D('Question')->getInfoById($question[0]['id']);
        $this->assign('question', $question);
        $this->assign('first_question', $first_question);
        $this->display();
    }
    public function ajaxGetQuestion(){
        $id = I('post.id');
        $question_info = D('Question')->getInfoById($id);
    	$result['question_info'] = $question_info;
        $result['question_info']['sn'] = I('post.sn',1);
    	$result['status'] = $status;
        $this->ajaxReturn($result);
    }
    public function handlePractice(){
    	$user_id 		= $_SESSION['me']['id'];
    	$question_id 	= I('post.id');
    }

    /**
     * 免费体验
     * @return [type] [description]
     */
    public function free(){
        $question = D('Question')->getFreeQuestion();
        $first_question = D('Question')->getInfoById($question[0]['id']);
        $this->assign('question', $question);
        $this->assign('first_question', $first_question);
        $this->display('startPractice');
    }
}