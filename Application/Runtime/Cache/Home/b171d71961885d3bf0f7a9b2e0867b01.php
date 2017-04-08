<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
	<link rel="stylesheet" href="/Public/home/style.css">
	<script type="text/javascript" src="/Public/home/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="box">
			<div class="login">
				<span class="user_login">用户登录</span><span class="regist_new"><a href="/Home/User/regist">注册新用户》</a></span>
				<!-- <span class="forget_pass"><a href="">忘记密码？</a></span> -->
			</div>
			<div class="login_box" style="line-height: 40px;">
			<form action="<?php echo U('home/user/handleLogin');?>" method="post" class="form">
				<p>
					账号：<input class="mr_26 num" type="text" placeholder="身份账号" name="idcard"/>
				</p>
				<p>
					密码：<input class="mr_26 pass" type="password" name="password"/>
				</p>
				<p class="verify" >
					<font>验证码：</font><input class="code" type="text" name="verify"><img width="50%" class="left15 verify_img" height="50" alt="验证码" src="<?php echo U('Home/User/verify_c',array());?>" title="点击刷新" onclick=""><span>看不清楚？点击图片</span>
				</p>
				<p class="login_btn login_btn_mar_65">登录</p>
			</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(function(){
		$('.verify_img').click(function(){
			var src = '<?php echo U('Home/User/verify_c','','');?>?'+Math.random();
			$(this).attr('src',src);
		});
	})
	</script>
	<script>
		$(function(){
			var $btn = $(".login_btn");
			var $reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
			$btn.click(function(){
				var $num = $(".num").val();
				var $pass = $(".pass").val();
				var $code = $(".code").val();
				//验证身份证号码
				if($num == ""){
					alert("身份证号码不能为空");
					return false;
				}else{
					if($reg.test($num) == false){
						alert("身份证号码输入有误");
						return false;
					}
				}
				//验证密码
				if($pass == ""){
					alert("密码不能为空");
					return false;
				}
				//验证验证码
				if($code == ""){
					alert("验证码不能为空");
					return false;
				}
				$('.form').submit();
			})
		})
	</script>
</body>
</html>