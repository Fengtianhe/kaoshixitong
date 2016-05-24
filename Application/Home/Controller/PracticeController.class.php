<?php
namespace Home\Controller;
use Home\Controller;
class PracticeController extends CommonController {
    public function _initialize (){
        parent::_initialize();
    }
    public function index(){
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