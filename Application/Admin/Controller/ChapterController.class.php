<?php
namespace Admin\Controller;
use Think\Controller;
class ChapterController extends CommonController {
    public function _initialize(){
        $this->checkLogin();
    }
    public function lists(){
        
        $this->display();
    }
    public function editorChapter(){
        $this->display();
    }

    

    
}