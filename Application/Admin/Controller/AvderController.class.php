<?php
namespace Admin\Controller;
use Think\Controller;
class AvderController extends CommonController {
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
        if (I('request.images')) {
            $where['images'] = I('request.images');
        }
        if (I('request.desc')) {
            $where['desc'] = I('request.desc');
        }
        if (I('request.flog')) {
            $where['flog'] = I('request.flog');
        }
        if(!$where){
        	$lists = M('Adver')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }else{
        	$lists = M('Adver')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }
   		
        $totalCount  = M('Adver')->where($where)->count('id');
        $page = array('pageNum'=>$pageNum, 'orderField'=>$orderField, 'orderDirection'=>$orderDirection, 'numPerPage'=>$numPerPage, 'totalCount'=>$totalCount);
        $this->assign('page', $page);
        $this->assign('lists', $lists);
        $this->display();
    }
    public function editorAdver(){
        $this->display();
    }
    public function saveAvder(){
        $id = I('request.id', 0);

        $data['desc']              = I('request.desc','');
        $data['flog']             = I('request.flog',0);


       $file = uploadFile('file');
        if (!$file) {
            $this->error('文件出错');
        }
        $data['images']='./Public/'.$file;



        if ($id) {
            $data['update_time'] = time();
            M('Adver')->where(array('id'=>$id))->save($data);
        } else {
            $data['create_time'] = time();
            $id = M('Adver')->add($data);
            redirect(U('admin/index/index'));
        }


        $result['statusCode'] = "200";
        $result['message']   = "修改成功";
        $result['navTabId'] = "adver";
        $result['rel']   = "adver";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);


        
    }
    public function del(){
        $id = I('get.id');
        M('Adver')->where(array('id'=>$id))->delete();
        $result['statusCode'] = "200";
        $result['message']   = "删除成功";
        $result['navTabId'] = "avder";
        $result['rel']   = "avder";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }

  

}