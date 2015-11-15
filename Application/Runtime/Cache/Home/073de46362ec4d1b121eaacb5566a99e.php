<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="m.178hui.com" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/owl.carousel.css" rel="stylesheet">
		<link href="/Public/Home/css/global.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/public.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/index.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="/Public/Home/js/owl.carousel.min.js"></script>
		<script src="/Public/Home/layer/layer.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$(".mall_list a").click(function() {
					var index = layer.open({
						type: 1,
						title: false,
						closeBtn: false,
						shadeClose: false,
						offset: '25%',
						content: "<div class='no_login_show'><h1>亲！您还没登录一起惠哦！</h1><a href='login.html'>马上登录</a><a href='register.html'>免费注册</a><a href='#'>先购物，再返利</a><a href='javascript:layer.closeAll();'>取消</a></div>"
					});
				});
				$("#msg_bijia").click(function() {
					layer.tips('请耐心等待一下，我们正在拼命开发中···', '#msg_bijia');
				});
			});
		</script>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title"><?php echo ($title); ?></h1>
		</header>
		<div class="mui-content">
					<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">注册</h1>
		</header>
		<div class="mui-content">
			<form>
				<div class="mui-input-group">
					<div class="mui-input-row">
						<label>账号</label>
						<input id='account' type="text" name="mobile" class="mui-input-clear mui-input" required placeholder="请输入您的手机号码">
					</div>
					<div class="mui-input-row">
						<label>密码</label>
						<input id='password' type="password"  name="password"  class="mui-input-clear mui-input" required placeholder="请输入密码">
					</div>
					<div class="mui-input-row">
						<label>确认</label>
						<input id='password_confirm' type="password" name="passwordconfim" class="mui-input-clear mui-input" required placeholder="请确认密码">
					</div>
				</div>
				<div class="mui-content-padded">
					<button id='reg' type="submit" class="mui-btn mui-btn-block mui-btn-primary">注册</button>
				</div>
			</form>
			
				
		</div>
<script type="text/javascript">
	 //表单提交
	$(document).ajaxStart(function() {
		$("button:submit").attr("disabled", true);
	}).ajaxStop(function() {
		$("button:submit").attr("disabled", false);
	});
	 //刷新验证码
	$(function() {		
		$("form").submit(function() {
			var self = $(this);
			var pwd=$("#password").val();
			var repwd=$("#password_confirm").val();
			if(pwd!=repwd)
			{
				layer.tips('输入两次密码不一致！','#password_confirm');
				return false;
			}
			$.post('<?php echo ($action); ?>', self.serialize(), success, "json");
			return false;
	
			function success(data) {
				if (data.status) {
					window.location.href = data.url;
				} else {
					$("#checkTips").text(data.info);
				}
			}
		});
	});
	</script>
		</div>
		<nav class="mui-bar mui-bar-tab">
			<a id="defaultTab" class="mui-tab-item mui-active" href="/index.php/Home/Index">
				<span class="mui-icon mui-icon-home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a class="mui-tab-item" href="/index.php/Home/MiaoSha">
				<span class="mui-icon mui-icon-email"><span class="mui-badge">9</span></span>
				<span class="mui-tab-label">秒杀</span>
			</a>
			<a class="mui-tab-item" href="tab-webview-subpage-contact.html">
				<span class="mui-icon mui-icon-contact"></span>
				<span class="mui-tab-label">限购</span>
			</a>
			<a class="mui-tab-item" href="tab-webview-subpage-setting.html">
				<span class="mui-icon mui-icon-gear"></span>
				<span class="mui-tab-label">拍卖</span>
			</a>
			<a class="mui-tab-item" href="/index.php/Home/Person/login">
				<span class="mui-icon mui-icon-gear"></span>
				<span class="mui-tab-label">我的</span>
			</a>
		</nav>
		<div class="gotop backtop" style="display:none;"></div>
	</body>

</html>
<script type="text/javascript">
	//返回顶部
	$(document).ready(function() {
		$(window).scroll(function() {
			var scrollHeight = $(document).height();
			var scrollTop = $(window).scrollTop();
			var $windowHeight = $(window).innerHeight();
			scrollTop > 75 ? $(".gotop").fadeIn(200).css("display", "block") : $(".gotop").fadeOut(200).css({
				"background-image": "url(/Public/Home/images/iconfont-fanhuidingbu.png)"
			});
		});
		$('.backtop').click(function(e) {
			$(".gotop").css({
				"background-image": "url(/Public/Home/images/iconfont-fanhuidingbu_up.png)"
			});
			e.preventDefault();
			$('html,body').animate({
				scrollTop: 0
			});
		});
	});
</script>