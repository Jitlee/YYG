<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="m.178hui.com" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<meta property="qc:admins" content="304107566762141336654" />
		<meta property="wb:webmaster" content="86a35467a2bdb23f" />
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/owl.carousel.css" rel="stylesheet">
		<link href="http://at.alicdn.com/t/font_1449475927_2126234.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/mobile.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/android_toast.min.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="/Public/Home/js/owl.carousel.min.js"></script>
		<script src="/Public/Home/layer/layer.js"></script>
		<script src="/Public/Home/js/jquery.lazy.min.js"></script>
		<script src="/Public/Home/js/jquery.touchSwipe.min.js"></script>
		<script src="/Public/Home/js/android_toast.min.js"></script>
		<script src="/Public/Home/js/jquery.fly.min.js"></script>
		
		<script src="/Public/Home/js/mobile.js"></script>

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
		<div class="mui-content">
			<header class="mui-bar mui-bar-nav">	
  <button class="mui-btn mui-btn-link mui-btn-nav mui-pull-left" onclick="history.go(-1)">
    <span class="mui-icon mui-icon-left-nav" ></span>
    	返回
  </button>
  <h1 class="mui-title"><?php echo ($title); ?></h1>
</header>

			
<div class="mui-content">
			<form  role="form" method="post" class="mui-input-group">
				<div class="mui-input-group">
					<div class="mui-input-row">
						<label for="username" class="control-label">申请提现金额</label>
						<input type="text" class="mui-input-clear mui-input" id="money" name="money" maxlength="10" placeholder="请输入提现金额" required />
					</div>
					
					<div class="mui-input-row">
						<label for="username" class="control-label">开户人</label>
						<input type="text" class="mui-input-clear mui-input" id="username" name="username" maxlength="10" placeholder="请输入您的开户姓名" required />
					</div>

					<div class="mui-input-row">
						<label for="bankname" class="control-label">银行名称</label>
						<input type="text" class="mui-input-clear mui-input" id="bankname" name="bankname" placeholder="请输入银行名称" required />
					</div>
					
					<div class="mui-input-row">
						<label for="branch" class="control-label">支行</label>
						<input type="text" class="mui-input-clear mui-input" id="branch" name="branch" placeholder="请输入支行名称" required />
					</div>
					
					<div class="mui-input-row">
						<label for="banknumber" class="control-label">银行帐号</label>
						<input type="text" class="mui-input-clear mui-input" id="banknumber" name="banknumber" placeholder="请输入您的银行帐号" required />
					</div>
					
					<div class="mui-input-row">
						<label for="linkphone" class="control-label">联系电话</label>
						<input type="text" class="mui-input-clear mui-input" id="linkphone" name="linkphone" placeholder="请输入您的联系电话" required />
					</div>
				</div>

				<div class="mui-content-padded"> 
					<button id='btnsave' type="button" class="mui-btn mui-btn-block mui-btn-primary">申请提现</button>
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
	$(function(){				
				$("#btnsave").click(function(){
						var self = $("form");
						$.post("<?php echo U('Person/cashout','','');?>", self.serialize(), savesuccess, "json");
						return;
						function savesuccess(data) {
							if (data.status) {
								 window.location.href="<?php echo U('Person/me', '', '');?>";
							} else {
								layer.alert(data.msg);
							}
						}					
				});		
		 
});
</script>
	
			<br />
			<br />
		</div>
		<nav class="mui-bar mui-bar-tab">
			<a id="home" class="mui-tab-item" href="<?php echo U('Index/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a id="jiexiao" class="mui-tab-item" href="<?php echo U('Jiexiao/index', '', '');?>">
				<span class="mui-icon iconfont icon-jiangbei"></span>
				<span class="mui-tab-label">秒杀</span>
			</a>
			<a id="paimai" class="mui-tab-item" href="<?php echo U('Paimai/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_paimai"></span>
				<span class="mui-tab-label">拍卖</span>
			</a>
			<a id="cart" class="mui-tab-item" href="<?php echo U('Cart/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_cart"><span id="cartCount" class="mui-badge"  <?php if($_SESSION['user_']['cartCount']== 0): ?>style="display:none"<?php endif; ?>><?php echo session('cartCount');?></span></span>
				<span class="mui-tab-label">购物车</span>
			</a>
			<a id="person" class="mui-tab-item" href="<?php echo U('Person/me', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_me"></span>
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
		
		$("#<?php echo ((isset($pid) && ($pid !== ""))?($pid):'index'); ?>").addClass("mui-active");
		
		var cartCount = <?php echo (session('cartCount')); ?> * 1;
		var cartCountSpan = $("#cartCount");
		function countCart(count) {
			cartCount += count;
			cartCountSpan.text(cartCount);
			if(cartCount <= 0) {
				cartCountSpan.hide();
			} else {
				cartCountSpan.show();
			}
		}
		window.countCart = countCart;
	});
</script>