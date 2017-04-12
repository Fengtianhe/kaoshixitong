<?php
namespace Admin\Controller;
use Think\Controller;
class ContactController extends CommonController {
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
        if (I('request.way')) {
            $where['way'] = I('request.way');
        }
        if (I('request.flog')) {
            $where['flog'] = I('request.flog');
        }
        if(!$where){
        	$lists = M('Contact')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }else{
        	$lists = M('Contact')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }
   		
        $totalCount  = M('Contact')->where($where)->count('id');
        $page = array('pageNum'=>$pageNum, 'orderField'=>$orderField, 'orderDirection'=>$orderDirection, 'numPerPage'=>$numPerPage, 'totalCount'=>$totalCount);
        $this->assign('page', $page);
        $this->assign('lists', $lists);
        $this->display();
    }
    public function editorContact(){
        $this->display();
    }
    public function saveContact(){
        $id = I('request.id', 0);

        $data['way']              = I('request.way','');
        $data['flog']             = I('request.flog',0);
        $data['images']           = I('request.image','');

        if ($id) {
            $data['update_time'] = time();
            M('Contact')->where(array('id'=>$id))->save($data);
        } else {
            $data['create_time'] = time();
            $id = M('Contact')->add($data);
        }

        $result['statusCode'] = "200";
        $result['message']   = "修改成功";
        $result['navTabId'] = "contact";
        $result['rel']   = "contact";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }
    public function del(){
        $id = I('get.id');
        M('Contact')->where(array('id'=>$id))->delete();
        $result['statusCode'] = "200";
        $result['message']   = "删除成功";
        $result['navTabId'] = "contact";
        $result['rel']   = "contact";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }
}