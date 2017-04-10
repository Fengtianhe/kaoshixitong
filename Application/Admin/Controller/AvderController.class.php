<?php
namespace Admin\Controller;
use Think\Controller;
class AvderController extends CommonController {
    public function _initialize(){
        $this->checkLogin();
    }
    public function lists(){
        $limit = 20;
        $pageNum        = I('pageNum', 1);
        $orderField     = I('orderField', 'id');
        $orderDirection = I('orderDirection', 'desc');
        $numPerPage     = I('numPerPage', $limit);
        
        $offset = ($pageNum -1) * $numPerPage;
        if (I('request.id')) {
            $where['id'] = I('request.id');
        }
        if (I('request.images')) {
            $where['images'] = I('request.images');
        }
        if (I('request.desc')) {
            $where['desc'] = I('request.desc');
        }
        if (I('request.flog')) {
            $where['flog'] = I('request.flog');
        }
        if(!$where){
        	$lists = M('Adver')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }else{
        	$lists = M('Adver')->where($where)->order($orderField.' '.$orderDirection)->limit($offset.','.$numPerPage)->select();
        }
   		
        $totalCount  = M('Adver')->where($where)->count('id');
        $page = array('pageNum'=>$pageNum, 'orderField'=>$orderField, 'orderDirection'=>$orderDirection, 'numPerPage'=>$numPerPage, 'totalCount'=>$totalCount);
        $this->assign('page', $page);
        $this->assign('lists', $lists);
        $this->display();
    }
    public function editorAdver(){
        $this->display();
    }
    public function saveAvder(){
        $id = I('request.id', 0);

        $data['desc']              = I('request.desc','');
        $data['flog']             = I('request.flog',0);


        $info=uploadImg('image','sui');
            if ($info['status']=='error') {
                $this->error('上传失败');
            }else{
                $data['img']  = $info['path'];
            }
            
        $id =M('sui')->add($data);
        if($id>0){
            $this->success('插入成功',U('admin/sui/add'),5);
        }else{
            $this->error('插入失败',U('admin/sui/add'),5);
        }


        if ($id) {
            $data['update_time'] = time();
            M('Avder')->where(array('id'=>$id))->save($data);
        } else {
            $data['create_time'] = time();
            $id = M('Avder')->add($data);
        }

        $result['statusCode'] = "200";
        $result['message']   = "修改成功";
        $result['navTabId'] = "subject";
        $result['rel']   = "subject";
        if (I('close_dialog') == 1) {
            $result['callbackType'] = "closeCurrent";
        }
        $result['forwardUrl']   = "";
        $result['confirmMsg'] = "";
        $this->ajaxReturn($result);


        
    }

  

}