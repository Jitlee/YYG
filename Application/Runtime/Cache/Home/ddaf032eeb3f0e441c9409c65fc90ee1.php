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

		<title>登陆</title>

		<!-- Bootstrap core CSS -->
		<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/login.css" rel="stylesheet" />
		<style>
			.area {
				margin: 20px auto 0px auto;
			}
			.mui-input-group {
				margin-top: 10px;
			}
			.mui-input-group:first-child {
				margin-top: 20px;
			}
			.mui-input-group label {
				width: 35%;
			}
			.mui-input-row label~input,
			.mui-input-row label~select,
			.mui-input-row label~textarea {
				width: 58%;
			}
			.mui-checkbox input[type=checkbox],
			.mui-radio input[type=radio] {
				top: 6px;
			}
			.mui-content-padded {
				margin-top: 25px;
			}
			.mui-btn {
				padding: 10px;
			}
			.link-area {
				display: block;
				margin-top: 25px;
				text-align: center;
			}
			.spliter {
				color: #bbb;
				padding: 0px 8px;
			}
			.oauth-area {
				position: absolute;
				bottom: 20px;
				left: 0px;
				text-align: center;
				width: 100%;
				padding: 0px;
				margin: 0px;
			}
			.oauth-area .oauth-btn {
				display: inline-block;
				width: 50px;
				height: 50px;
				background-size: 30px 30px;
				background-position: center center;
				background-repeat: no-repeat;
				margin: 0px 20px;
				/*-webkit-filter: grayscale(100%); */
				
				border: solid 1px #ddd;
				border-radius: 25px;
			}
			.oauth-area .oauth-btn:active {
				border: solid 1px #aaa;
			}
			.user-img{
				width: 30px;
			  	height: 30px;
			  	border-radius: 50%;
			  	padding: 3px;
			  	1box-shadow: 0 0 1px 1px rgba(130,130,130,0.7);
			}
		</style>
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="/Public/Home/js/owl.carousel.min.js"></script>
		<script src="/Public/Home/layer/layer.js"></script>
		<script src="/Public/Home/js/jquery.lazy.min.js"></script>
		<script src="/Public/Home/js/jquery.touchSwipe.min.js"></script>
		<script src="/Public/Home/js/android_toast.min.js"></script>		
		<script src="/Public/Home/js/mobile.js"></script>
		<script src="http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js"></script>
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
					$.post("<?php echo U('Public/login','','');?>", self.serialize(), success, "json");
					return false;
					function success(data) {
						if (data.status)
						{
							//layer.alert(data.msg);
							window.location.href = "<?php echo U('Person/me','','');?>";
						}
						else
						{
							layer.alert(data.msg);
						}
					}
				});
			});
		</script>
		
	</head>

	<body class="container">
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">登录</h1>
		</header>

		<div class="mui-content">
			<form action="<?php echo U('login','','');?>" role="form" method="post" class="mui-input-group">
				<div class="mui-input-group">
					<div class="mui-input-row">
						<label for="mobile" class="control-label">手机号</label>
						<input type="text" class="mui-input-clear mui-input" id="mobile" name="mobile" maxlength="11" placeholder="请输入您的手机号码" required />
					</div>

					<div class="mui-input-row">
						<label for="password" class="control-label">密 &nbsp; &nbsp;码</label>
						<input type="password" class="mui-input-clear mui-input" id="password" name="password" placeholder="请输入您的密码" required />
					</div>
				</div>

				<div class="mui-content-padded"> 
					<button id='login' type="submit" class="mui-btn mui-btn-block mui-btn-primary">登录</button>
					<div class="link-area">
						<a id='reg' href="<?php echo U('reg', '', '');?>">注册账号</a> <span class="spliter">
							|</span> <a id='forgetPassword' href="forgetPassword">忘记密码</a>
					</div>
				</div>
				<br />
				<div class="mui-content-padded oauth-area"> 
				</div>
				<input type="hidden" name="redirect" value="<?php echo ($redirect); ?>" />
			</form>
			 

		</div>
		<nav class="mui-bar mui-bar-tab">
			<span  class="mui-tab-item">
				<a href="<?php echo U('Public/qq', '', '');?>">
					<img alt="" class="user-img" src="/Public/Home/images/person/qq.png"/>
				</a>
				&nbsp;
				<a href="<?php echo U('Public/weibo', '', '');?>">
					<img alt="" class="user-img" src="/Public/Home/images/person/sweibo.png"/>
				</a>
			</span>
		</nav>
		

	</body>

</html>