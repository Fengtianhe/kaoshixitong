<?php
namespace Admin\Controller;
use Think\Controller;
class CompetController extends CommonController {
     public $status = array(
        0 => array('id'=>0, 'name'=>'未审核'),
        1 => array('id'=>1, 'name'=>'已审核'),
    );
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
        if (I('request.name')) {
            $where['name'] = I('request.name');
        }
        if (I('request.flag') !== '') {
            $where['flag'] = I('request.flag');
        }
        $lists = M('Compet')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
   		
        $totalCount  = M('Compet')->where($where)->count('id');
        $page = array('pageNum'=>$pageNum, 'orderField'=>$orderField, 'orderDirection'=>$orderDirection, 'numPerPage'=>$numPerPage, 'totalCount'=>$totalCount);
        $this->assign('page', $page);
        $this->assign('lists', $lists);
        $this->assign('status', $this->status);
        $this->display();
    }
    public function editorCompet(){
        $id = I('get.id');
        if ($id) {
            $compet_info = M('Compet')->where(array('id' => $id))->find();
            $this->assign('compet_info',$compet_info);
        }
        $this->display();
    }
    public function saveCompet(){
        $id = I('request.id', 0);

        $data['name']             = I('request.name','');
        $data['flag']             = I('request.flag',0);
        $data['desc']             = I('request.desc','');
        $data['start_time']       = I('request.start_time',0);
        $data['over_time']        = I('request.over_time',0);

        $data['start_time']       = strtotime($data['start_time']);
        $data['over_time']        = strtotime($data['over_time']);

        if ($id) {
            $data['update_time'] = time();
            M('Compet')->where(array('id'=>$id))->save($data);
        } else {
            $data['create_time'] = time();
            $id = M('Compet')->add($data);
        }

        $result['statusCode'] = "200";
        $result['message']   = "修改成功";
        $result['navTabId'] = "compet";
        $result['rel']   = "compet";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }
    public function del(){
        $id = I('get.id');
        M('Compet')->where(array('id'=>$id))->save(array('flag'=>-1));
        $result['statusCode'] = "200";
        $result['message']   = "删除成功";
        $result['navTabId'] = "compet";
        $result['rel']   = "compet";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);
    }

    public function saveQuestion() {
        $id = I('request.id', 0);
        if (!$id) {
            die('error');
        }
        $data['question']       = D('Compet')->getTestQuestion();
        $data['update_time']    = time();
        D('Compet')->where(array('id'=>$id))->save($data);

        $result['statusCode'] = "200";
        $result['message']   = "出题成功";
        $result['navTabId'] = "compet";
        $result['rel']   = "compet";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);

    }
}