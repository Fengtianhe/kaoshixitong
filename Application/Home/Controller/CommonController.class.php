<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
    	if (check_replay_login()) {
    		unset($_SESSION['me']);
    		$this->error("您的账号在其他设备登录，若不是本人操作请修改密码或联系管理员",'/');
    	}
	}
}