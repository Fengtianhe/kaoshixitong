<?php
namespace Admin\Controller;
use Think\Controller;
class SubjectController extends CommonController {
    public function _initialize(){
        $this->checkLogin();
    }
    public function lists(){
        echo 123;
        $this->display();
    }
    

    

    
}