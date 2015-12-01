<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1448782434_6313894.css" rel="stylesheet" type="text/css" />
		<?php if(isset($images)): ?><link href="/Public/Home/css/idangerous.swiper.css" rel="stylesheet"><?php endif; ?>
		<link href="/Public/Home/css/mobile.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/android_toast.min.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<?php if(isset($images)): ?><script src="/Public/Home/js/idangerous.swiper-1.9.1.min.js"></script>
		<script src="/Public/Home/js/idangerous.swiper.scrollbar-1.2.js"></script><?php endif; ?>
		<script src="/Public/Home/js/jquery.touchSwipe.min.js"></script>
		<script src="/Public/Home/js/android_toast.min.js"></script>
		
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
		<div class="mui-content" style="padding-top: 0;padding-bottom: 54px;">
			<style>
	ul.yyg-prizecode-list {
		list-style: none;
		padding: 8px;
		margin: 0;
		background-color:#fff;	
	}
	
	ul.yyg-prizecode-list li {
		margin-right: 10px;
		margin-top:3px;
		margin-bottom:3px;
		padding: 0;
		display: inline-block;
		font-size: 12px;
	}
</style>
<h5 class="yyg-cell-left"><?php echo ($username); ?>第<?php echo ($qishu); ?>期总共购买了<?php echo ($count); ?>人次</h5>
<ul id="recrodList" class="yyg-prizecode-list">
	<?php if(is_array($list)): foreach($list as $key=>$item): ?><li><?php echo ($item["pcode"]); ?></li><?php endforeach; endif; ?>
</ul>
<footer class="yyg-footer">
	<div class="yyg-footer-block">
		<a class="yyg-btn yyg-btn-link" href="javascript:history.back()"><i class="mui-icon mui-icon-back"></i></a>
		<a id="addCartButton" class="yyg-btn yyg-btn-disabed">
			<?php echo ($title); ?>
		</a>
		<a class="yyg-btn yyg-btn-link" href="<?php echo U('Cart/index', '','');?>"><i class="iconfont icon-yyg_cart mui-icon"></i></a>
	</div>
</footer>

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
		
		function page() {
			$.get("<?php echo U('prizerecord', '', '');?>/<?php echo ($qishu); ?>/<?php echo ($gid); ?>/<?php echo ($uid); ?>/<?php echo ($username); ?>/" + (++pageNum), null, function(list) {
				if(list && list.length > 0) {
		       		$.each(list, function() {
		       			var item = template.clone().text(this.pcode);
		       			recrodList.append(item);
		       		});
		       	} else {
		       		pageNum--;	
		       	}
	        });
		}
	});
</script>
		</div>
		<div class="gotop backtop" style="display:none;"></div>
	</body>

</html>
<script type="text/javascript">
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
		
		<?php if(isset($images)): ?>//Partial Slides
		swiperLoop = $('.swiper-loop').swiper({
			pagination : '.pagination-loop',
			slidesPerSlide : Math.min(3, <?php echo (count($images)); ?>),
			loop:true
		});<?php endif; ?>
	});
</script>