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
        	$lists = M('Avder')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }else{
        	$lists = M('Avder')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }
   		
        $totalCount  = M('Avder')->where($where)->count('id');
        $page = array('pageNum'=>$pageNum, 'orderField'=>$orderField, 'orderDirection'=>$orderDirection, 'numPerPage'=>$numPerPage, 'totalCount'=>$totalCount);
        $this->assign('page', $page);
        $this->assign('lists', $lists);
        $this->display();
    }
  
    
   

    
 
    
}