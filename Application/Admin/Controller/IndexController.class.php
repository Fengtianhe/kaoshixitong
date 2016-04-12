<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	//$this->display('login');

    	$url['xml_url'] = __ROOT__."/Public/admin/dwz.frag.xml";
    	$url['login'] = U('Admin/admin/login');
    	$this->assign('url',$url);
        $this->display();
    }
}