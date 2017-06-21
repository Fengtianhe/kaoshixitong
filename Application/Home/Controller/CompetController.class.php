<?php
namespace Home\Controller;
use Home\Controller;
class CompetController extends CommonController {
	public function _initialize (){
		parent::_initialize();
	}
    public function index(){
    	
    }

    public function startCompet () {
    	$id = I('get.id',0);
        $user_id      = $_SESSION['me']['id'];
        $isJoin = D('CompetResult')->checkUserIsJoin($user_id, $id);
        if ($isJoin) {
            $this->error('您已经参加过本次竞赛啦！', '/home/index/index');
        }
        $filekey        = 'person_compet_result_'.$id.'_'.$user_id;
        F($filekey,null);
    	$compet = D('Compet')->getInfoById($id);
        $question = $compet['question'];
        unset($compet['question']);
        $first_question = current($question['radio']);
        $this->assign('info', $compet);
        $this->assign('first_question', $first_question);
        $this->assign('question', $question);
        $this->display();
    }

    public function ajaxGetQuestion(){
        $user_id        = $_SESSION['me']['id'];
        $compet_id      = I('post.compet_id');
        $id             = I('post.id');
        $question_info  = D('Question')->getInfoById($id);
        $result['question_info'] = $question_info;
        $result['question_info']['sn'] = I('post.sn',1);

        $filekey        = 'person_compet_result_'.$compet_id.'_'.$user_id;
        $answer         = F($filekey);
        $result['question_answer'] = isset($answer[$id])? $answer[$id] : array();
        $result['status'] = $status;
        $this->ajaxReturn($result);
    }

    public function handleTest(){
        $user_id      = $_SESSION['me']['id'];
        $compet_id      = I('post.compet_id');
        $question_id    = I('post.id');
        $select         = I('post.select');
        $selected       = I('post.selected');
        $type           = I('post.type');
        $filekey        = 'person_compet_result_'.$compet_id.'_'.$user_id;
        $answer = F($filekey);
        $selected = explode(',', trim($selected,','));
        $answer[$question_id] = array('select'=>$select, 'type'=>$type,'selected'=>$selected);
        F($filekey ,$answer);
        $result['status'] = 'OK';
        $this->ajaxReturn($result);
    }
    public function finishTest(){
        $user_id        = $_SESSION['me']['id'];
        $compet_id      = I('get.compet_id');
        $filekey        = 'person_compet_result_'.$compet_id.'_'.$user_id;
        $answer = F($filekey);
        $grade = 0;
        foreach($answer as $key=>$value){
            if ($value['select'] == 'error') {
                $errors[] = $key; 
            } else {
                if ($value['type'] == 3 || $value['type'] == 1) {
                    $grade += 0.5; //单选判断 0.5
                } else {
                    $grade += 1.5; //多选 1.5
                }
            }
        }
        if (is_array($errors) && !empty($errors)) {
            $where['id'] = array('in',$errors);
            $error_question = M("question")->where($where)->select();
            
        }
        $stem = M('question_stem');
        foreach ($error_question as $k => &$v) {
            if ($v['question_type'] == 3) {
                $v['true'] = $v['is_true'] ? "是" : "否";
            } else {
                $map['question_id'] = $v['id'];
                $map['is_true'] = 1;
                $v['true'] = $stem->where($map)->getField('stem_content', true);
                $v['true'] = implode(',',$v['true']);
            }
            $v['tid'] = $k+1;
        }
        $Level = getGradeLevel($grade);

        D('CompetResult')->saveUserResult($user_id, $compet_id, $grade, $answer);
        F($filekey, null);
        $this->assign('grade',$grade);
        $this->assign('level',$Level);
        $this->assign('error',$error_question);
        $this->display('finishTest');
    }
}