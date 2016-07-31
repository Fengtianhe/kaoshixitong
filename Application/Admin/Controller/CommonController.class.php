<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function index(){
        $this->display();
    }
    public function _initialize(){
        header("Content-type: text/html; charset=utf-8");
    }
    public function checkLogin(){
    	if (!$_SESSION['admin']['me']['id']) {
    		die('用户登录信息失效，请刷新后再试');
    	}
    }
}