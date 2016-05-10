<?php 

/**
 * 判断当前用户是否在其他设备登录
 * @return bool true 在其他设备登录 false 正常
 */
function check_replay_login() {
	if (isset($_SESSION['me']['replay_login'])) {
		return true;
	} else {
		return false;
	}
}

/**
 * 处理其他用户session
 * @param  array $user_session 之前用户session
 * @return bool
 */
function handle_user_session($user_session) {
	$sessionpath = session_save_path();
	$user_sessionfile = $sessionpath."/sess_".$user_session['session_id'];
	$activetime = file_exists($user_sessionfile) ? intval(filemtime($user_sessionfile)) : 0;
	if ($activetime) {
		$time_length = $activetime - $user_session['last_login_time'];
	} else if($user_session['last_logout_time'] > $user_session['last_login_time']) {
		$time_length = $user_session['last_logout_time'] - $user_session['last_login_time'];
	} else {
		$time_length = 1800;
	}
	if ($user_session['session_id']) {
		D('User')->where(array('id'=>$user_session['user_id']))->setDec('time_length',$time_length);
	}
	
	$content = file_get_contents($user_sessionfile);
	if ($content) {
		$session_data = 'me|'.serialize(array('replay_login'=>1));
		file_put_contents($user_sessionfile, $session_data);
	}
	return true;
}

/**
 * 设置cookie
 * @return bool
 */
function scookie($name,$value){
	$value = json_encode($value);
	cookie($name,$value);
	return true;
}
/**
 * 获取cookie
 * @return array value
 */
function gcookie($name){
	$value = cookie($name);
	return json_decode($value, true);
}