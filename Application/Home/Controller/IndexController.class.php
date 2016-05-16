<?php
namespace Home\Controller;
use Home\Controller;
class IndexController extends CommonController {
	public function _initialize (){
		parent::_initialize();
	}
    public function index(){
    	$program=M();
		$strSql="select max(create_time) as max from ks_question ";
		$res=$program->query($strSql);
		$maxtime= $res[0]['max'];

		$question = M('question');
		// $dan_list = $question->where(array(''))->find();
		$this->assign("maxtime",$maxtime);
     	$this->display('main');
    }
}