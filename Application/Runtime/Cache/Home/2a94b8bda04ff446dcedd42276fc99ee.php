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
			<div class="top w">
	<div class="m_banner" id="owl">
		<?php if(is_array($slides)): foreach($slides as $key=>$s): ?><a href="<?php echo ((isset($s["link"]) && ($s["link"] !== ""))?($s["link"]):'#'); ?>" class="item"><img src="<?php echo ($s["img"]); ?>"></a><?php endforeach; endif; ?>
	</div>
	<div class="m_nav">
		<?php if(is_array($allCategories)): foreach($allCategories as $key=>$c): ?><a href="#"><img src="<?php echo ((isset($c["thumb"]) && ($c["thumb"] !== ""))?($c["thumb"]):'/Public/Home/images/m-index_10.png'); ?>"><span><?php echo ($c["name"]); ?></span></a><?php endforeach; endif; ?>
	</div>
</div>

<div class="m_baoliao w" style=" background:#ffffff; ">
	<ul class="goods-list clear">
		<li>
			<a target="_blank" href="#"> <img src="http://s1.juancdn.com/bao/140305/8/f/53171e5bdfe40_580x380.jpg_290x190.jpg" /></a>
			<a target="_blank" href="jump/67939165">
				<h1><i class="ico13"><img src="/Public/Home/images/sdj.png"></i>可爱时尚实用迷你照明电筒  【包邮】</h1>
				<div class="list-price buy">
					<i>￥</i><span class="price-new">1</span><i class="del">/￥19</i>
					<span class="good-btn">
							<i class="ico15"><img src="/Public/Home/images/sts.png"/></i>去抢购 
					</span>
				</div>
			</a>
		</li>

		<li>
			<a target="_blank" href="#"> <img src="http://s1.juancdn.com/bao/140307/e/4/53198186beb1a_580x380.jpg_290x190.jpg" /> </a>
			<a target="_blank" href="jump/66939495">
				<h1><i class="ico13"><img src="/Public/Home/images/sdj.png"></i>男士全棉中筒运动袜（5双）  【包邮】</h1>
				<div class="list-price end">
					<i>￥</i><span class="price-new">1</span><i class="del">/￥98</i>
					<span class="good-btn">抢光了</span>
				</div>
			</a>
		</li>
		<li>
			<a target="_blank" href="#"> <img src="http://s1.juancdn.com/bao/140305/8/f/53171e5bdfe40_580x380.jpg_290x190.jpg" /></a>
			<a target="_blank" href="jump/67939165">
				<h1><i class="ico13"><img src="/Public/Home/images/sdj.png"></i>可爱时尚实用迷你照明电筒  【包邮】</h1>
				<div class="list-price buy">
					<i>￥</i><span class="price-new">1</span><i class="del">/￥19</i>
					<span class="good-btn">
						<i class="ico15"><img src="/Public/Home/images/sts.png"/></i>去抢购 </span>
				</div>
			</a>
		</li>

		<li>
			<a target="_blank" href="#"> <img src="http://s1.juancdn.com/bao/140307/e/4/53198186beb1a_580x380.jpg_290x190.jpg" /> </a>
			<a target="_blank" href="jump/66939495">
				<h1><i class="ico13"><img src="/Public/Home/images/sdj.png"></i>男士全棉中筒运动袜（5双）  【包邮】</h1>
				<div class="list-price end">
					<i>￥</i><span class="price-new">1</span><i class="del">/￥98</i>
					<span class="good-btn">抢光了</span>
				</div>
			</a>
		</li>

	</ul>
</div>
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
			<a class="mui-tab-item" href="/index.php/Home/Person/me">
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