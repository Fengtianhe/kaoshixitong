<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="#rel#">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo ($page["numPerPage"]); ?>" />
	<input type="hidden" name="orderField" value="<?php echo ($page["orderField"]); ?>" />
	<input type="hidden" name="orderDirection" value="<?php echo ($page["orderDirection"]); ?>" />
</form>


<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" action="/admin/question/lists" method="post">
	<div class="searchBar">
		<ul class="searchContent" style="height:auto">
			<li>
				id：
				<input type="text" name="id" value="<?php echo $_REQUEST['id']?>"/>
			</li>
			<li>
				题干：
				<input type="text" name="title" value="<?php echo $_REQUEST['title']?>"/>
			</li>
			 <li>
				<p style="width:500px">
					题型：
					<select class="" name="question_type" id="question_type">
							<option value="">所有题型</option>
							<?php if(is_array($question_type)): foreach($question_type as $key=>$statu): ?><option value="<?php echo ($key); ?>" <?php if($key == $_REQUEST['question_type']): ?>selected="selected"<?php endif; ?>><?php echo ($statu["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</p>
			</li>
			<li>
				<p style="width:500px">
					分类：
					<select class="" name="category" id="category">
							<option value="">全部</option>
							<?php if(is_array($category)): foreach($category as $key=>$statu): ?><option value="<?php echo ($key); ?>" <?php if($key == $_REQUEST['category']): ?>selected="selected"<?php endif; ?>><?php echo ($statu["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</p>
			</li>
			<!--<li>
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
<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/admin/question/editorQuestion" target="dialog" width="700" height="600"><span>添加</span></a></li>
			<li><a class="add" href="/admin/question/batch" target="dialog" width="700" height="600"><span>批量添加</span></a></li>
			<li><a class="edit" href="/admin/question/editorQuestion?id={sid}" target="dialog" width="700" height="600" warn="请选择一道题"><span>修改</span></a></li>
			<li><a class="edit" href="/admin/question/saveQuestion?id={sid}&is_del=1" target="ajaxTodo" warn="请选择一道题" title="确认删除么？"><span>删除</span></a></li>
			<li><a class="edit" href="/admin/question/saveQuestion?id={sid}&is_del=0" target="ajaxTodo" warn="请选择一道题" title="确认恢复么？"><span>恢复</span></a></li>
			<li><a class="edit" href="/admin/question/del?id={sid}" target="ajaxTodo" warn="请选择一道题" title="确认删除么？"><span>物理删除</span></a></li>
			<li><a title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" postType="string" href="/admin/question/batchDel" class="delete"><span>批量删除</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="165">
		<thead>
			<tr>
				<th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
				<th width="50">Id</th>
				<th width="220">题干</th>
				<th width="50">题型</th>
				<th width="150">选项</th>
				<th width="80">分类</th>
				<th width="70">创建日期</th>
				<th width="70">修改日期</th>
				<th width="70">最后修改人</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="sid" rel="<?php echo ($vo["id"]); ?>">
				<td><input name="ids" value="<?php echo ($vo["id"]); ?>" type="checkbox"></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["title"]); ?></td>
				<td><?php echo ($vo["question_type"]); ?></td>
				<td><?php echo ($vo["stem"]); ?></td>
				<td><?php echo ($vo["category"]); ?></td>
				<td><?php echo date('Y-m-d H:i:s',$vo['create_time']) ?></td>
				<td><?php echo $vo['update_time']? date('Y-m-d H:i:s',$vo['update_time']) : '未修改'; ?></td>
				<td><?php echo ($vo["admin_user_id"]); ?></td>
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