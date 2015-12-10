<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1449475927_2126234.css" rel="stylesheet" type="text/css" />
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
			<style type="text/css">
	.yyg-prize {
		border:1px solid #FF002B;
		border-radius: 5px;
		margin:8px;
		background-color: #FDF5E6;
		min-height: 80px;
		position: relative;
	}
	#emptyBlock {
		text-align: center;
		font-size:20px;
		color:#666;
		padding: 20px 0;
	}
	
	#emptyBlock .iconfont {
		font-size: 80px;
		line-height: 100px;
	}
	
	.yyg-prize-img {
		position: absolute;
		left:10px;
		background-repeat: no-repeat;
		background-position: 50% 50%;
		background-size: 100% 100%;
		width:64px;
		height:64px;
		border-radius: 32px;
		left: 10px;
		top:15px;
	}
	
	.yyg-prize-content {
		padding-left: 90px;
		margin-top:8px;
		margin-bottom:8px;
	}
	
	.yyg-prize-content h5 {
		line-height: 20px;
	}
	
	.yyg-prize-content a{
		font-size:16px;
		color: #2af;
	}
	
	.yyg-prize-all {
		border-top:solid 1px rgba(255,0, 43, 0.2);
		line-height: 30px;
		display: block;
		/*color:#FF002B;*/
		color:#999;
		font-size: 16px;
		text-align: center;
	}
	
</style>

<div class="yyg-qishu">
	<ul class="yyg-qishu-view">
		<?php if(is_array($periods)): foreach($periods as $key=>$item): ?><a class="yyg-qishu-item <?php if(isset($item["active"])): ?>yyg-active<?php endif; ?>" <?php if(!isset($item["active"])): ?>href="<?php echo U('view','','');?>/<?php echo ($item["gid"]); ?>/<?php echo ($item["qishu"]); ?>"<?php endif; ?> >第<?php echo ($item["qishu"]); ?>期</a><?php endforeach; endif; ?>
	</ul>
	<!--<a class="yyg-qishu-all">+</a>-->
</div>

<div class="yyg-body">
	<?php if(isset($data["prizer"])): ?><div class="yyg-prize">
			<div class="yyg-prize-img" style="background-image: url(<?php echo ($data["prizer"]["img"]); ?>);">
			</div>
			<div class="yyg-prize-content">
				<a ><?php echo ($data["prizer"]["username"]); ?></a>
				<h5>本次参与:<r><?php echo ($data["prizer"]["count"]); ?></r></h5>
				<h5>幸运云购码:<r><?php echo ($data["prizecode"]); ?></r></h5>
				<h5>揭晓时间：<?php echo ($data["end_time"]); ?></h5>
			</div>
			<a class="yyg-prize-all" href="<?php echo U('prizerecord','','');?>/<?php echo ($data["qishu"]); ?>/<?php echo ($data["gid"]); ?>/<?php echo ($data["prizeuid"]); ?>/<?php echo ($data["prizer"]["username"]); ?>">
				获得者本期所有云购码 >
			</a>
		</div>
	<?php else: ?>
		<div id="emptyBlock" class="yyg-prize">
			<i class="iconfont icon-yihan"></i>
			<br/>
			很遗憾，本期没有人参与
		</div><?php endif; ?>
	<section class="tuijian yyg-content">
		<div class="tuijian-left">
			<div class="tuijian-img-container">
				<img class="tuijian-img" src="<?php echo ($data["thumb"]); ?>" />
			</div>
		</div>
		<div class="tuijian-content">
			<p class="tuijian-content-title">(第<?php echo ($data["qishu"]); ?>期)<?php echo ($data["title"]); ?> <r><?php echo ($data["subtitle"]); ?></r></p>
			<h5>价值：¥ <?php echo ($data["money"]); ?></h5>
		</div>
	</section>
</div>

<ul class="mui-table-view yyg-margin20">
	<?php if(isset($data["prizer"])): ?><li class="mui-table-view-cell"><a class="mui-navigate-right">计算结果</a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right" href="<?php echo U('record', '', '');?>/<?php echo ($data["qishu"]); ?>/<?php echo ($data["gid"]); ?>">参与记录 <span class="yyg-tiny">(<?php echo ($data["canyurenshu"]); ?>)</span></a></li><?php endif; ?>
	<li class="mui-table-view-cell"><a class="mui-navigate-right" href="<?php echo U('detail', '', '');?>/<?php echo ($data["gid"]); ?>">图文详情 <span class="yyg-tiny">(建议WIFI下使用)</span></a></li>
	<?php if(isset($data["prizer"])): ?><li class="mui-table-view-cell"><a class="mui-navigate-right">商品晒单</a></li><?php endif; ?>
</ul>
<footer class="yyg-footer">
	<div class="yyg-footer-block">
		<a class="yyg-btn yyg-btn-link" href="javascript:history.back()"><i class="mui-icon mui-icon-back"></i></a>
		<?php if(isset($data["current"])): ?><a id="addCartButton" href="<?php echo U('view','','');?>/<?php echo ($data["gid"]); ?>/<?php echo ($data["current"]); ?>" class="yyg-btn yyg-btn-primary">
				第<?php echo ($data["current"]); ?>期正在进行中...
			</a>
		<?php else: ?> 
			<a id="addCartButton" class="yyg-btn yyg-btn-disabed">
				商品已经结束活动
			</a><?php endif; ?> 
		<a class="yyg-btn yyg-btn-link" href="<?php echo U('Cart/index', '','');?>"><i class="iconfont icon-yyg_cart mui-icon"></i></a>
	</div>
</footer>

<script type="text/javascript">
	$(function() {
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