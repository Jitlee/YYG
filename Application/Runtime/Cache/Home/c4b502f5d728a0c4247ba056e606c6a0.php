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
  <a id="menu" class="mui-action-menu mui-icon mui-icon-bars mui-pull-right" href="<?php echo U('Person/rechargerecord', '', '');?>" id="menulist"></a>
  <h1 class="mui-title"><?php echo ($title); ?></h1>
</header>

			
<div class="mui-content">
	<div class="mui-content-padded">
	<ul class="mui-table-view">
		<li class="userline land-cell cell-center" data-bind="visible: isLogin" id="loginUser">					 
			<span class="cell-right"   id="rechargerecord">
				<img class="circle-img" alt="红包" src="/Public/Home/images/person/iconfont-jiaofei.png">
				<p>我的余额:<?php echo ($data["money"]); ?></p>
			</span>					
		</li>
	</ul>
		<button id='btnrecharge' type="button" class="mui-btn mui-btn-block mui-btn-primary">充值</button>
		<button id='btnoutcash' type="button" class="mui-btn mui-btn-block mui-btn-outlined">提现</button>
	</div>	
</div>

<!--右上角弹出菜单-->
<div id="topPopover" class="mui-popover">
	<div class="mui-popover-arrow"></div>
	<div class="mui-scroll-wrapper">
		<div class="mui-scroll">
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<a href="#">钱包明细</a>
				</li>
				<li class="mui-table-view-cell"><a href="#">我的提现</a>
				</li>
			</ul>
		</div>
	</div>
</div>
		
<style>
	.cell-center{ text-align: center;}
</style>

		
<script type="text/javascript">
	$(function() {
		//充值
		$("#btnrecharge").click(function() {
			window.location.href="<?php echo U('Person/recharge', '', '');?>";
		});
		//充傎记录 、提现
		$("#menulist").click(function() {
			window.location.href="<?php echo U('Person/rechargerecord', '', '');?>";
			//window.location.href="<?php echo U('Person/rechargerecord', '', '');?>";
		});
		$("#btnoutcash").click(function() {
			window.location.href="<?php echo U('Person/cashout', '', '');?>";
		});
		 		
	});
</script>
		<script src="/Public/Home/js/mui.min.js"></script>
				 
		
		<script>
			mui.init({
				swipeBack: true //启用右滑关闭功能
			});
			mui('.mui-scroll-wrapper').scroll();
			mui('body').on('shown', '.mui-popover', function(e) {
				//console.log('shown', e.detail.id);//detail为当前popover元素
			});
			mui('body').on('hidden', '.mui-popover', function(e) {
				//console.log('hidden', e.detail.id);//detail为当前popover元素
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