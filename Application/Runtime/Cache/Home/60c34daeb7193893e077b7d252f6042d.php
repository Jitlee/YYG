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
		<link href="http://at.alicdn.com/t/font_1448782434_6313894.css" rel="stylesheet" type="text/css" />
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
			<style type="text/css">
	

.userinfo{ background: none; border-top: none;}
.userinfo li{ border-top: none;}
.userinfo:before{ height: 0;}
.userinfo:after{ height: 0;}
.userinfoin{ padding:0 17px;}
.userinfoinimg{margin-right: 17px !important;width: 65px !important; height: 65px !important; border-radius: 50%; max-width: 65px !important; border: 1px solid #808182;  overflow: hidden;}
.userinfoinimg img{width: 100%; height: 100%;border-radius: 50%;}
.yyg-progress-bar  { margin-left: 80px}
.yyg-list-price{ padding-left: 80px;}
.yyg-progress .yyg-progressing {height:6px; }	
.yyg-progress {margin-bottom:5px;}
.yyg-del { float:right; padding-right: 10px;}
</style>
 
 
<header class="mui-bar mui-bar-nav">
	  <button class="mui-btn mui-btn-link mui-btn-nav mui-pull-left" onclick="history.go(-1)">
			<span class="mui-icon mui-icon-left-nav" ></span>
	    	返回
	  </button>
	  <h1 class="mui-title">秒杀记录</h1>
</header>
<div id="goodCategories" class="yyg-category">
	<ul class="yyg-category-left">
		
	</ul>
	<ul class="yyg-category-right">
		
	</ul>
</div>
<ul id="goodList" class="yyg-goods-list">
</ul>
					
 
<li class="mui-table-view-cell mui-media userinfoin  mui-hidden" id="goodTemplateing">
	
		<div class="mui-media-object mui-pull-left userinfoinimg">
        <img src="http://dcloudio.github.io/mui/assets/img/shuijiao.jpg">
        </div>
        
		<div class="mui-media-body">
			<a href="#" class="goodurl">
				<p class="userinfonh" style="color:#ff0000;">进行中</p>
				<p class="zcontent" style="color:#252525;">(第53期)xx</p>
				<p class='mui-ellipsis userinfot gray6' style="color:#535353;">购买时间：<em class="gray6 ztime"> 2015-11-28 15:12:00.000</em></p>
				<div class="yyg-progress-bar yyg-view-margin">
					<div class="yyg-progress">
						<div class="yyg-progressing" style="width:default=0}%"></div>
					</div>
					<div class="yyg-progess-indicator">
						<span class="yyg-progess-l pl"><?php echo ($data["canyurenshu"]); ?></span>
						<span class="yyg-progess-c pc"><?php echo ($data["zongrenshu"]); ?></span>
						<span class="yyg-progess-r pr"><?php echo ($data["shengyurenshu"]); ?></span>
					</div>
					<div class="yyg-progess-label">
						<span class="yyg-progess-l">已参与</span>
						<span class="yyg-progess-c">总需</span>
						<span class="yyg-progess-r">剩余</span>
					</div>
				</div>
				 
			</a>			
		</div>
	
</li>

<li class="mui-table-view-cell mui-media userinfoin  mui-hidden" id="goodTemplate">
	<a href="#" class="goodurl">
		<div class="mui-media-object mui-pull-left userinfoinimg">
        <img src="http://dcloudio.github.io/mui/assets/img/shuijiao.jpg">
        </div>
		<div class="mui-media-body">
			<p class="userinfonh" style="color:#ff0000;">已揭晓</p>
			<p class="zcontent" style="color:#252525;">(第53期)xx</p>
			<p class='mui-ellipsis userinfot' style="color:#535353;">获得者：<em class="blue">134****4666</em></p>
			<p class='mui-ellipsis userinfot gray6' style="color:#535353;">揭晓时间：<em class="gray6 ztime"> 2015-11-28 15:12:00.000</em></p>
		</div>
	</a>
</li>
        
<script type="text/javascript">
	$(function(){
		
		$(document).bind("scroll", onscrollend);
		
		function onscrollend() {
			if ($(window).scrollTop() + $(window).height() == $(document).height()) {
       			console.info("滚动到底了");
				pageAll();
			}
		}
		
		// 全部商品翻页
		var pageNum = 0;
		var goodList = $("#goodList");
		var goodTemplate = $("#goodTemplate");
		var goodTemplateing=$("#goodTemplateing");
		var useTemplate;
		var orderType = 1;
		function pageAll(clear) {
			if(clear) {
				pageNum = 0;
			}
			$.get("<?php echo U('pageAllMR', '', '');?>/8/" + (++pageNum), {
				type: orderType
				 
			}, function(list) {
				if(clear) {
					goodList.html("");
				}
	       		$.each(list, function() {
	       			useTemplate=goodTemplateing;
	       			if(this.jishijiexiao==1)
	       			{
	       				useTemplate=goodTemplate;
	       			}
	       			
	       			var item = useTemplate.clone().removeClass("mui-hidden").removeAttr("id");
	       			$(".goodurl", item).attr("href", "<?php echo U('/Home/Index', '', '');?>/" + this.gid);

					$("img", item).attr("src", this.thumb);
	       			$(".zcontent", item).text("(第" + this.qishu + "期) " + this.title);
	       			$(".yyg-progressing", item).css("width", 100 * (this.canyurenshu/this.zongrenshu) + "%");
	       			$(".money", item).text(this.zongrenshu);
	       			$("r", item).text(this.canyurenshu);
	       			
	       			$(".pl", item).text(this.canyurenshu);
					$(".pc", item).text(this.zongrenshu);
					$(".pr", item).text(this.shengyurenshu);
	       			
	       			$(".ztime", item).text(this.time);
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