<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function _initialize(){
        if (is_mobile_request()) {
            C('DEFAULT_THEME','mobile');
        }
    }
    public function verify_c(){  
        $Verify = new \Think\Verify();  
        $Verify->fontSize = 18;  
        $Verify->length   = 4;  
        $Verify->useNoise = false;  
        $Verify->codeSet = '0123456789';  
        $Verify->imageW = 130;  
        $Verify->imageH = 50;  
        //$Verify->expire = 600;    
        $Verify->entry();  
    }
    public function index(){
        
    }

    //注册页面
    public function regist() {
        $province = M('areas')->where(array('area_type' => 1 ))->select();
        $this->assign('province',$province);
    	$this->display();
    }

    //处理注册数据
    public function saveUser () {
    	$name 		= I('post.name','','string');
    	$email 		= I('post.email','','email');
    	$password 	= I('post.password');
    	$phone 		= I('post.phone','','/^\d{11}$/');
    	$idcard 	= I('post.idcard','','/^\d{17}[0-9x]$/i');
    	$user_id 	= I('post.user_id','','int');
        $province   = I('post.province','','int');
    	if (!$name || !$email || !$password || !$phone || !$idcard) {
    		$this->error('请正确填写信息。');
    	}
 
    	$user 	=	D('User');
    	$data['realname'] = $name;
    	$data['phone'] = $phone;
    	$data['idcard'] = $idcard;
    	$data['email'] = $email;
        $data['province'] = $province;
    	$data['password'] = md5($password);

    	//修改 
    	if ($user_id) {
    		$user->where(array('id'=>$user_id))->save($data);
    		$this->success('修改成功', U('home/index/index'));
    	} else {
    		//注册
    		if (!$list = $user->where(array('idcard'=>$idcard))->find()) {
    			$data['create_time'] = time();
    			$id = $user->add($data);
                D('User_session')->add(array('user_id'=>$id));
                M('user_permission')->add(array('uid'=>$id));
                if (is_mobile_request()) {
                    $this->success('注册成功', U('home/index/index'));
                }else{
                    $this->success('注册成功', U('home/index/index'));
                }
    			
    		} else {
    			$this->error('身份证号已经注册，若不是您本人注册请联系管理员。');
    		}
    	}
    }

    //登录页面
    public function login() {
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
    	$this->display();
    }

    //登录处理
    public function handleLogin() {
    	$password 	= I('post.password');
    	$idcard 	= I('post.idcard','','/^\d{17}[0-9x]$/i');
        $verify = I('param.verify','');
        if(!check_verify($verify)){  
            $this->error("亲，验证码输错了哦！",$this->site_url,3);  
        }
    	if (!$password || !$idcard) {
    		$this->error('请正确填写信息。');
    	}

    	$user 	=	D('User');
    	if ($user_info = $user->where(array('idcard'=>$idcard, 'password'=>md5($password)))->find()) {
            if ($user_info['is_del'] == '1') {
                echo '<script>alert("您的账号无法登陆，请联系管理员");history.back();</script>';
            }elseif($user_info['time_length'] <= 0){
                echo '<script>alert("您的使用时间已到，请充值后再登录");history.back();</script>';
            }else{
                $session_id = session_id();
                $last_login_time = time();
                $ip = $_SERVER['REMOTE_ADDR'];
                //$user_session = D('User_session')->where(array('user_id'=>$user_info['id']))->find();
                //handle_user_session($user_session);
                $data = array('last_login_time'=>$last_login_time, 'last_logout_time'=>$last_login_time, 'session_id'=>$session_id, 'ip'=>$ip);
                D('User_session')->where(array('user_id'=>$user_info['id']))->save($data);
                $_SESSION['me'] = $user_info;
                $_SESSION['me']['session'] = $data;
                $user->where(array('id'=>$user_info['id']))->save(array('last_login_time'=>$last_login_time));
                $this->success('登录成功', U('home/index/index'));
            }
                
    	} else {
    		$this->error('身份证号或密码错误，请核对后重新登录');
    	}
    }

    //用户退出登录
    public function logout() {
        D('User_session')->where(array('user_id'=>$_SESSION['me']['id']))->save(array('last_logout_time'=>time()));
        $_SESSION = array();
        $this->redirect('/');
    }

    //个人中心
    public function center(){
        $info = M('user')->where(array('id'=>$_SESSION['me']['id']))->find();
        $province_id = $info['province'];
        $province = M('areas')->where(array('area_id'=>$province_id))->find();
        $province_name = $province['area_name'];
        $info['province_name'] = $province_name;
        $info['time_length'] = $info['time_length']/3600;
        $this->assign('info',$info);
        $this->display();
    }
}