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
			<style>
	table.yyg-table {
		width: 100%;
		font-size:12px;
	}
	
	table.yyg-table th{
		padding: 8px;
		/*width:33.3333%;*/
	}
	
	table.yyg-table td{
		background: #fff;
		padding: 8px;
		border-top: solid #D5D5D5 1px;
		box-sizing: border-box;
	}
	
	table.yyg-table td.yyg-left,table.yyg-table th.yyg-left {
		text-align: left;
	}
	
	table.yyg-table td.yyg-center,table.yyg-table th.yyg-center {
		text-align: center;
	}
	
	table.yyg-table td.yyg-right,table.yyg-table th.yyg-right {
		text-align: right;
	}
</style>
<table class="yyg-table">
	<tr>
		<th class=" yyg-left">买家</th>
		<th class="yyg-center">出价</th>
		<th class="yyg-right">时间</th>
	</tr>
	<tbody id="recrodList">
	<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
			<td class="username yyg-left"><?php echo ($item["username"]); ?></td>
			<td class="money yyg-center"><?php echo ($item["money"]); ?></td>
			<td class="time yyg-right"><?php echo ($item["time"]); ?></td>
		</tr><?php endforeach; endif; ?>
	</tbody>
</table>
<footer class="yyg-footer">
	<div class="yyg-footer-block">
		<a class="yyg-btn yyg-btn-link" href="javascript:history.back()"><i class="mui-icon mui-icon-back"></i></a>
		<a id="addCartButton" class="yyg-btn yyg-btn-disabed">
			出价记录
		</a>
		<a class="yyg-btn yyg-btn-link" href="<?php echo U('Cart/index', '','');?>"><i class="iconfont icon-yyg_cart mui-icon"></i></a>
	</div>
</footer>

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
		var template = $("tr:first-child", recrodList);
		
		function page() {
			$.get("<?php echo U('record', '', '');?>/<?php echo ($gid); ?>/" + (++pageNum), null, function(list) {
				if(list && list.length > 0) {
		       		$.each(list, function() {
		       			var item = template.clone();
		       			$(".username", item).text(this.username);
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