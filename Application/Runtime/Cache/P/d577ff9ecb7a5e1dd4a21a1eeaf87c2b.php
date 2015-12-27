<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登录-{wc:fun:_cfg("web_name")}</title>
<link rel="stylesheet" type="text/css" href="/Public/P/css/Comm.css"/>
<link rel="stylesheet" type="text/css" href="/Public/P/css/login.css"/>
<link href="/Public/P/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/P/css/demo.css" rel="stylesheet" type="text/css" />

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="/Public/P/js/jquery.Validform.min.js"></script>
<style>
.footer {
width: 100%;
text-align: center;
clear: both;
padding: 20px 0 10px 0;
font: 12px/1.5 Tahoma,Arial,"宋体",Helvetica,sans-serif;
color: #333;
background: #fff;
}
.footer .footer_links {
text-align: center;
}
.footer .footer_links a {
width: 70px;
text-align: center;
display: inline-block;
position: relative;
}
.footer .footer_links b {
height: 11px;
width: 1px;
background: #E4E4E4;
overflow: hidden;
display: inline-block;
position: absolute;
margin-top: 4px;
margin-top: 4px\9;
margin-left: -3px;
}
.user-img{
	width: 30px;
  	height: 30px;
  	border-radius: 50%;
  	padding: 3px;
  	1box-shadow: 0 0 1px 1px rgba(130,130,130,0.7);
}
</style>
</head>
<body>
 <script type="text/javascript">
$(function(){		
	var demo=$(".registerform").Validform({
		tiptype:2,
	});	
})
</script>
<script type="text/javascript">
	//表单提交
	$(document).ajaxStart(function() {
		$("button:submit").attr("disabled", true);
	}).ajaxStop(function() {
		$("button:submit").attr("disabled", false);
	});
	$(function() {		
		$("form").submit(function() {
			var self = $(this);
			$.post("<?php echo U('Main/login','','');?>", self.serialize(), success, "json");
			return false;
			function success(data) {				
				if (data.status)
				{
					window.location.href = "<?php echo U('Home/index','','');?>";
				}
				else
				{
					alert(data.msg);
				}
			}
		});
	});
</script>
<div class="login">
	<div class="login_top">
		<h1><a rel="nofollow" href="<?php echo U('Index/index', '', '');?>"><img src="/Public/P/images/logo/logo.jpg"/></a></h1>
		<p><a rel="nofollow" href="<?php echo U('Index/index', '', '');?>" class="back_home">返回首页</a><a href="{WEB_PATH}/help/1" target="_blank" class="help">帮助中心</a></p>
	</div>
	<div class="login_bg">
		<div id="loadingPicBlock" class="login_banner"><img src="/Public/P/images/20120628180933540.jpg" width="542" height="360"></div>
		<div class="login_box" id="LoginForm">
		<form class="registerform" method="post" action="">
			<h3>用户登录</h3>
			<ul>				
				<li class="click">
					<span>账号：</span>
					<input class="text_password" name="username" type="text"  datatype="m | e" nullmsg="请填写帐号！" errormsg="手机号！" />
				</li>
				<li class="ts"><div class="Validform_checktip">手机号！</div></li>
				<li>
					<span>密码：</span>					
					<input class="text_password" name="password" type="password"  datatype="*6-20" nullmsg="请设置密码！" errormsg="密码范围在6~20位之间！"/>
					<span class="fog"><a href="{WEB_PATH}/member/finduser/findpassword">忘记密码？</a></span> 
				</li>								
				<li class="ts" id="pwd_ts"><div class="Validform_checktip">请输入登录密码</div></li>
				<li class="end"><input name="submit" type="submit" value="登录" class="login_init" ></li>
			</ul>
			 
             
 			<div class="loginQQ">使用合作帐号登录：<span id="qq_login_btn">
 				<a href="<?php echo U('/Home/Public/qq?t=p', '', '');?>"><img alt="" class="user-img" src="/Public/P/images/logo/qq.png"/></a>
 				<a href="<?php echo U('/Home/Public/weibo?t=p', '', '');?>"><img alt="" class="user-img" src="/Public/P/images/logo/sweibo.png"/></a>
 				</span></div>  
            	
			<input value="{G_HTTP_REFERER}" name="hidurl" type="hidden">

			<p>
				还不是用户？<br>
				开心云购，惊喜无限，马上注册吧！</p>
			<h4>
				<a id="hylinkRegisterPage" tabindex="4" class="reg" href="<?php echo U('Main/register', '', '');?>">立即注册</a></h4>
		</form>
		</div>
	</div>
</div>
<!--login 结束-->
<div class="footer">
	<div class="footer_links">
		<a href="http://localhost:9999/?">首页</a>
		<b></b>
		<a  href="http://localhost:9999/?/group">云购圈子</a><b></b>
		<a  href="http://localhost:9999/?/help/1">关于云购</a><b></b>
		<a  href="http://localhost:9999/?/single/business">合作专区</a><b></b>
		<a  href="http://localhost:9999/?/link">友情链接</a><b></b>
		<a  href="http://localhost:9999/?/help/13">联系我们</a><b></b>  	</div>
	<div class="copyright">Copyright © 2011 - 2015</div>
</div>

</body>
</html>