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
			<style type="text/css">
	.mui-scroll-wrapper{
		overflow: auto;
	}
	
	.mui-slider-indicator {
		background-color: #fff;
	}
	
	.yyg-bar-nav {
		display:flex;
		line-height: 40px;
		text-align: center;
		border-bottom:solid 1px #D5D5D5;
	}
	
	.yyg-bar-nav a{
		color:#999;
	}
	
	.yyg-bar-nav-primary {
		width: 90px;
		border-right:solid 1px #D5D5D5;
	}
	
	.yyg-bar-nav-btn {
		flex:1;
		-webkit-flex:1;
		-ms-flex:1;
		-moz-flex:1;
		-o-flex:1;
	}
	
	.yyg-bar-nav-btn.yyg-active {
		color: #db3652;
	}
	
	.yyg-goods-list-item {
		background-color: #fff;
	}
	.yyg-goods-media {
		background:none;
		position: relative;
	}
	
	.yyg-goods-media span {
		color:rgba(171,171,171,1);
		margin:0 2px;
	}
	
	.yyg-goods-media r{
		font-size: 20px;
	}
	
	p.yyg-content-title {
		color:#333;
		font-size:14px;
	}
	
	.yyg-list-price {
		position: relative;
		
	}
	
	.yyg-right {
		display:block;
		position: absolute;
		top:50%;
		right:5px;
		text-align: right;
		transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		-moz-transform: translateY(-50%);
		-o-transform: translateY(-50%);
	}
	
	.yyg-list-buy{
		background-color:rgba(255,102,0,1);
		color:#fff!important;
	    height: 18px;
	    line-height: 18px;
	    border-radius: 9px 0 0 9px;
	    font-size:12px;
	    padding-right:5px;
	    padding-left:5px;
	}
	
	.yyg-list-buy-sts {
		display: inline-block;
		background-position:50% 50%;
		background-repeat: no-repeat;
		background-size: cover;
		background-image: url(/Public/Home/images/sts.png);
		width:11px;
		height:11px;
		vertical-align: middle;
	}
	
	.yyg-del {
		text-decoration: line-through;
	}
	
	.yyg-goods-list-item hr {
		border: none;
		border-top: 1px dotted rgba(252,226,198,1);
	}
	
</style>
<div id="slider" class="mui-slider">
	<div id="sliderSegmentedControl" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted mui-segmented-control-negative">
		<a class="mui-control-item" href="#itemall">全部商品</a>
		<a class="mui-control-item" href="#itemjiexiao">即将揭晓</a>
		<a class="mui-control-item" href="#itemshare">晒单分享</a>
	</div>
	<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-4"></div>
	<div class="mui-slider-group">
		<div id="itemall" class="mui-slider-item mui-control-content mui-active">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<div class="yyg-bar-nav">
						<a href="javascript:void(0);" class="yyg-bar-nav-primary">商品分类<i class="iconfont icon-dropdown"></i></a>
						<a href="javascript:void(0);" class="yyg-bar-nav-btn yyg-active">人气</a>
						<a href="javascript:void(0);" class="yyg-bar-nav-btn">最新</a>
						<a href="javascript:void(0);" class="yyg-bar-nav-btn">剩余人次</a>
						<a href="javascript:void(0);" class="yyg-bar-nav-btn">总需人次</a>
					</div>
					<ul id="goodList" class="yyg-goods-list">
					</ul>
					
					<li id="goodTemplate" class="mui-hidden yyg-goods-list-item">
						<a href="">
							<div>
								<div class="yyg-goods-img-container">
									<img class="yyg-goods-img" src="" />
								</div>
								<div class="yyg-goods-media">
									<p class="yyg-content-title"></p>
									<hr />
									<div class="yyg-list-price">
										<span>¥<r>1</r></span><span class="yyg-del">¥</span><span class="yyg-del money">19</span>
										<span class="yyg-right yyg-list-buy"><i class="yyg-list-buy-sts"></i>去抢购</span>
									</div>
								</div>
							</div>
						</a>
					</li>
				</div>
			</div>
		</div>
		<div id="itemjiexiao" class="mui-slider-item mui-control-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					2
				</div>
			</div>
		</div>
		<div id="itemshare" class="mui-slider-item mui-control-content">
			<div class="mui-scroll-wrapper">
				<div class="mui-scroll">
					3
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/Public/Home/js/mui.min.js"></script>
<script type="text/javascript">
	mui.init()
	$(function(){
		$(".mui-control-content").height($(window).height() - 132);
//		$('.mui-scroll-wrapper').scroll({
//			indicators: true //是否显示滚动条
//		});
				
		var slideNumber = 1;
		document.getElementById('slider').addEventListener('slide', function(e) {
			slideNumber = e.detail.slideNumber;
			switch(slideNumber) {
				case 1:
					break;
				case 2:
					break;
				case 3:
					break;
				default:
					break;
			}
		});
		
		$(".mui-scroll-wrapper").bind("scroll", onscrollend)/*.swipe({
			swipeUp: onscrollend,
			threshold: 100,
			allowPageScroll: "vertical"
		})*/;
		
		function onscrollend() {
			if ($(this).scrollTop() + $(this).height() == $(this).children().height()) {
       			console.info("滚动到底了");
       			switch(slideNumber) {
					case 1:
						pageAll();
						break;
					case 2:
						pageJiexiao();
						break;
					case 3:
						pageShare();
						break;
					default:
						break;
				}
			}
		}
		
		// 全部商品翻页
		allPageNum = 0;
		var goodList = $("#goodList");
		var goodTemplate = $("#goodTemplate");
		function pageAll() {
			$.get("<?php echo U('pageAll', '', '');?>/8/" + (++allPageNum), null, function(list) {
	       		$.each(list, function() {
	       			var item = goodTemplate.clone().removeClass("mui-hidden").removeAttr("id");
	       			$("img", item).attr("src", this.thumb);
	       			$("p", item).text(this.title);
	       			$("span.money", item).text(this.money);
	       			$("r", item).text(this.danjia);
	       			goodList.append(item);
	       		});
	       });
		}
		pageAll();
		
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