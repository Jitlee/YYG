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
	
	<h5 style="position: relative;" class="yyg-cell-left">积分<span class="yyg-cell-right yyg-right-margin">时间&nbsp;&nbsp;</span></h5>
	<ul id="recrodList" class="mui-table-view">
		<?php if(is_array($data)): foreach($data as $key=>$item): ?><li class="mui-table-view-cell">			
				<span class="yyg-cell-right yyg-right-margin time"><?php echo ($item["time"]); ?></span>
				<span class="money"><?php echo ($item["money"]); ?></span>
			</li><?php endforeach; endif; ?>
	</ul>
	
</div>

<script src="/Public/Home/js/jquery.touchSwipe.min.js"></script>
<script>
	$(function() {
		var pageNum = 1;
		var goodList = $("#recrodList").swipe({
			swipeUp: onscrollend,
			threshold: 100,
			allowPageScroll: "vertical"
		});
		
		$(window).bind("scroll", onscrollend);
		
		function onscrollend() {
			if ($(window).scrollTop() + $(window).height() == $(document).height()) {
       			console.info("滚动到底了");
       			page();
			}
		}
		
		var recrodList = $("#recrodList");
		var template = $("li:first-child", recrodList);		
		function page() 
		{
				$.get("<?php echo U('pagescore', '', '');?>/20/" + (++pageNum), null, function(list) {
						if(list && list.length > 0) 
						{
				       		$.each(list, function() {
				       			var item = template.clone();
				       			$(".money", item).text(this.money);
				       			$(".time", item).text(this.time);
				       			recrodList.append(item);
				       		});
		       	} else {
		       		pageNum--;	
		    		}
		    });
		}
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