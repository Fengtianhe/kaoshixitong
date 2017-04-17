<?php
namespace Home\Controller;
use Home\Controller;
class PracticeController extends CommonController {
    public function _initialize (){
        parent::_initialize();
    }
    public function index(){
        
        $open = M('system')->where(array('id'=>1))->find();
        if ($open['practice'] == '-1') {
            echo '<script>alert("练习模式尚未开放");history.back();</script>';
        }else{


            $where['flog']=1;
            $category=M('subject')->where($where)->field('id,name')->select();

            $program=M();
            $strSql="select max(create_time) as max from ks_question ";
            $res=$program->query($strSql);
            $maxtime= $res[0]['max'];

            $question = M('question');
            $dan_list = $question->where(array('question_type'=>1))->select();
            $dan_count = count($dan_list);
            $duo_list = $question->where(array('question_type'=>2))->select();
            $duo_count = count($duo_list);
            $this->assign("category",$category);
            $this->assign("dan_count",$dan_count);
            $this->assign("duo_count",$duo_count);
            $this->assign("maxtime",$maxtime);
            $this->display();
        }
    }
    public function beforeStartPractice(){
        $program=M();
        $strSql="select max(create_time) as max from ks_question ";
        $res=$program->query($strSql);
        $maxtime= $res[0]['max'];
        $this->assign("maxtime",$maxtime);
        $open = $this->verityOpen();
        
        if ($open == '-1') {
            echo "<script>alert('此章节尚未开放，请联系管理员！');history.back();</script>";
        }
        else{
           $permission = $this->verifyPermission();
            if ($permission == '-1') {
                echo "<script>alert('您对此章节无权限，请联系管理员！');history.back();</script>";
            }else{
                $where['flog']=1;
                $where['subject_id']=I('get.category');
                $chapter=M('chapter')->where($where)->field('id,name')->select();
                $this->assign('chapter',$chapter);
                $this->assign('category',I('get.category'));
                $this->display();
            } 
        }
    }
    public function selectQuestionType(){
        $program=M();
        $strSql="select max(create_time) as max from ks_question ";
        $res=$program->query($strSql);
        $maxtime= $res[0]['max'];
        $this->assign("maxtime",$maxtime);
        $this->assign('category',I('get.category'));
        $this->assign('chapter',I('get.chapter'));
        $this->display();
    }
    public function startPractice(){

        $user_info = $_SESSION['me'];
        $category = I('get.category',1);
        $chapter = I('get.chapter',1);
        $questionType = I('get.question_type',1);
        $where = array('category'=>$category,'chapter'=>$chapter,'question_type'=>$questionType);
        if ($category == 4) {
            $where['province_id'] = $user_info['province'];
        }
        $question = D('Question')->getSimpleQuestionByWhere($where);
        //
        // switch ($category) {
        //     case 1 :
        //         $field = 'one_result';
        //         break;
        //     case 2 :
        //         $field = 'two_result';
        //         break;
        //     case 3 :
        //         $field = 'three_result';
        //         break;
        //     case 4 :
        //         $field = 'four_result';
        //         break;

        // }
        // $user_result = D('user_result')->where('user_id = '.$_SESSION['me']['id'])->find();
        // if (!$user_result) {
        //     $result_id = D('user_result')->add(array('user_id'=>$_SESSION['me']['id']));
        //     $results = array();
        // } else {
        //     $result_id = $user_result['id'];
        //     $results = unserialize($user_result[$field]);
        // }

        $results = D('UserResult')->getUserResult($_SESSION['me']['id']);

        //
        $first_question = D('Question')->getInfoById($question[0]['id']);
        $this->assign('question', $question);
        $this->assign('results', $results);
        $this->assign('first_question', $first_question);
        $this->display();
    }
    public function ajaxGetQuestion(){
        $id = I('post.id');
        $question_info = D('Question')->getInfoById($id);
    	$result['question_info'] = $question_info;
        $result['question_info']['sn'] = I('post.sn',1);
    	$result['status'] = 'ok';

        $question_result = D('UserResult')->getResult($_SESSION['me']['id'], $id);
        $result['question_answer'] = $question_result;
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
        $type = I('get.type',0);
        $question = D('Question')->getFreeQuestion($type);
        $first_question = D('Question')->getInfoById($question[0]['id']);
        $this->assign('question', $question);
        $this->assign('first_question', $first_question);
        $this->display('startPractice');
    }

    public function ajaxHandle(){
        $question_id    = I('post.id');
        $select         = I('post.select');
        $selected       = I('post.selected');
        $type           = I('post.type');

        $question_info = D('Question')->where('id = '.$question_id)->find(); 

        $selected = explode(',', trim($selected,','));
        $answer = array('select'=>$select, 'type'=>$type,'selected'=>$selected);
        D('UserResult')->saveResult($_SESSION['me']['id'], $question_id,$answer);
        $result['status'] = 'OK';
        $result['answer'] = json_encode($answer);
        $this->ajaxReturn($result);

    }

    /**
    *  权限验证
    */
    private function verifyPermission(){
        $uid = $_SESSION['me']['id'];
        $num = I('get.category');
        $category = 'course_'.$num;
        $result = M('user_permission')->where(array('uid'=>$uid))->find();
        return $result[$category];
    }

    /**
    *  章节开关验证
    */
    private function verityOpen(){
        $num = I('get.category');
        $category = 'practice_child'.$num;
        $result = M('system')->where(array('id'=>1))->find();
        return $result[$category];
    }
}