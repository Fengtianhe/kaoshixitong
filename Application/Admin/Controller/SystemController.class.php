<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class SystemController extends CommonController
{
	public function status(){
		$systemStatus = M('system')->where(array('id'=>1))->find();
		$this->assign('systemStatus',$systemStatus);
		$this->display();
	}
	public function ajaxChangeStatus(){
		$data = I('post.');
		if (M('system')->where(array('id'=>1))->save($data)) {
			$result['statusCode'] = "200";
            $result['message']   = "操作成功";
            $result['navTabId'] = "system";
            $result['rel']   = "system";
            $result['callbackType'] = "closeCurrent";
            $result['forwardUrl']   = "";
            $result['confirmMsg'] = "";
            $this->ajaxReturn($result);
        }
	}
}