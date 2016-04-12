<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        
    }

    //注册页面
    public function regist() {
    	$this->display();
    }

    //处理注册数据
    public function saveUser () {
    	$name 		= I('post.name','','string');
    	$email 		= I('post.email','','email');
    	$password 	= I('post.password');
    	$phone 		= I('post.phone','','/^\d{11}$/');
    	$idcard 	= I('post.idcard','','/^\d{17}[0-9x]$/i');
    	$user_id 	= I('post.user_id','','int');
    	if (!$name || !$email || !$password || !$phone || !$idcard) {
    		$this->error('请正确填写信息。');
    	}
 
    	$user 	=	D('User');
    	$data['realname'] = $name;
    	$data['phone'] = $phone;
    	$data['idcard'] = $idcard;
    	$data['email'] = $email;
    	$data['password'] = md5($password);

    	//修改 
    	if ($user_id) {
    		$user->where(array('id'=>$user_id))->save($data);
    		$this->success('修改成功', U('home/index/index'));
    	} else {
    		//注册
    		if (!$user->where(array('idcard'=>$idcard))->find()) {
    			$data['create_time'] = time();
    			$user->add($data);
    			$this->success('注册成功', U('home/index/index'));
    		} else {
    			$this->error('身份证号已经注册，若不是您本人注册请联系管理员。');
    		}
    	}
    }

    //登录页面
    public function login() {
    	$this->display();
    }

    //登录处理
    public function handleLogin() {
    	$password 	= I('post.password');
    	$idcard 	= I('post.idcard','','/^\d{17}[0-9x]$/i');
    	if (!$password || !$idcard) {
    		$this->error('请正确填写信息。');
    	}

    	$user 	=	D('User');
    	if ($user_info = $user->where(array('idcard'=>$idcard, 'password'=>md5($password)))->find()) {
    		$_SESSION['me'] = $user_info;
    		$data['last_login_time'] = time();
    		
    		$user->where(array('id'=>$user_info['id']))->save($data);
    		$this->success('登录成功', U('home/index/index'));
    	} else {
    		$this->error('身份证号或密码错误，请核对后重新登录');
    	}
    }
}