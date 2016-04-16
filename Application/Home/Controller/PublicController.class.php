<?php
namespace Home\Controller;
use Home\Controller;
class IndexController extends CommonController {
	public function _initialize (){
		parent::_initialize();
	}
    public function header(){
    	$this->display();
    }
}