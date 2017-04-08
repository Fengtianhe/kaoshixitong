<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>导游考试系统</title>
	<link rel="stylesheet" href="/Public/home/css/css.css">
</head>
<body>
	<div id="all">
		<div class="header">
			<div class="h_content">
				<span class="left">
					您好，
					<?php if(!$_SESSION['me'] || $_SESSION['me']==''){ ?>
						<a href="/Home/User/login">请登录</a>
					<?php }else{ ?>
						<font color="#4FAED2"><?php echo $_SESSION['me']['realname']; ?></font><a href="/Home/User/center" class="clearMargin">[个人中心]</a><a href="/Home/User/logout" class="clearMargin">[退出]</a>
					<?php } ?>
				</span>
				<span class="right"><a href="javascript:window.external.AddFavorite(location.href, '导游模拟考试系统')">加入收藏</a></span>
			</div>
		</div>

		<div class="main">
			<div class="title_bg">
				<div class="big_title">
					导游考试网站模拟考试系统
				</div>
			</div>

			<div class="clearWidth"></div>

			<div class="content">
				<div class="list">
					
					<div class="list_t">
						<div class="input">
							<select name="" id="">
							
							</select>
						</div>
						<ul>
						<?php if($_SESSION['me']['formal']==1){ ?>
							<li><div class="list_style"></div><a href="<?php echo U('home/practice/index');?>">强化训练</a></li>
							<li><div class="list_style"></div><a href="<?php echo U('home/test/index');?>">模拟考试答题</a></li>
						<?php }else{ ?>
							<li><div class="list_style"></div><a href="/Home/practice/free">免费体验</a></li>
						<?php } ?>
							<!-- <li><div class="list_style"></div><a href="">错题记录</a></li>
							<li><div class="list_style"></div><a href="">我的收藏</a></li>
							<li><div class="list_style"></div><a href="">答题记录</a></li> -->
						</ul>
					</div>
					<div class="list_b"></div>
				</div>

				<div class="info">
					<div class="info_tit">
						导游考试网站模拟考试系统
					</div>
					<div class="info_box" style="height: 270px;">
						<div class="text">
							<p><b>全真模拟：</b>全面模拟机考流程，给考生最贴近实际的机考体验。</p>
							<p><b>名师题库：</b>顶级名师团队精心编写，题型全面，覆盖各类考点。</p>
							<p><b>全新体验：</b>全面UI设计和交互体验，锻炼考生操作能力和速度。</p>
							<div class="btns" style="height: 45px;">
					
								<div class="button" >
									<a href="/home/practice/startPractice?category=<?php echo ($category); ?>&chapter=<?php echo ($chapter); ?>&question_type=1" rel="">单选</a>
								</div>
								<div class="button">
									<a href="/home/practice/startPractice?category=<?php echo ($category); ?>&chapter=<?php echo ($chapter); ?>&question_type=2" rel="">多选</a>
								</div>		
							</div>
						</div>

						<div class="msg">
	<div id="text_box">
		<div id="t_b_t">
			友情提示
		</div>
		<div id="t_b_b">
			<p>今天是<font><?php echo date('Y'); ?></font>年<font><?php echo date('m'); ?></font>月<font><?php echo date('d'); ?></font>日<font>&nbsp;<?php echo date('l'); ?></font></p>
			<p>请您合理安排工作学习时间，祝您考试顺利</p>
			<p>考生交流加微信:dyks678 </p>
		</div>
	</div>
</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			Copyright © 2016 导游在线模拟考试系统
		</div>
	</div>
</body>
</html>