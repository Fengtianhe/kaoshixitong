<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="#rel#">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo ($page["numPerPage"]); ?>" />
	<input type="hidden" name="orderField" value="<?php echo ($page["orderField"]); ?>" />
	<input type="hidden" name="orderDirection" value="<?php echo ($page["orderDirection"]); ?>" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="/admin/user/online" method="post">
	<div class="searchBar">
		<ul class="searchContent" style="height:auto">
		<!--
			<li>
				姓名：
				<input type="text" name="realname" value="<?php echo $_REQUEST['realname']?>"/>
			</li>
			<li>
				邮 箱：
				<input type="text" name="email" value="<?php echo $_REQUEST['email']?>"/>
			</li>
		-->
			<!--<li>
				<p style="width:500px">
					邮箱验证状态：
					<select class="" name="is_verify_email" id="is_verify_email">
							<option value="">全部</option>
							<?php if(is_array($email_verify_status)): foreach($email_verify_status as $key=>$statu): ?><option value="<?php echo ($key); ?>" <?php if($key == $_REQUEST['is_verify_email']): ?>selected="selected"<?php endif; ?>><?php echo ($statu["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</p>
			</li>
			<li>
				<p style="width:500px">
					学  校：
					<select class="" name="school_id" id="school">
							<option value="">所有学校</option>
							<?php if(is_array($school_list)): $i = 0; $__LIST__ = $school_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$school): $mod = ($i % 2 );++$i;?><option value="<?php echo ($school["id"]); ?>" <?php if($school['id'] == $_REQUEST['school_id']): ?>selected="selected"<?php endif; ?>><?php echo ($school["s_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</p>
			</li>
			<li>
				注册时间：
				<input type="text" class="date" name="start_time" value="<?php echo $_REQUEST['start_time']?>" style="width:75px"/>~<input type="text" class="date" name="end_time" value="<?php echo $_REQUEST['end_time']?>" style="width:75px"/>
			</li> -->
		</ul>
		<!--
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">查找</button></div></div></li>
			</ul>
		</div>
		-->
	</div>
	</form>
</div>
<div class="pageContent">
	<table class="table" width="100%" layoutH="65">
		<thead>
			<tr>
				<th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
				<th width="30">ID</th>
				<th width="50">姓名</th>
				<th width="85">登录时间</th>
				<th width="70">ip</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="sid_user" rel="1">
				<td><input name="ids" value="xxx" type="checkbox"></td>
				<td><?php echo ($vo["user_id"]); ?></td>
				<td><?php echo ($vo["realname"]); ?></td>
				<td><?php echo (date("Y-m-d H:i:s",$vo["last_login_time"])); ?></td>
				<td><?php echo ($vo["ip"]); ?></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>共<?php echo ($page["totalCount"]); ?>人在线</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($page["totalCount"]); ?>" numPerPage="<?php echo ($page["numPerPage"]); ?>" pageNumShown="6" currentPage="<?php echo ($page["pageNum"]); ?>"></div>

	</div>
</div>