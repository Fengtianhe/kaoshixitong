<?php
namespace Admin\Controller;
use Think\Controller;
class ApiController extends CommonController {
    public function _initialize(){
        $this->checkLogin();
    }

    public function uploadAdImage() {
        $file = uploadFile('file');
        if (!$file) {
            $this->error('文件出错');
        }
        $this->ajaxReturn($file);
    }

  

}