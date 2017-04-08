<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
    -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <meta name="msapplication-TileImage" content="assets/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileColor" content="#0e90d2">
    <!-- <link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">
    -->
    <!-- <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    -->
    <!-- <link rel="icon" type="image/png" href="assets/i/favicon.png">
    -->
    <link rel="stylesheet" href="/Public/PC/css/normalize.css">
    <link rel="stylesheet" href="/Public/PC/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/PC/css/bootstrap.offcanvas.min.css">

    <link rel="stylesheet" href="/Public/PC/css/font-awesome/font-awesome.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/Public/PC/css/main.css">
    <title>考试系统</title>
</head>
<body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">您正在使用一个 <strong>老旧的</strong> 浏览器. 为了您能获取更好的互联网体验，请 <a href="http://browsehappy.com.cn/" target="_blank">升级</a> 您的浏览器.</p>
            <![endif]-->

    <!-- =========================================== mycode =====================================- -->

<div class="menu-left">
    <img src="/Public/PC/img/liumin.png" alt="" class="head">
    <ul class="list-unstyled menu-left-ul">
        <a href="/"><li class="active">首页</li></a>
        <a href="/home/user/center"><li>个人中心</li></a>
    </ul>
</div>
<div class="content">
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
    -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <meta name="msapplication-TileImage" content="assets/i/app-icon72x72@2x.png">
    <meta name="msapplication-TileColor" content="#0e90d2">
    <!-- <link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">
    -->
    <!-- <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    -->
    <!-- <link rel="icon" type="image/png" href="assets/i/favicon.png">
    -->
    <link rel="stylesheet" href="/Public/PC/css/normalize.css">
    <link rel="stylesheet" href="/Public/PC/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/PC/css/bootstrap.offcanvas.min.css">

    <link rel="stylesheet" href="/Public/PC/css/font-awesome/font-awesome.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="/Public/PC/css/iframe.css">
    <style type="text/css">
        .current {background: #19B4ED !important;color:#fff !important;}
    </style>
    <title>考试系统</title>
</head>
<body oncontextmenu="return false" onselectstart="return false" 
ondragstart="return false" onbeforecopy="return false" oncopy="document.selection.empty()" onselect="document.selection.empty()">
        <!--[if lt IE 8]>
            <p class="browserupgrade">您正在使用一个 <strong>老旧的</strong> 浏览器. 为了您能获取更好的互联网体验，请 <a href="http://browsehappy.com.cn/" target="_blank">升级</a> 您的浏览器.</p>
            <![endif]-->

    <!-- =========================================== mycode =====================================- -->

    <div class="top">
        <img src="/Public/PC/img/logo.png" class="logo" alt="">
        <h1>导游考试模拟系统</h1>
        <!-- <div class="test-info">
            <div class="info">
                <span class="name">开始时间</span>
                00:00:00
            </div>
            <div class="info">
                <span class="name">结束时间</span>
                00:00:00
            </div>
            <div class="info">
                <span class="name zt">状态</span>
                未考
            </div>
            <div class="info">
                <span class="name">创建人员</span>
                XXX
            </div>
            <div class="time">
                11:11:11
            </div>
        </div> -->
        <div class="user">
            <p>您好,<?php echo $_SESSION['me']['realname'] ?> <span class="exit"><a href="<?php echo U('user/logout');?>">退出</a></span></p>
        </div>
    </div>
    <div class="test">
        <div class="question question-on clearfix">
            <h3 class="question-title"></h3>
            <!-- <span class="question-tip ">
                <span class="question-num">1</span>/
                <span class="question-totalnum">30</span>
                <span class="question-icon"><i class="fa fa-lg fa-map-marker"></i></span>
            </span> -->
            <ul class="list-unstyled options">
            
            </ul>
            <div class="question-btns">
                <a  class="btn btn-prev prev">上一题</a>
                <a  class="btn btn-next next">下一题</a>
                <a  class="btn btn-question-submit push">提交</a>
            </div>
        </div>

        <div class="question-answer hide">
            <div class="question-tip-left">
                <h3>分析</h3>
            </div>
            <p class="answer-result"></p>
            <div class="question-tip-left">
                <h3>答案详解</h3>
            </div>
            <p class="answer-analysis"></p>
        </div>
    </div>
    <div class="right">
        <ul class="timus list-unstyled">
            <?php if(is_array($question)): $i = 0; $__LIST__ = $question;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="num active <?php if ($res = $results[$vo['id']]){ if ($res['select'] == 'ok') {echo 'btn-success';} else {echo 'btn-danger'; } }?>" rel="<?php echo ($vo["id"]); ?>">
                <?php echo ($key+1); ?>
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- <div class="right-menu">
            <div class="show pull-left">
                <span class="s1">1</span>
                未答题
            </div>
            <div class="show pull-right">
                <span class="s3">3</span>
                已标记
            </div>
            <div class="show center-block">
                <span class="s2">2</span>
                已答题
            </div>
            <a  class="btn btn-submit">完成提交</a>
        </div> -->
    </div>



    <!-- ============================================ end =======================================- -->



<!--[if (gte IE 9)|!(IE)]>
<!-->
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
    <script src="/Public/PC/js/jquery-1.9.1.min.js" ></script>
    <script src="/Public/PC/js/bootstrap.min.js"></script>
    <script src="/Public/PC/js/bootstrap.offcanvas.min.js"></script>
    <script src="/Public/PC/js/jquery.cookie.js"></script>
    <script>

    </script>
</body>
</html>
</div>

<!-- <div class="container-fluid">
    <div class="row clearfix center-block maxw">
        <div class="col-md-12 column nopadding">


        </div>
    </div>
</div> -->



    <!-- ============================================ end =======================================- -->



<!--[if (gte IE 9)|!(IE)]>
<!-->
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
    <script src="/Public/PC/js/jquery-1.9.1.min.js" ></script>
    <script src="/Public/PC/js/bootstrap.min.js"></script>
    <script src="/Public/PC/js/bootstrap.offcanvas.min.js"></script>
    <script src="/Public/PC/js/jquery.cookie.js"></script>
    <script>

    </script>
</body>
</html>

<script>
	//初始化获取第一题
	ajaxGetQuestion({id:<?php echo ($first_question["id"]); ?>});
    //if (!($('.num:eq(0)').hasClass('btn-success') || $('.num:eq(0)').hasClass('btn-danger'))) {
        $('.num:eq(0)').addClass('current');
    //}
	$(function(){
	//点击答题卡获取题
	$('.num').click(function(){
		$(this).addClass('current').siblings().removeClass('current');
		var sn = $(this).html();
		var id = $(this).attr('rel');
		var data = {id:id,sn:sn};
		ajaxGetQuestion(data);
		return false;
	});
	$(document).on('click','.next',function(){
        submitQuestion();
        $('.question-answer').addClass('hide');
		moveQuestion('next');
	});
	$(document).on('click','.prev',function(){
        submitQuestion();
        $('.question-answer').addClass('hide');
		moveQuestion('prev');
	});
	//提交处理
	$(document).on('click','.push',function(){
        submitQuestion();
	});
	});
/**
 * 答题
 * @return ok or error
 */
function submitQuestion(){
    var id = $('.question-title').attr('rel');
        var type = $('.question-title').attr('type');
        var input = $('.question input[rel="1"]');
        var checked = $('.question input:checked');
        var answer_true = false;
        if (input.length == checked.length) {
            answer_true = true;
            for(var i =0;i<input.length;i++){
                if ($(input[i]).val() != $(checked[i]).val()) {
                    answer_true = false;
                    break;
                }   
            }
        } 
        $('.question-answer').removeClass('hide');
        if (answer_true) {
            $('.answer-result').html('回答正确');
        } else {
            var answer_str = '';
            input.each(function(){
                var s = $(this).closest('li').text().substr(0,1);
                answer_str += s + ',';
            });
            answer_str = answer_str.replace(/(^,*)|(,*$)/g, "");
            $('.answer-result').html('回答错误 正确答案:'+answer_str);
        }
        if (answer_true) {
            var select = 'ok';
            $('.num.current').addClass('btn-success').removeClass('btn-danger');
        } else {
            var select = 'error';
            $('.num.current').addClass('btn-danger').removeClass('btn-success');
        }
        
        //获取 用户选择答案
        var selected = '';
        checked.each(function(){
            selected +=  $(this).val() + ',';
        });
        $.ajax({
            type:'post',
            url:'/home/practice/ajaxhandle',
            dataType:'json',
            async: false,
            data:{'id':id,'select':select,'type':type,'selected':selected}
        });
        return select;
}
/**
 * 移动题目 主要用于上一题 下一题
 * @param  string direction 方向 next prev
 * @return 
 */
function moveQuestion(direction){
	var current = $('.num.current');
	switch (direction) {
		case "prev":
		var current_direction = current.prev();
		
			break;
		case "next":
		var current_direction = current.next();
			break;
	}
	if (!(current_direction.length > 0)) {
		alert('没有啦');
		return false;
	}
	current_direction.addClass('current');
	current.removeClass('current');
	var id = current_direction.attr('rel');
	var sn = current_direction.html();
	var data = {id:id,sn:sn};
	ajaxGetQuestion(data);
}
/**
 * ajax 获取题目 并显示在页面上
 * @param  json data post数据
 * @return 
 */
function ajaxGetQuestion(data){
	$.ajax({
		type:"post",
		url:"/home/Practice/ajaxGetQuestion",
		data:data,
		datatype:"json",
		success:function(data){
			switch (data.question_info.question_type) {
				case '1':
					var type = '单选';
					var input_name = 'answer';
					var input_type = 'radio';
					break;
				case '2':
					var type = '多选';
					var input_name = 'answer[]';
					var input_type = 'checkbox';
					break;
			}
			//题目
			var title = data.question_info.sn+'.'+'('+type+')'+data.question_info.title;
			$('.question-title').html(title);
            $('.question-title').attr('rel',data.question_info.id);
            $('.question-title').attr('type',data.question_info.question_type);
			//选项
			var stem = ''; 
			for(var i in data.question_info.question_stem){
                switch(i){
                    case '0':
                        var serial = 'A';
                        break;
                    case '1':
                        var serial = 'B';
                        break;
                    case '2':
                        var serial = 'C';
                        break;
                    case '3':
                        var serial = 'D';
                        break;
                    case '4':
                        var serial = 'E';
                        break;
                }
                
				stem += '<li><input type="'+input_type+'" name="'+input_name+'" value="'+data.question_info.question_stem[i].sn+'" rel="'+data.question_info.question_stem[i].is_true+'">'+serial+'、 '+data.question_info.question_stem[i].stem_content+'</li>';
			}
			$('.options').html(stem);

			// str += '<div class="btnn"><span class="push btn">提交</span><span class="prev btn">上一题</span><span class="next btn">下一题</span></div><br/>';

			var analysis = data.question_info.explain;
			$('.answer-analysis').html(analysis);

            var selected = data.question_answer.selected;

            for (var i in selected) {
                $('.question input[value="'+selected[i]+'"]').prop('checked',true);
            }
		}
	});
}
	</script>