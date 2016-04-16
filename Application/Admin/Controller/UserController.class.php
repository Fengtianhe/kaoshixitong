<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    public $user_status = array(
        -1 => array('id'=>0, 'name'=>'开启中'),
        1 => array('id'=>1, 'name'=>'关闭中'),
    );
    public $formal_status = array(
        -1 => array('id'=>0, 'name'=>'未验证'),
        1 => array('id'=>1, 'name'=>'已验证'),
    );
	public function lists(){
        if (I('request.realname')) {
            $where['realname'] = I('request.realname');
        }
        if (I('request.email')) {
            $where['email'] = I('request.email');
        }
        if (I('request.idcard')) {
            $where['idcard'] = I('request.idcard');
        }
        if (I('request.status')) {
            $where['is_del'] = I('request.status');
        }
        if (I('request.fstatus')) {
            $where['formal'] = I('request.fstatus');
        }
        $model = M('user');
        $lists = $model->where($where)->select();
        foreach ($lists as $k => &$v) {
            $v['time_length'] = round($v['time_length']/3600,1); 
        }
        $this->assign('lists',$lists);
        $this->assign('formal_status',$this->formal_status);
        $this->assign('user_status',$this->user_status);
        $this->display();
    }

    /*
    充值功能
     */
    public function topUp(){
        $uid = I('get.uid');
        $userinfo = M('user')->where(array('id' => $uid))->find();
        $this->assign('info',$userinfo);
        $this->display();
    }

    public function doTopUp(){
        $time = intval(I('post.time'));
        $time_s = $time * 3600;
        $uid = I('post.id');
        $info = M('user')->where(array('id'=>$uid))->find();
        $data['update_time'] = time();
        $data['time_length'] = $info['time_length'] + $time_s;
        if (M('user')->where(array('id'=>$uid))->save($data)) {
            $result['statusCode'] = "200";
            $result['message']   = "充值成功";
            $result['navTabId'] = "user";
            $result['rel']   = "user";
            
            $result['callbackType'] = "closeCurrent";
            
            $result['forwardUrl']   = "";
            $result['confirmMsg'] = "";

            $this->ajaxReturn($result);
        }else{
            $this->error('服务器繁忙，充值失败');
        }
    }

    public function ajaxChangeStatus(){
        if (I('get.status')) {
            $data['is_del'] = I('get.status');
        }
        if (I('get.formal')) {
            $data['formal'] = I('get.formal');
            $data['time_length'] = 50 *3600;
        }
        $data['update_time'] = time();
        $id = I('get.id');
        if (M('user')->where(array('id'=>$id))->save($data)) {
            $result['statusCode'] = "200";
            $result['message']   = "修改成功";
            $result['navTabId'] = "user";
            $result['rel']   = "user";
            if (I('close_dialog') == 1) {
                $result['callbackType'] = "closeCurrent";
            }            
            $result['forwardUrl']   = "";
            $result['confirmMsg'] = "";

            $this->ajaxReturn($result);
        }else{
            $this->error('修改失败');
        }
    }
}