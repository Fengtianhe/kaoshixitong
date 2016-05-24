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
		$dan_list = $question->where(array('question_type'=>1))->select();
		$dan_count = count($dan_list);
		$duo_list = $question->where(array('question_type'=>2))->select();
		$duo_count = count($duo_list);
		$this->assign("dan_count",$dan_count);
		$this->assign("duo_count",$duo_count);
		$this->assign("maxtime",$maxtime);
     	$this->display('main');
    }
}