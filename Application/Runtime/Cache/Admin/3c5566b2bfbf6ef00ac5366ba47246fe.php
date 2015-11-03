<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="viewport" content="width=device-width, initial-scale=1" />
	    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	    <meta name="description" content="" />
	    <meta name="author" content="" />
	    <!--<link rel="icon" href="../../favicon.ico">-->
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    
	    <title>后台登陆</title>
	
	    <!-- Bootstrap core CSS -->
	    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
	    	<link href="/Public/Admin/css/login.css" rel="stylesheet" /> 
  	</head>
	<body>
		<div class="container">
			<div class="row col-md-6 col-sm-offset-3">
				<div id="login">
					<form class="form-horizontal" action="<?php echo U('login','','');?>" role="form" method="post">
						<div class="form-group">
							<label for="username" class="col-sm-offset-1 col-sm-2 control-label">用户名:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="username" name="username" placeholder="用户名" required />
							</div>
						</div>
	
						<div class="form-group">
							<label for="password" class="col-sm-offset-1 col-sm-2 control-label">密 &nbsp; &nbsp;码:</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" id="password" name="password" placeholder="密码"  required />
							</div>
						</div>
	
						<div class="form-group">
							<label for="verify" class="col-sm-offset-1 col-sm-2 control-label">验证码:</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="verify" name="verify" placeholder="验证码" maxlength="4" required />
							</div>
						</div>
	
						<div class="form-group">
							<label for="" class="col-sm-offset-1 col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<img src="<?php echo U('verify');?>" class="verifyimg reloadverify"/>
							</div>
						</div>
	
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-7">
								<button id="submit" type="submit" class="btn btn-primary btn-login">登陆</button>
							</div>
						</div>
						<div class="form-group">
							<p class="check-tips text-danger col-sm-offset-3 col-sm-7"></p>
						</div>
	
					</form>
				</div>
			</div>
		</div>
		
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	 	<script src="http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js"></script>
	 	
	 	<script type="text/javascript">
	 		//表单提交
			$(document).ajaxStart(function(){
				$("button:submit").attr("disabled", true);
			}).ajaxStop(function(){
				$("button:submit").attr("disabled", false);
			});
			//刷新验证码
			$(function(){
				var verify = $("#verify");
				//初始化选中用户名输入框
				var usernameInput = $("#username").focus();
				var passwordInput = $("#password");
				var verifyInput = $("#verify");
				var verifyimg = $(".verifyimg"); 
				var verifysrc = verifyimg.attr("src").replace(/\?.*$/,'');
				var checkTip = $(".check-tips");
				$(".reloadverify").click(function(){
					verify.val("").focus();
					refreshverify();
				});
				
				$("form").submit(function(){
					var self = $(this);
					$.post(self.attr("action"), self.serialize(), success, "json");
					return false;
			
					function success(data){
						if(data.status){
							window.location.href = data.url;
						} else {
							var errorCode = Number(data.info[0]);
							checkTip.text(data.info.substr(1));
							//刷新验证码
							refreshverify();
							switch(errorCode) {
								case 1:	// 用户名或密码不正确
									usernameInput.focus().select();
									break;
								case 2:
									passwordInput.val("").focus();
									break;
								default:
									verifyInput.val("").focus();
									break;
							}
						}
					}
				});
				
				function refreshverify() {
					verifyimg.attr("src", verifysrc+'?random='+Math.random());
				}
			});
	 	</script>
 	
	</body>
</html>