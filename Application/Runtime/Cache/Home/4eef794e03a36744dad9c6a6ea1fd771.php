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
		<link href="/Public/Home/css/global.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/public.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/index.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1447769195_3516257.css" rel="stylesheet" type="text/css" />
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
			<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>全部商品</title>
	<meta name="description" content="1元夺宝，就是指只需1元就有机会获得一件商品，好玩有趣，不容错过。" />
    <meta name="keywords" content="1元,一元,1元夺宝,1元购,1元购物,1元云购,一元夺宝,一元购,一元购物,一元云购,夺宝奇兵" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
	<meta content="telephone=no" name="format-detection" />
        <link href="/Public/Home/css/goodscommon.css" rel="stylesheet" type="text/css" />
        <link href="/Public/Home/css/goodslist.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="g-header">
    <!-- 导航栏 -->
    <div class="m-nav">
        <div class="g-wrap">
            <ul class="m-nav-list">
                    <li class="selected"><a href="/index.php/Home/MiaoSha/Index"><span>全部商品<span></a></li>
                    <li ><a href="/index.php/Home/MiaoSha/WillEnd"><span>即将揭晓<span></a></li>
                    <li ><a href="/index.php/Home/SaiDan/Index"><span>晒单分享<span></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="g-body">
    <div class="m-list">
        <!-- 二级导航 -->
        <div class="g-wrap g-body-hd m-list-nav">
            <div class="m-list-nav-catlog">
                <a href="javascript:void(0)">商品分类<i class="ico ico-arrow ico-arrow-down ico-arrow-s-gray"></i></a>
            </div>
            <div class="m-list-types">
                <ul class="m-list-types-list">
                        <li class="selected "><a href="/index.php/Home/MiaoSha/renqi">人气</a></li>
                        <li class=" "><a href="/index.php/Home/MiaoSha/zuixin">最新</a></li>
                        <li class=" "><a href="/index.php/Home/MiaoSha/shenyu">剩余人次</a></li>
                        <li class=" "><a href="/index.php/Home/MiaoSha/zrenqi">总需人次<i class='ico ico-sort2Arrow'></i></a></li>
                </ul>
            </div>
            <!-- 所有分类列表 -->
            <div class="m-list-catlog" style="display: none">
                <ul class="m-list-catlog-list">
                        <li class="selected"><a href="http://m.1.163.com/list/0-0-1-1.html"><i class="ico ico-type ico-type-0"></i>全部商品</a></li>
                        <li><a href="http://m.1.163.com/list/1-0-1-1.html"><i class="ico ico-type ico-type-1"></i>手机平板</a></li>
                        <li><a href="http://m.1.163.com/list/2-0-1-1.html"><i class="ico ico-type ico-type-2"></i>电脑办公</a></li>
                        <li><a href="http://m.1.163.com/list/3-0-1-1.html"><i class="ico ico-type ico-type-3"></i>数码影音</a></li>
                        <li><a href="http://m.1.163.com/list/4-0-1-1.html"><i class="ico ico-type ico-type-4"></i>女性时尚</a></li>
                        <li><a href="http://m.1.163.com/list/5-0-1-1.html"><i class="ico ico-type ico-type-5"></i>美食天地</a></li>
                        <li><a href="http://m.1.163.com/list/6-0-1-1.html"><i class="ico ico-type ico-type-6"></i>潮流新品</a></li>
                        <li><a href="http://m.1.163.com/list/7-0-1-1.html"><i class="ico ico-type ico-type-7"></i>网易周边</a></li>
                        <li><a href="http://m.1.163.com/list/8-0-1-1.html"><i class="ico ico-type ico-type-8"></i>其他商品</a></li>
                </ul>
            </div>
        </div>
        <!-- 正文 -->
        <div class="g-wrap g-body-bd">
            <div class="g-body-bd-mask" style="display:none;"></div>
            <!-- 商品列表 -->
            <div class="m-list-content">                 
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
             
        </div>
    </div>
</div>
	<a id="pro-view-1" class="w-miniCart " href="javascript:void(0);">
		<span class="w-miniCart-text">清单</span>
		<i class="ico ico-miniCart imgsss"></i>
		<!-- style="display:none"	-->
		<b class="w-miniCart-count" data-pro="count">2</b>
	</a>

</body>
</html>


			<br />
			<br />
		</div>
		<nav class="mui-bar mui-bar-tab">
			<a id="home" class="mui-tab-item" href="<?php echo U('Index/index', '', '');?>">
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