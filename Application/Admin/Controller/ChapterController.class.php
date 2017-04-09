<?php
namespace Admin\Controller;
use Think\Controller;
class ChapterController extends CommonController {
    public function _initialize(){
        $this->checkLogin();
    }
    public function lists(){
        $limit = 20;
        $pageNum        = I('pageNum', 1);
        $orderField     = I('orderField', 'id');
        $orderDirection = I('orderDirection', 'desc');
        $numPerPage     = I('numPerPage', $limit);
        
        $offset = ($pageNum -1) * $numPerPage;
        if (I('request.id')) {
            $where['id'] = I('request.id');
        }
        if (I('request.subject_id')) {
            $where['subject_id'] = I('request.subject_id');
        }
        if (I('request.name')) {
            $where['subject_name'] = I('request.name');
        }
        if (I('request.flog')) {
            $where['flog'] = I('request.flog');
        }
        if(!$where){
        	$lists = M('Chapter')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }else{
        	$lists = M('Chapter')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }
   		
        $totalCount  = M('Chapter')->where($where)->count('id');
        $page = array('pageNum'=>$pageNum, 'orderField'=>$orderField, 'orderDirection'=>$orderDirection, 'numPerPage'=>$numPerPage, 'totalCount'=>$totalCount);
        $this->assign('page', $page);
        // $this->assign('question_type',$this->question_type);
        // $this->assign('category',$this->question_category);
        $this->assign('lists', $lists);
        $this->display();
    }
    public function editorChapter(){
    	$id = I('get.id');
        if ($id) {
            $chapter_info = M('Chapter')->where(array('id' => $id))->find();
            $this->assign('chapter_info',$chapter_info);
        }
        $this->display();
    }
    public function saveChapter(){
        $id = I('request.id', 0);
        
        $data['name']              = I('request.name','');
        $data['flog']             = I('request.flog',0);
        $data['subject_id']              = I('request.subject_id','');
     	$sid= I('request.subject_id',0);
     	$data['subject_name']=M('Subject')->where(array('id'=>$sid))->find();
       
        if ($id) {
            $data['model_time'] = time();
            M('Chapter')->where(array('id'=>$id))->save($data);
        } else {
            $data['creat_time'] = time();
            $id = M('Chapter')->add($data);
        }

        $result['statusCode'] = "200";
        $result['message']   = "修改成功";
        $result['navTabId'] = "chapter";
        $result['rel']   = "chapter";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }
    public function del(){
        $id = I('get.id');
        M('Chapter')->where(array('id'=>$id))->delete();
        $result['statusCode'] = "200";
        $result['message']   = "删除成功";
        $result['navTabId'] = "chapter";
        $result['rel']   = "chapter";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }

    
 
    
}