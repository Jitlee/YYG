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
			<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>我的</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<script src="../sea.js"></script>
 
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<link href="/Public/Home/css/me.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript">
	   		seajs.initReady(function(){
				seajs.use(["util", "ko", "md5"],function(){
					seajs.use("me");
				});				
			});
   		</script>
   		<script type="text/javascript">
	   		$(function() {
	   			
	   			$("#recharge").click(function() {
					window.location.href="<?php echo U('Person/recharge', '', '');?>";
				});
				//秒杀记录
				$("#miaoshaRecord").click(function() {
					window.location.href="<?php echo U('Person/miaoshaRecord', '', '');?>";
				});
				//中奖记录
				$("#miaoshazj").click(function() {	
					window.location.href="<?php echo U('Person/miaoshazj', '', '');?>";
				});
				//已晒单
				$("#miaoshasdfinish").click(function() {
					window.location.href="<?php echo U('Person/miaoshasdfinish', '', '');?>";
				});
				//未晒单
				$("#miaoshasdno").click(function() {
					window.location.href="<?php echo U('Person/miaoshasdno', '', '');?>";
				});
				//用户信息
				$("#userinfotop").click(function() {
					window.location.href="<?php echo U('Person/userinfoitem', '', '');?>";
				});
				//充傎记录
				$("#rechargerecord").click(function() {
					window.location.href="<?php echo U('Person/wallet', '', '');?>";
					//window.location.href="<?php echo U('Person/rechargerecord', '', '');?>";
				});
				$("#userscore").click(function() {
					window.location.href="<?php echo U('Person/userscore', '', '');?>";
				});
				$("#yaoqing").click(function() {
					window.location.href="<?php echo U('Person/yaoqing', '', '');?>";
				});
				
			});
		</script>
	</head>
	
	<body>

		<div class="mui-content">
			<ul class="mui-table-view"> 
				<li class="mui-table-view-cell cell-top"  id="userinfotop">
					<a class="mui-navigate-right">
						<span class="user-cell4">
							<img class="user-img" alt="" src="/Public/Home/images/<?php echo ($data["img"]); ?>">						 
						</span>						 
						<span class="user-cell_right">							 
							<p data-bind="text: nickName"><?php echo ($data["username"]); ?></p>
							<p data-bind="text: nickName"><?php echo ($data["mobile"]); ?></p>
						</span>
					</a>
				</li>
				
				 
				<li class="mui-table-view-cell " data-bind="visible: isLogin">
						<a class="mui-navigate-right">
								<div class="img-tip">
									<img alt="我的钱包" src="/Public/Home/images/person/yyg_icon_wdqb.png"/>
								</div>
								<div class="menu-content">
									<p>我的钱包</p>
								</div>
							 
							<span class="cell-right" id="recharge">
								<span class="mui-badge mui-badge-danger">我要充值</span>							 
							</span>
						</a>
				</li>
				<li class="userline land-cell" data-bind="visible: isLogin" id="loginUser">
					<span class="cell-left" id="userscore">
						<img class="circle-img" alt="积分" src="/Public/Home/images/person/yyg_icon_jf.png">
						<p data-bind="text: nickName">积分：<?php echo ($data["score"]); ?></p>
					</span>
					<a></a>
					<span class="cell-right" data-bind="style: { 'display': hasOtherhalf() ? 'none' : 'inline-block'}" id="rechargerecord">
						<img class="circle-img" alt="红包" src="/Public/Home/images/person/iconfont-jiaofei.png">
						<p>余额:<?php echo ($data["money"]); ?></p>
					</span>					
				</li>
				
				<li class="mui-table-view-cell " data-bind="visible: isLogin">					 
						<div class="img-tip">
							<img alt="我的秒杀" src="/Public/Home/images/person/yyg_icon_wdms.png"/>
						</div>
						<div class="menu-content">
							<p>我的秒杀</p>
						</div> 
					 
				</li>
				<li class="userline land-cell">
					<span class="land-cell4"  id="miaoshaRecord">
						<img class="circle-img" alt="秒杀记录" src="/Public/Home/images/person/yyg_icon_msjl.png">
						<p data-bind="text: nickName">
								秒杀记录 
						</p>
					</span>
					 
					<span class="land-cell4"  id="miaoshazj">
						<img class="circle-img" alt="中奖记录" src="/Public/Home/images/person/yyg_icon_zjjl.png">
						<p data-bind="text: nickName">
							中奖记录 
						</p>
					</span>
					 
					<span class="land-cell4"  id="miaoshasdfinish">
						<img class="circle-img" alt="已晒单" src="/Public/Home/images/person/yyg_icon_ysd.png">
						<p data-bind="text: nickName">
							已晒单 
						</p>
					</span>
					 
					<span class="land-cell4" id="miaoshasdno">
						<img class="circle-img" alt="未晒单" src="/Public/Home/images/person/yyg_icon_wsd.png">
						<p data-bind="text: nickName">
							未晒单
						</p>
					</span>
				</li>
				
				<!--<li class="mui-table-view-cell" id="feedback">
					<a class="mui-navigate-right">
						<div class="img-tip">
							<img alt="反馈" src="/Public/Home/images/person/yyg_icon_wdpl.png"/>
						</div>
						<div class="menu-content">
							<p>我的评论</p>
						</div>
					</a>
				</li>-->
				<li class="mui-table-view-cell" id="yaoqing">
					<a class="mui-navigate-right">
						<div class="img-tip">
							<img alt="关于" src="/Public/Home/images/person/yyg_icon_wdyq.png"/>
						</div>
						<div class="menu-content">
							<p>我的邀请</p>
						</div>
					</a>
				</li>
				<li class="mui-table-view-cell" id="about">
					<a class="mui-navigate-right" href="<?php echo U('Person/loginexit', '', '');?>">
						<div class="img-tip">
							<img alt="关于" src="/Public/Home/images/person/yyg_icon_wdyq.png"/>
						</div>
						<div class="menu-content">
							<p>注销</p>
						</div>
					</a>
				</li>
			</ul>
		</div>
		

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
			<a id="jiexiao" class="mui-tab-item" href="<?php echo U('Jiexiao/index', '', '');?>">
				<span class="mui-icon iconfont icon-jiangbei"></span>
				<span class="mui-tab-label">秒杀</span>
			</a>
			<a id="paimai" class="mui-tab-item" href="<?php echo U('Paimai/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_paimai"></span>
				<span class="mui-tab-label">拍卖</span>
			</a>
			<a id="cart" class="mui-tab-item" href="<?php echo U('Cart/index', '', '');?>">
				<span class="mui-icon iconfont icon-yyg_cart"></span>
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
	});
</script>