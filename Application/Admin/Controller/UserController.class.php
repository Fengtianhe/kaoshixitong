<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
	public function lists(){
        $model = M('user');
        $lists = $model->select();

        $this->assign('lists',$lists);
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
        $data['time_length'] = $info['time_length'] + $time_s;
        if (M('user')->where(array('id'=>$uid))->save($data)) {
            // $result['statusCode'] = "200";
            // $result['message']   = "修改成功";
            // $result['navTabId'] = "user";
            // $result['rel']   = "user";
            // if(I('close_dialog') == 1){
            //     $result['callbackType'] = "closeCurrent";
            // }
            // $result['forwardUrl']   = "";
            // $result['confirmMsg'] = "";

            // $this->ajaxReturn($result);
            $this->redirect('/Admin/Index/index');
        }else{
            $this->error('服务器繁忙，充值失败');
        }
    }
}