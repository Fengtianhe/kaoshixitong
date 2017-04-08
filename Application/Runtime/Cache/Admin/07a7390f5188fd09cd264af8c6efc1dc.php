<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="#rel#">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo ($page["numPerPage"]); ?>" />
	<input type="hidden" name="orderField" value="<?php echo ($page["orderField"]); ?>" />
	<input type="hidden" name="orderDirection" value="<?php echo ($page["orderDirection"]); ?>" />
</form>

<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="/admin/user/lists" method="post">
	<div class="searchBar">
		<ul class="searchContent" style="height:auto">
			<li>
				姓名：
				<input type="text" name="realname" value="<?php echo $_REQUEST['realname']?>"/>
			</li>
			<li>
				邮 箱：
				<input type="text" name="email" value="<?php echo $_REQUEST['email']?>"/>
			</li>
			<li>
				身份证号：
				<input type="text" name="idcard" value="<?php echo $_REQUEST['idcard']?>"/>
			</li>
			<li>
				<p style="width:500px">
					状　　态：
					<select class="" name="status" id="status">
							<option value="">所有用户</option>
							<?php if(is_array($user_status)): foreach($user_status as $key=>$statu): ?><option value="<?php echo ($key); ?>" <?php if($key == $_REQUEST['province']): ?>selected="selected"<?php endif; ?>><?php echo ($statu["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</p>
			</li>
			<li>
				<p style="width:500px">
					省    份：
					<select class="" name="province" id="area_id">
							<option value="">所有城市</option>
							<?php if(is_array($areas)): $i = 0; $__LIST__ = $areas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["area_id"]); ?>" <?php if($vo['area_id'] == $_REQUEST['province']): ?>selected="selected"<?php endif; ?>><?php echo ($vo["area_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</p>
			</li>
			<li>
				<p style="width:500px">
					会员状态：
					<select class="" name="fstatus" id="fstatus">
							<option value="">所有用户</option>
							<?php if(is_array($formal_status)): foreach($formal_status as $key=>$statu): ?><option value="<?php echo ($key); ?>" <?php if($key == $_REQUEST['fstatus']): ?>selected="selected"<?php endif; ?>><?php echo ($statu["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</p>
			</li>
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
		
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">查找</button></div></div></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent">
	<table class="table" width="100%" layoutH="135">
		<thead>
			<tr>
				<th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
				<th width="30" orderField="id" class="<?php if ($page['orderField'] == 'id') echo $page['orderDirection']?>">ID</th>
				<th width="50">姓名</th>
				<th width="85">身份证号</th>
				<th width="70">电话</th>
				<th width="80">邮箱</th>
				<th width="60" align="center">正式学员</th>
				<th width="60" align="center">状态</th>
				<th width="50">剩余时长</th>
				<th width="25">充值</th>
				<th width="120">注册日期</th>
				<th width="120">修改日期</th>
				<th width="120" orderField="lastlogintime" class="<?php if ($page['orderField'] == 'lastlogintime') echo $page['orderDirection']?>">最后登陆</th>
				<th width="30">权限</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="sid_user" rel="1">
				<td><input name="ids" value="xxx" type="checkbox"></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["realname"]); ?></td>
				<td><?php echo ($vo["idcard"]); ?></td>
				<td><?php echo ($vo["phone"]); ?></td>
				<td><?php echo ($vo["email"]); ?></td>
				<td>
					<?php if($vo['formal'] == -1): ?><a title="点击认证用户" href="/admin/user/ajaxChangeStatus?id=<?php echo ($vo["id"]); ?>&formal=1" target="ajaxTodo">未认证</a>
					<?php else: ?>
						已认证<?php endif; ?>
				</td>
				<td>
					<?php if($vo['is_del'] == 1): ?><a title="点击开启用户" target="ajaxTodo" href="/admin/user/ajaxChangeStatus?id=<?php echo ($vo["id"]); ?>&status=-1" rel="user">关闭中</a>
					<?php else: ?>
						<a title="点击关闭用户" target="ajaxTodo" href="/admin/user/ajaxChangeStatus?id=<?php echo ($vo["id"]); ?>&status=1" rel="user">开启中</a><?php endif; ?>
				</td>
				<td><?php echo ($vo["time_length"]); ?>小时</td>
				<td><a href="/Admin/User/topUp?uid=<?php echo ($vo["id"]); ?>" target="dialog" rel="user">充值</a></td>
				<td><?php echo date('Y-m-d H:i:s',$vo['create_time']) ?></td>
				<td><?php echo date('Y-m-d H:i:s',$vo['update_time']) ?></td>
				<td><?php echo date('Y-m-d H:i:s',$vo['last_login_time']) ?></td>
				<td><a title="修改" target="dialog" href="/admin/user/edit_permission?id=<?php echo ($vo["id"]); ?>">修改</a></td>
				<td>
					<!-- <a title="删除" target="ajaxTodo" href="demo/common/ajaxDone.html?id=xxx" class="btnDel">删除</a> -->
					<a title="编辑" target="dialog" href="/admin/user/edit_user?id=<?php echo ($vo["id"]); ?>" class="btnEdit">编辑</a>
					<a target="ajaxTodo" href="/admin/user/del?id=<?php echo ($vo["id"]); ?>" class="btnDel" title="确定删除么?">删除</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>共<?php echo ($page["totalCount"]); ?>条</span>
		</div>
		
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($page["totalCount"]); ?>" numPerPage="<?php echo ($page["numPerPage"]); ?>" pageNumShown="6" currentPage="<?php echo ($page["pageNum"]); ?>"></div>

	</div>
</div>