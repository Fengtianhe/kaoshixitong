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
}