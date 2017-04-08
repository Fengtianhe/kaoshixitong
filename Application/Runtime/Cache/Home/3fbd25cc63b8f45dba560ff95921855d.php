<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link rel="stylesheet" href="/Public/home/style.css">
	<script type="text/javascript" src="/Public/home/jquery.min.js"></script>
</head>
<body>
	<div class="container ">
		<div class="box regist" style="background: #fff;margin-top: 90px;border-radius: 15px;border: 1px solid #999;width: 535px; margin-left: 410px; height: 400px;">
			<div class="login">
				<span class="user_login">新用户注册</span>
			</div>
			<div class="login_box" action="/Home/User/saveUser" method="post">
			<form action="<?php echo U('home/user/saveUser');?>" method="post" class="reg_form">
				<p>
					真实姓名：<input class="mr_26 name" type="text" name="name">
				</p>
				<p>
					身份账号：<input class="mr_26 num" type="text" name="idcard">
				</p>
				<p>
					手机号码：<input class="mr_26 phone" type="text" name="phone">
				</p>
				<p>
					<span class="mar_25">邮</span>箱：<input class="mr_26 email" type="text" name="email" style="width:120px;">
					<span class="mar_25">省</span>份：
					<select class="mr_26 email" name="province" style="width:120px;">
						<?php if(is_array($province)): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>"><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</p>
				<p>
					<span class="mar_25">密</span>码：<input class="mr_26 pass" type="password" name="password">
				</p>
				<p>
					确认密码：<input class="mr_26 sure_pass" type="password" name="check_password">
				</p>
				<p>
					<label for="agreen">
						<input type="checkbox" id="agreen">
						已阅读并同意用户注册协议和隐私声明
					</label>
				</p>
				<p class="login_btn">注册</p>
			</form>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			var $reg_num = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
			var $reg_phone = /^1[3|4|5|8][0-9]\d{4,8}$/;
			var $reg_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			$(".login_btn").click(function(){
				var $name = $(".name").val();
				var $num = $(".num").val();
				var $phone = $(".phone").val();
				var $email = $(".email").val();
				var $pass = $(".pass").val();
				var $sure_pass = $(".sure_pass").val();
				//验证姓名
				if($name == ""){
					alert("用户名不能为空");
					return false;
				}
				if($name.length>4){
					alert("用户名不能大于四个字");
					return false;
				}
				//验证身份证号
				if($num == ""){
					alert("身份证号码不能为空");
					return false;
				}else{
					if($reg_num.test($num) == false){
						alert("身份证号码输入错误");
						return false;
					}
				}
				//验证手机号
				if($phone == ""){
					alert("手机号码不能为空");
					return false;
				}else{
					if($reg_phone.test($phone) == false){
						alert("手机号码输入有误");
						return false;
					}
				}
				//验证邮箱
				if($email == ""){
					alert("邮箱不能为空");
					return false;
				}else{
					if($reg_email.test($email) == false){
						alert("邮箱输入有误");
						return false;
					}
				}
				//验证密码
				if($pass == ""){
					alert("密码不能为空");
					return false;
				}
				//确认密码
				if($sure_pass == ""){
					alert("密码不能为空");
					return false;
				}
				$(".reg_form").submit();
			})
		})
	</script>
</body>
</html>