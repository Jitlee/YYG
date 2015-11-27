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
		<link href="http://at.alicdn.com/t/font_1448373727_1371717.css" rel="stylesheet" type="text/css" />
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
		<title>我</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<script src="../sea.js"></script>
		<style type="text/css">
			*{
				font-size: 16px;
			}
			ul.mui-table-view {
				background-color: #EFEFF4;
			}
			ul.mui-table-view li {
				background-color: #fff;
			}
			.avatar {
			  float: left;
			}
			.circle-img{
				width: 45px;
			  	height: 45px;
			  	border-radius: 50%;
			  	1box-shadow: 0 0 1px 1px rgba(130,130,130,0.7);
			}
			.user-img{
				width: 60px;
			  	height: 60px;
			  	border-radius: 50%;
			  	1box-shadow: 0 0 1px 1px rgba(130,130,130,0.7);
			}
			.user-cell4{				 
				display: inline-block;
				float:left;
			}
			.user-cell_right
			{
				position: relative;
				display: inline-block;
				width: 50%;
				margin-left: 20px;
				margin-top: 10px;
			}
			.cell-top>span{
				1display: inline-block;
				height: 100px;
				border: 0px;
				padding: 8px 0px;
				text-align: center;
			}
			.userInfo {
				float: left;
				margin-left: 20px;
			}
			.userInfo p {
				font-size: 1em;
				color: #333333;
			}
			
			.userInfo .phoneno{
				font-size: 0.8em;
				color: #666666;
			}
			#phoneno{
				font-size: 1em;
				color: #666666;
			}
			#otherhalfPhoneno{
				font-size: 1em;
				color: #666666;
			}
			.userline {
				margin-bottom: 12px;
			}
			.img-tip {
				float: left;
			}
			.img-tip img{
				width: 20px;
				height: 20px;
				margin-top: 3px;
				margin-left: 3px;
			}
			.menu-content{
				margin-left: 12px;
				line-height: 1.8em;
				float: left;
			}
			.menu-content p{
				font-size: 1em;
				color: #333333;
			}
			.menu-tip{
				line-height: 1.8em;
				float:right;
			}
			.menu-tip p{
				font-size: 12px;
				margin-right: 20px;
			}
			.menu-tip-higher{
				line-height: 2.8em;
				float:right;
			}
			.menu-tip-higher p{
				font-size: 12px;
				margin-right: 20px;
			}
			ul li.userline::after{
				background-color: #fff !important;
			}
			ul li.userline a::after{
				border: 0px;
			}
			.halfline{
				margin-top: -15px;
				border-top: 2px dotted #EFEFF4;
			}
			.land-cell{
				position: relative;
			}
			.land-cell a{
				display: inline-block;
				border-left: 1px outset #E1E1E1;
				height: 60px;
			}
			
			.land-cell>span{
				1display: inline-block;
				height: 80px;
				border: 0px;
				padding: 8px 0px;
				text-align: center;
			}
			.land-cell .cell-left{
				display: inline-block;
				width: 48%;
			}
			.land-cell .cell-right{
				position: absolute;
				top: 0px;
				right: 0px;
				width: 48%;
			}
			.land-cell4{
				position: relative;
				display: inline-block;
				width: 23%;
			}
			
			
			.land-cell img{
				width: 40px;
			  	height: 40px;
			}
			.land-cell_add{
				display: inline-block; 
				width: 40px; 
				height: 40px; 
				box-shadow: 0 0 1px 1px #E1E1E1;
				border-radius: 50%;
				background-color: #F1F1F1;
			}
			.land-cell_add i{
				margin-top: 4px;
				color: #666666;
				font-size: 34px;
				font-weight: 300;
			}
		</style>
	</head>

	<body>
		<div class="mui-content">
			<ul class="mui-table-view"> 
				<li class="mui-table-view-cell cell-top" id="recommend">
					<a class="mui-navigate-right">
						<span class="user-cell4">
							<img class="user-img" alt="秒杀记录" src="/Public/Home/images/person/yyg_icon_msjl.png">						 
						</span>						 
						<span class="user-cell_right">							 
							<p data-bind="text: nickName"><?php echo ($userinfo["openid"]); ?></p>
							<p data-bind="text: nickName">中奖记录</p>
						</span>
					</a>
				</li>
				
				 
				<li class="mui-table-view-cell " data-bind="visible: isLogin" id="setting">
						<a class="mui-navigate-right">
								<div class="img-tip">
									<img alt="我的钱包" src="/Public/Home/images/person/yyg_icon_wdqb.png"/>
								</div>
								<div class="menu-content">
									<p>我的钱包</p>
								</div>
							 
							<span class="cell-right" data-bind="style: { 'display': hasOtherhalf() ? 'none' : 'inline-block'}" id="addAccount1">
								<p>	我要充值</p>							 
							</span>
						</a>
				</li>
				<li class="userline land-cell" data-bind="visible: isLogin" id="loginUser">
					<span class="cell-left" id="userinfo">
						<img class="circle-img" alt="积分" src="/Public/Home/images/person/yyg_icon_hb.png">
						<p data-bind="text: nickName">积分：0.00</p>
					</span>
					<a></a>
					<span class="cell-right" data-bind="style: { 'display': hasOtherhalf() ? 'none' : 'inline-block'}" id="addAccount2">
						<img class="circle-img" alt="红包" src="/Public/Home/images/person/yyg_icon_hb.png">
						<p>红包:0</p>
					</span>					
				</li>
				
				<li class="mui-table-view-cell " data-bind="visible: isLogin" id="setting">
					 
						<div class="img-tip">
							<img alt="我的秒杀" src="/Public/Home/images/person/yyg_icon_wdms.png"/>
						</div>
						<div class="menu-content">
							<p>我的秒杀</p>
						</div>
					 
				</li>
				<li class="userline land-cell" id="recommend">
					<span class="land-cell4">
						<img class="circle-img" alt="秒杀记录" src="/Public/Home/images/person/yyg_icon_msjl.png">
						<p data-bind="text: nickName">秒杀记录</p>
					</span>
					 
					<span class="land-cell4">
						<img class="circle-img" alt="中奖记录" src="/Public/Home/images/person/yyg_icon_zjjl.png">
						<p data-bind="text: nickName">中奖记录</p>
					</span>
					 
					<span class="land-cell4" data-bind="style: { 'display': hasOtherhalf() ? 'none' : 'inline-block'}" id="addAccount">
						<img class="circle-img" alt="红包" src="/Public/Home/images/person/yyg_icon_ysd.png">
						<p>已晒单</p>
					</span>
					 
					<span class="land-cell4" data-bind="style: { 'display': hasOtherhalf() ? 'none' : 'inline-block'}" id="addAccount">
						<img class="circle-img" alt="红包" src="/Public/Home/images/person/yyg_icon_wsd.png">
						<p>未晒单</p>
					</span>
				</li>
				
				<li class="mui-table-view-cell" id="kkemail-li">
					<a class="mui-navigate-right">
						<div class="img-tip">
							<img alt="邮箱" src="/Public/Home/images/person/yyg_icon_wdsc.png"/>
						</div>
						<div class="menu-content">
							<p id="kkemail">我的收藏</p>
						</div> 
					</a>
				</li>
				<li class="mui-table-view-cell" id="feedback">
					<a class="mui-navigate-right">
						<div class="img-tip">
							<img alt="反馈" src="/Public/Home/images/person/yyg_icon_wdpl.png"/>
						</div>
						<div class="menu-content">
							<p>我的评论</p>
						</div>
					</a>
				</li>
				<li class="mui-table-view-cell" id="about">
					<a class="mui-navigate-right">
						<div class="img-tip">
							<img alt="关于" src="/Public/Home/images/person/yyg_icon_wdyq.png"/>
						</div>
						<div class="menu-content">
							<p>我的邀请</p>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<script type="text/javascript">
	   		seajs.initReady(function(){
				seajs.use(["util", "ko", "md5"],function(){
					seajs.use("me");
				});
			})
   		</script>
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
				<span class="mui-tab-label">最新揭晓</span>
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