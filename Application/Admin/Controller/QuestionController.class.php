<?php
namespace Admin\Controller;
use Think\Controller;
class QuestionController extends CommonController {
	public function lists(){
        if (I('request.id')) {
            $where['id'] = I('request.id');
        }
        if (I('request.title')) {
            $where['title'] = I('request.title');
        }
        if (I('request.type')) {
            $where['type'] = I('request.type');
        }
        if (I('request.category')) {
            $where['category'] = I('request.category');
        }
        $model = M('Question');
        $lists = $model->where($where)->select();
        $this->assign('lists',$lists);
        $this->display();
    }

    /*
    充值功能
     */
    public function editorQuestion(){
        $id = I('get.id');
        if ($id) {
            $question_info = M('Question')->where(array('id' => $id))->find();
            $this->assign('info',$userinfo);
        }
        $this->display();
    }
    public function saveQuestion(){
        $id = I('request.id', 0);
        
        $data['title']              = I('request.title','');
        $data['question_type']      = I('request.question_type',0);
        $data['category']           = I('request.category',0);
        $data['province']           = I('request.province',0);
        $data['explain']            = I('request.explain',0);
        $data['stem_content']       = I('request.stem_content',0);
        $data['answer']             = I('request.answer',0);
        foreach ($data as $key=>$value) {
            if (!$value) {
                unset($data[$key]);
            }
        }
        $stem_content = explode("\r\n", trim($data['stem_content']));
        $answer = explode(",", str_replace("，", ",", $data['answer']));
        unset($data['stem_content']);
        unset($data['answer']);
        if ($data['question_type'] == '3') {
            $data['is_true'] = current($answer);
        }
        if ($id) {
            $data['update_time'] = time();
            M('Question')->where(array('id'=>$id))->save($data);
            if (is_array($stem_content) && !empty($stem_content)) {
                /*foreach($stem_content as $key=>$value) {
                    $item['stem_content'] = $value;
                    $item['sn']  =$key+1;
                    if (in_array($key+1, $answer)) {
                        $item['is_true'] = 1;
                    } else {
                        $item['is_true'] = 0;
                    }
                    
                    $item['question'] = $id;
                    
                }*/
            }   
        } else {
            $data['create_time'] = time();
            $id = M('Question')->add($data);
            if (is_array($stem_content) && !empty($stem_content)) {
                foreach($stem_content as $key=>$value) {
                    if (!$value) continue;
                    $item['stem_content'] = $value;
                    $item['sn']  =$key+1;
                    if (in_array($key+1, $answer)) {
                        $item['is_true'] = 1;
                    } else {
                        $item['is_true'] = 0;
                    }
                    $item['question_id'] = $id;
                    M('question_stem')->add($item);
                }
            } 
        }

        $result['statusCode'] = "200";
        $result['message']   = "修改成功";
        $result['navTabId'] = "question";
        $result['rel']   = "question";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }
}