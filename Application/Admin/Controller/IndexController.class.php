<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
	public function verify_c(){  
	    $Verify = new \Think\Verify();  
	    $Verify->fontSize = 18;  
	    $Verify->length   = 4;  
	    $Verify->useNoise = false;  
	    $Verify->codeSet = '0123456789';  
	    $Verify->imageW = 130;  
	    $Verify->imageH = 50;  
	    //$Verify->expire = 600;  
	    $Verify->entry();  
	}

    public function index(){
		if ($_SESSION['admin']['me'] == '' || !$_SESSION['admin']['me']) {
    		$this->display('login');
    	}
    	else {
    		$url['xml_url'] = __ROOT__."/Public/admin/dwz.frag.xml";
	    	$url['login'] = U('Admin/admin/login');
	    	$this->assign('url',$url);
	        $this->display();
    	}
    }
    public function dologin(){
    	$verify = I('param.verify','');  
		if(!check_verify($verify)){  
    		$this->error("亲，验证码输错了哦！",$this->site_url,9);  
		} 
    }
    public function logout(){
    	$_SESSION['admin']['me'] = "";
    	$this->redirect('index');
    }
}