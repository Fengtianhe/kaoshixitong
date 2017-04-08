<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>考试系统管理平台</title>

<link href="/Public/admin/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/Public/admin/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/Public/admin/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="/Public/admin/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>

<!--[if IE]>
<link href="themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->
	
<!--[if lte IE 9]>
<script src="js/speedup.js" type="text/javascript"></script>
<![endif]-->

<script src="/Public/admin/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="/Public/admin/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/Public/admin/js/jquery.validate.js" type="text/javascript"></script>
<script src="/Public/admin/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="/Public/admin/xheditor/xheditor-1.2.1.min.js" type="text/javascript"></script>
<script src="/Public/admin/xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
<script src="/Public/admin/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<script type="text/javascript" src="/Public/admin/chart/raphael.js"></script>
<script type="text/javascript" src="/Public/admin/chart/g.raphael.js"></script>
<script type="text/javascript" src="/Public/admin/chart/g.bar.js"></script>
<script type="text/javascript" src="/Public/admin/chart/g.line.js"></script>
<script type="text/javascript" src="/Public/admin/chart/g.pie.js"></script>
<script type="text/javascript" src="/Public/admin/chart/g.dot.js"></script>

<script src="/Public/admin/js/dwz.core.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.util.date.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.validate.method.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.regional.zh.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.barDrag.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.drag.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.tree.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.accordion.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.ui.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.theme.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.switchEnv.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.alertMsg.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.contextmenu.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.navTab.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.tab.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.resize.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.dialog.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.dialogDrag.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.sortDrag.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.cssTable.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.stable.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.taskBar.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.ajax.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.pagination.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.database.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.datepicker.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.effects.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.panel.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.checkbox.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.history.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.combox.js" type="text/javascript"></script>
<script src="/Public/admin/js/dwz.print.js" type="text/javascript"></script>
<!--
<script src="bin/dwz.min.js" type="text/javascript"></script>
-->
<script src="/Public/admin/js/dwz.regional.zh.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	DWZ.init("<?php echo ($url['xml_url']); ?>", {
		loginUrl:"<?php echo ($url['login']); ?>", loginTitle:"登录",	// 弹出登录对话框
//		loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:"themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
});

</script>
</head>

<body scroll="no">
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="<?php echo U('Admin/Index/index');?>">标志</a>
				<ul class="nav">	
					<li><a href="#"><?php echo ($_SESSION['admin']['me']['nickname']); ?></a>&nbsp;&nbsp;<a href="<?php echo U('admin/System/change');?>" target="dialog" rel="ck">修改密码</a>&nbsp;&nbsp;<a href="<?php echo U('admin/Index/logout');?>">退出</a></li>
				</ul>
			</div>

			<!-- navMenu -->
			
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

				<div class="accordion" fillSpace="sidebar">
					<div class="accordionHeader">
						<h2><span>Folder</span>数据管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li>
								<a href="<?php echo U('Admin/User/lists');?>" target="navTab" rel="user">用户管理</a>
								<a href="<?php echo U('Admin/Question/lists');?>" target="navTab" rel="question">题库管理</a>
								<a href="<?php echo U('Admin/User/online');?>" target="navTab" rel="user_online">在线用户</a>
								<a href="<?php echo U('Admin/Question/lists');?>" target="navTab" rel="subjects_chapter">科目与章节管理</a>
								<!-- <a href="<?php echo U('Admin/News/report');?>" target="navTab" rel="report">举报管理</a>
								<a href="<?php echo U('Admin/Contact/lists');?>" target="navTab" rel="contact">留言管理</a> -->
							</li>
						</ul>
					</div>
					<div class="accordionHeader">
						<h2><span>Folder</span>系统管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li>
								<a href="<?php echo U('Admin/System/status');?>" target="dialog" rel="system">系统开关</a>
								<?php if($_SESSION['admin']['me']['email'] == 'admin@admin.com'){ ?>
								<a href="<?php echo U('Admin/System/lists');?>" target="navTab" rel="system">管理员列表</a>
								<?php } ?>
								<a href="<?php echo U('Admin/Log/lists');?>" target="navTab" rel="log">充值记录</a>
								<!-- <a href="<?php echo U('Admin/Article/lists');?>" target="navTab" rel="article">文章发布</a>
								<a href="<?php echo U('Admin/Message/lists');?>" target="navTab" rel="message">站内信管理</a>
								<a href="<?php echo U('Admin/Adminuser/lists');?>" target="navTab" rel="admin_user">管理员设置</a> -->
							</li>
						</ul>
					</div>
					<!--  -->
				</div>
			</div>
		</div>
		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
					<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:;">我的主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox">
						<div class="accountInfo">
							<div class="alertInfo">
								<h2><a href="doc/dwz-user-guide.pdf" target="_blank">DWZ框架使用手册(PDF)</a></h2>
								<a href="doc/dwz-user-guide.swf" target="_blank">DWZ框架演示视频</a>
							</div>
							<div class="right">
								<p><a href="doc/dwz-user-guide.zip" target="_blank" style="line-height:19px">DWZ框架使用手册(CHM)</a></p>
								<p><a href="doc/dwz-ajax-develop.swf" target="_blank" style="line-height:19px">DWZ框架Ajax开发视频教材</a></p>
							</div>
							<p><span>DWZ富客户端框架</span></p>
							<p>DWZ官方微博:<a href="http://weibo.com/dwzui" target="_blank">http://weibo.com/dwzui</a></p>
						</div>
						<div class="pageFormContent" layoutH="80" style="margin-right:230px">
							
							<p style="color:red">DWZ官方微博 <a href="http://weibo.com/dwzui" target="_blank">http://weibo.com/dwzui</a></p>
							<p style="color:red">DWZ官方微群 <a href="http://q.weibo.com/587328/invitation=11TGXSt-148c2" target="_blank">http://q.weibo.com/587328/invitation=11TGXSt-148c2</a></p>

<div class="divider"></div>
<h2>dwz v1.2视频教程:</h2>
<p><a href="http://www.u-training.com/thread-57-1-1.html" target="_blank">http://www.u-training.com/thread-57-1-1.html</a></p>

<div class="divider"></div>
<h2>DWZ系列开源项目:</h2>
<div class="unit"><a href="http://code.google.com/p/dwz/" target="_blank">dwz富客户端框架 - jUI</a></div>
<div class="unit"><a href="http://code.google.com/p/dwz4j" target="_blank">dwz4j(Java Web)快速开发框架 + jUI整合应用</a></div>
<div class="unit"><a href="http://code.google.com/p/dwz4php" target="_blank">ThinkPHP + jUI整合应用</a></div>
<div class="unit"><a href="http://code.google.com/p/dwz4php" target="_blank">Zend Framework + jUI整合应用</a></div>
<div class="unit"><a href="http://www.yiiframework.com/extension/dwzinterface/" target="_blank">YII + jUI整合应用</a></div>

<div class="divider"></div>
<h2>常见问题及解决:</h2>
<pre style="margin:5px;line-height:1.4em">
Error loading XML document: dwz.frag.xml
直接用IE打开index.html弹出一个对话框：Error loading XML document: dwz.frag.xml
原因：没有加载成功dwz.frag.xml。IE ajax laod本地文件有限制, 是ie安全级别的问题, 不是框架的问题。
解决方法：部署到apache 等 Web容器下。
</pre>

<div class="divider"></div>
<h2>有偿服务请联系:</h2>
<pre style="margin:5px;line-height:1.4em;">
定制化开发，公司培训，技术支持
合作电话：010-52897073
邮箱：support@dwzjs.com
</pre>
						</div>
					
					</div>
					
				</div>
			</div>
		</div>

	</div>

	<div id="footer">Copyright &copy; 2010 <a href="demo_page2.html" target="dialog">DWZ团队</a> 京ICP备05019125号-10</div>

<!-- 注意此处js代码用于google站点统计，非DWZ代码，请删除 -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16716654-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? ' https://ssl' : ' http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</body>
</html>