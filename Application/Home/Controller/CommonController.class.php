<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
        header("Content-type: text/html; charset=utf-8");
    	if (is_mobile_request()) {
    		C('DEFAULT_THEME','mobile');
    	}
    	if (!isset($_SESSION['me'])) {
    		$this->redirect('home/user/login');
    	}
        $this->verifyLogin();
    	$this->check_last_login();
	}

    public function verifyLogin(){
        $uid = $_SESSION['me']['id'];
        $user = D('user');
        $user_info = $user->where(array('id'=>$uid))->find();
        if($user_info['is_del'] == 1){
            echo '<script>alert("您的账号无法登陆，请联系管理员");window.location.href = "/home/user/logout";</script>';
        }
        //if($user_info['formal'] == -1){
            // $this->redirect(U('home/practice/free'));
         //   $this->display('Index/main');
        //}else
        if ($user_info['time_length'] <= 0) {
            echo '<script>alert("您的使用时间已到，请充值后再登录");window.location.href = "/home/user/logout";</script>';
        }
    }
    /**
     * 判断当前用户是否在其他设备登录,记录当前操作为最后操作 10分钟自动下线
     * @return bool true 
     */
    public function check_last_login() {
        $time = time();
        $user_session = M('user_session')->where(array('user_id'=>$_SESSION['me']['id']))->find();
        if ($_SESSION['me']['session']['session_id'] != $user_session['session_id']) {
            $_SESSION = array();
            $this->error("您的账号在其他设备登录，若不是本人操作请修改密码或联系管理员",'home/user/login');
        }
        if ($user_session['last_logout_time'] < $time - 600) {
            $_SESSION = array();
            $this->error("登录失效，请重新登录",'home/user/login');
        } else {
            $time_length = $time - $user_session['last_logout_time'];
            D('User')->where(array('id'=>$_SESSION['me']['id']))->setDec('time_length',$time_length);
            $data['last_logout_time'] = $time;
            D('User_session')->where(array('user_id'=>$_SESSION['me']['id']))->save($data);
        }
        return true;
    }
}