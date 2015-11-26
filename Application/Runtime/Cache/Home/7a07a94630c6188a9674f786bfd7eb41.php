<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1448373727_1371717.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/idangerous.swiper.css" rel="stylesheet">
		<link href="/Public/Home/css/mobile.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/android_toast.min.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="/Public/Home/js/idangerous.swiper-1.9.1.min.js"></script>
		<script src="/Public/Home/js/idangerous.swiper.scrollbar-1.2.js"></script>
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
			<div class="yyg-body">
	<div class="swiper-outter">
		<div class="swiper-container swiper-loop">
		    <div class="swiper-wrapper">
		    	<?php if(is_array($images)): foreach($images as $key=>$image): ?><div class="swiper-slide" style="background-image: url(<?php echo ($image["image_url"]); ?>);"></div><?php endforeach; endif; ?>
		    </div>
		</div>
		<div class="pagination pagination-loop"></div>
	</div>
	
	<p class="yyg-view-title yyg-view-margin">
		<?php echo ($data["title"]); ?> <r><?php echo ($data["subtitle"]); ?></r>
	</p>
	<h5 class="yyg-view-margin">起拍价：¥ <?php echo ($data["qipaijia"]); ?></h5>
	<h5 class="yyg-view-margin">最高出价者：无</h5>
	<h5 class="yyg-view-margin">立即揭标价：¥ <?php echo ($data["lijijia"]); ?></h5>
	<h5 class="yyg-view-margin">保证金：<r> ¥ </r><r class="larger"><?php echo ($data["baozhengjin"]); ?></r></h5>
</div>

<ul class="mui-table-view yyg-margin20">
	<li class="mui-table-view-cell"><a class="mui-navigate-right">出价记录(<?php echo ($data["chujiacishu"]); ?>)</a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right" href="<?php echo U('detail', '', '');?>/<?php echo ($data["gid"]); ?>">图文详情<span class="yyg-tiny">(建议WIFI下使用)</span></a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right">商品晒单</a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right">卖家承诺</a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right">保证金须知</a></li>
</ul>
<footer class="yyg-footer">
	<div class="yyg-footer-left">
		<a class="yyg-btn yyg-btn-link" href="javascript:history.back()"><i class="mui-icon mui-icon-back"></i></a>
		<a class="yyg-btn yyg-btn-primary" href="<?php echo U('Pay/baozhengjin', '', '');?>/<?php echo ($data["gid"]); ?>">我要出价</a>
	</div>
	<div class="yyg-footer-right">
		<div id="lijiButton" class="yyg-btn yyg-btn-success">立即揭标</div>
		<a class="yyg-btn yyg-btn-link" href="<?php echo U('Cart/index', '','');?>"><i class="iconfont icon-yyg_cart mui-icon"></i></a>
	</div>
</footer>

<script type="text/javascript">
	$(function() {
		$("#addCartButton").click(function() {
			$.post("<?php echo U('Cart/add', '', '');?>/<?php echo ($data["gid"]); ?>", null, function(result) {
				new Android_Toast({content: result.message});
			})
		});
		$("#lijiButton").click(function() {
			$.post("<?php echo U('Cart/add', '', '');?>/<?php echo ($data["gid"]); ?>/3", null, function(result) {
				window.location.href = "<?php echo U('Cart/index', '','');?>";
			})
		});
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
		
		//Partial Slides
		swiperLoop = $('.swiper-loop').swiper({
			pagination : '.pagination-loop',
			slidesPerSlide : Math.min(3, <?php echo (count($images)); ?>),
			loop:true
		});
	});
</script>