<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="m.178hui.com" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<meta property="qc:admins" content="304107566762141336654" />
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/owl.carousel.css" rel="stylesheet">
		<link href="/Public/Home/css/global.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/public.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/index.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1447654310_2816622.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/mobile.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="/Public/Home/js/owl.carousel.min.js"></script>
		<script src="/Public/Home/layer/layer.js"></script>
		<script src="/Public/Home/js/jquery.lazy.min.js"></script>
		<script src="/Public/Home/js/jquery.touchSwipe.min.js"></script>
		
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
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title"><?php echo ($title); ?></h1>
		</header>
		<div class="mui-content">
			<?php if(isset($tuijian)): ?><section class="tuijian mui-content-padded yyg-content">
		<div class="tuijian-img-container">
			<img class="tuijian-img" src="<?php echo ($tuijian["thumb"]); ?>" />
		</div>
		<div class="tuijian-content">
			<p class="tuijian-content-title"><?php echo ($tuijian["title"]); ?></p>
			<h5><i class="iconfont icon-renminbi"></i><label>当前价格</label><r class="small">¥</r> <r class="larger"><?php echo ($tuijian["zuigaojia"]); ?></r></h5>
			<h5><i class="iconfont icon-add"></i><label>出价次数</label><?php echo ($tuijian["chujiacishu"]); ?>次</h5>
			<h5><i class="iconfont icon-weibiaoti5"></i><label>剩余时间</label><time countdown="<?php echo (strtotime($tuijian["end_time"])); ?>"><d>0</d><d>0</d>:<d>0</d><d>0</d>:<d>0</d><d>0</d></time></h5>
			<button type="button" class="mui-btn mui-btn-red">我要出价</button>
		</div>
	</section><?php endif; ?>
<div class="yyg-content mui-content-padded">
	<ul id="goodList" class="yyg-goods-list">
		<?php if(is_array($list)): foreach($list as $key=>$item): ?><li class="yyg-goods-list-item">
				<div class="yyg-goods-img-container">
					<img class="yyg-goods-img" src="<?php echo ($item["thumb"]); ?>" />
				</div>
				<div class="yyg-goods-media">
					<p class="tuijian-content-title"><?php echo ($item["title"]); ?></p>
					<h5><label>当前价格</label><r class="small">¥</r> <r class="larger"><?php echo ($item["zuigaojia"]); ?></r></h5>
					<time countdown="<?php echo (strtotime($item["end_time"])); ?>"><d>0</d><d>0</d>:<d>0</d><d>0</d>:<d>0</d><d>0</d></time>
				</div>
				<a href="<?php echo U('view', '', '');?>/<?php echo ($item["gid"]); ?>" type="button" class="mui-btn mui-btn-red">我要出价</a>
			</li><?php endforeach; endif; ?>
	</ul>
</div>

<script>
	$(function() {
		var pageNum = 1;
		var goodList = $("#goodList").swipe({
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
		
		var template = $("li:first-child", goodList);
		
		function page() {
			$.get("<?php echo U('page', '', '');?>/8/" + (++pageNum), null, function(list) {
	       		$.each(list, function() {
	       			var item = template.clone();
	       			$("img", item).attr("src", this.thumb);
	       			$("p", item).text(this.title);
	       			$("h5 r:last-child", item).text(this.zuigaojia);
	       			$("a", item).attr("href", "<?php echo U('view', '', '');?>/" + this.gid);
	       			$("time", item).attr("countdown", this.end_time);
					goodList.append(item);
	       		});
	       });
		}
	});
</script>
			<br />
			<br />
		</div>
		<nav class="mui-bar mui-bar-tab">
			<a id="home" class="mui-tab-item" href="<?php echo U('Home/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a id="miaosha" class="mui-tab-item" href="<?php echo U('Miaosha/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_miaosha"><span class="mui-badge">9</span></span>
				<span class="mui-tab-label">秒杀</span>
			</a>
			<a id="xiangou" class="mui-tab-item" href="<?php echo U('Xiangou/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_cart"></span>
				<span class="mui-tab-label">限购</span>
			</a>
			<a id="paimai" class="mui-tab-item" href="<?php echo U('Paimai/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_paimai"></span>
				<span class="mui-tab-label">拍卖</span>
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
	});
</script>