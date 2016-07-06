<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class SystemController extends CommonController
{
	public function status(){
		$systemStatus = M('system')->where(array('id'=>1))->find();
		$this->assign('systemStatus',$systemStatus);
		$this->display();
	}
	public function ajaxChangeStatus(){
		$data = I('post.');
		if (M('system')->where(array('id'=>1))->save($data)) {
			$result['statusCode'] = "200";
            $result['message']   = "操作成功";
            $result['navTabId'] = "system";
            $result['rel']   = "system";
            $result['callbackType'] = "closeCurrent";
            $result['forwardUrl']   = "";
            $result['confirmMsg'] = "";
            $this->ajaxReturn($result);
        }
	}
	public function ajaxDoAdd(){
		$pattern="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
		$data = I('post.');
		if(!preg_match($pattern,$data['email'])){
            echo "<script>alert('邮箱格式错误!');</script>";
       	}else{
            if($data['password']!=$data['ckpassword']){
            	echo "<script>alert('两次输入的密码不一致!');</script>";
            }
       	}
		if (M('admin')->add($data)) {
			$result['statusCode'] = "200";
            $result['message']   = "操作成功";
            $result['navTabId'] = "addadmin";
            $result['rel']   = "addadmin";
            $result['callbackType'] = "closeCurrent";
            $result['forwardUrl']   = "";
            $result['confirmMsg'] = "";
            $this->ajaxReturn($result);
        }
	}

	public function ajaxDoChange(){
		$aid = $_SESSION['admin']['me']['id'];
		$data = I('post.');
		$oldpasswd = M('admin')->where(array('id'=>$aid))->field('password')->find();
		$oldpwd = md5($data['oldpwd']);
		if($oldpasswd['password'] != $oldpwd){
            echo "<script>alert('原始密码错误!');</script>";
       	}else{
            if($data['password']!=$data['ckpassword']){
            	echo "<script>alert('两次输入的密码不一致!');</script>";
            }
       	}
    	$map['password'] = md5($data['password']);
     	$results = M('admin')->where(array('id'=>$aid))->save($map);
		if ($results) {
			echo "<script>alert('修改成功!');location.href='/admin/Index/logout'</script>";
			// echo "<script>alert('!');</script>";
			// $result['statusCode'] = "200";
   //          $result['message']   = "操作成功";
   //          $result['navTabId'] = "ck";
   //          $result['rel']   = "ck";
   //          $result['callbackType'] = "closeCurrent";
   //          $result['forwardUrl']   = "";
   //          $result['confirmMsg'] = "";
   //          $this->ajaxReturn($result);
        }else{
        	echo "<script>alert('修改失败!新密码不可和原密码相同');history.back();</script>";
        }
	}
}