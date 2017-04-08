<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>考核系统管理平台</title>
<link href="/Public/admin/themes/css/login.css" rel="stylesheet" type="text/css" />
<script src="/Public/admin/js/jquery-1.7.2.js" type="text/javascript"></script>
</head>
<body>
	<div id="login">
		<div id="login_content">
			<div class="login_title">
				<img src="/Public/admin/themes/default/images/ksxtglpt.png" width="100%" height="5%">
			</div>
			<div class="loginForm">
				<form action="/Admin/Index/dologin" method="post">
					<p>
						<label>邮箱：</label>
						<input type="email" name="email" size="20" class="login_input" />
					</p>
					<p>
						<label>密码：</label>
						<input type="password" name="password" size="20" class="login_input" />
					</p>
					<p class="top15 captcha" id="captcha-container"> 
						<label>验证码：</label>
						<input name="verify" width="50%" height="50" class="captcha-text" placeholder="验证码" type="text"> 
						<span><img width="50%" class="left15 verify_img" height="50" alt="验证码" src="<?php echo U('Admin/Index/verify_c',array());?>" title="点击刷新"> </span>
					</p>
					<div class="login_bar">
						<input class="sub" type="submit" value=" " onclick="validateCode();"/>
					</div>
				</form>
			</div>
		</div>
		<div id="login_footer">
			Copyright &copy; 2009 www.dwzjs.com Inc. All Rights Reserved.
		</div>
	</div>
	<script type="text/javascript">
	$(function(){
		$('.verify_img').click(function(){
			var src = '<?php echo U('Home/User/verify_c',array());?>';
			$(this).attr('src',src);
		});
	})
	</script>
</body>
</html>