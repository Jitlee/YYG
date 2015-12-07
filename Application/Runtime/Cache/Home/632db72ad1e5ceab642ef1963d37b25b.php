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
			<style type="text/css">
	.yyg-bar-nav {
		display:flex;
		line-height: 40px;
		text-align: center;
		border-bottom:solid 1px #D5D5D5;
		background:#fff;
		width: 100%;
		font-size: 16px;
	}
	
	@media only screen and (max-width: 340px) {
		.yyg-bar-nav {
			font-size: 12px;
		}
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
		position: relative;
	}
	
	.yyg-good-cart{
		display: block;
		position:absolute;
		top:10px;
		right:10px;
		height:30px;
		width:30px;
		border-radius: 15px;
		line-height: 30px;
		text-align: center;
		background-color:#FF002B;
		color:#fff;
	}
	
	.yyg-good-cart .iconfont {
		font-size:24px;
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
	
	
	.yyg-category {
		position: absolute;
		background: rgba(0,0,0,0.1);
		width:100%;
		display:none;
		z-index: 999;
	}
	
	.yyg-category ul {
		list-style: none;
		padding: 0;
		margin: 0;
		background: #fff;
	}
	
	.yyg-category ul:after {
		content: " ";
		display: block;
		clear: both;
		visibility: hidden;
		height: 1px;
	}
	.yyg-category li {
		width:33%;
		color: #999;
		box-sizing: border-box;
		-ms-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		-o-box-sizing: border-box;
		border-left:solid 1px #D5D5D5;
		border-bottom:solid 1px #D5D5D5;
		float:left;
		text-align: center;
		line-height: 45px;
	}
	
	.yyg-category li.yyg-active {
		color:#FF002B;
	}
	
	#buttonCategoy i:before{
		content:"\e608";
	}
	
	#buttonCategoy.yyg-active i:before{
		content:"\e609";
	}
	
	.yyg-category.yyg-active {
		display:block;
	}
	
	.yyg-progress, .yyg-progress .yyg-progressing {
		height:4px;
	}
	
	.yyg-progress {
		margin-bottom:5px;
	}
</style>
<ul class="yyg-tab">
	<li class="yyg-tab-item <?php if($tabId == 1): ?>yyg-active<?php endif; ?>">
		<a href="<?php echo U('Index/all','','');?>">
			热门秒杀
		</a>
	</li>
	<li class="yyg-tab-item <?php if($tabId == 2): ?>yyg-active<?php endif; ?>">
		<a href="<?php echo U('Jiexiao/index','','');?>">
			最新揭晓
		</a>
	</li>
</ul>
<div id="goodNav" class="yyg-bar-nav">
	<a id="buttonCategoy" type="0" href="javascript:void(0);" class="yyg-bar-nav-primary "><span><?php echo ((isset($categoryName) && ($categoryName !== ""))?($categoryName):'商品分类'); ?></span><i class="iconfont"></i></a>
	<a type="1" href="javascript:void(0);" class="yyg-bar-nav-btn yyg-active">人气</a>
	<a type="2" href="javascript:void(0);" class="yyg-bar-nav-btn">最新</a>
	<a type="3" href="javascript:void(0);" class="yyg-bar-nav-btn">剩余人次</a>
	<a type="4" href="javascript:void(0);" class="yyg-bar-nav-btn">总需人次</a>
</div>

<div id="goodCategories" class="yyg-category">
	<ul>
		
	</ul>
</div>
<ul id="goodList" class="yyg-goods-list">
</ul>
				
<li id="goodTemplate" class="mui-hidden yyg-goods-list-item">
	<a href="">
		<div>
			<div class="yyg-good-cart">
				<i class="iconfont icon-jiarugouwuche"></i>
			</div>
			<div class="yyg-goods-img-container">
			</div>
			<div class="yyg-goods-media">
				<p class="yyg-content-title"></p>
				<div class="yyg-progress">
					<div class="yyg-progressing" style="width:0%"></div>
				</div>
				<div class="yyg-list-price">
					<span>¥<r>1</r></span><span class="yyg-del">¥</span><span class="yyg-del money">19</span>
					<span class="yyg-right yyg-list-buy"><i class="yyg-list-buy-sts"></i>去抢购</span>
				</div>
			</div>
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
		var goodCid = <?php echo ((isset($category) && ($category !== ""))?($category):0); ?>;
		var orderType = 1;
		function pageAll(clear) {
			if(clear) {
				pageNum = 0;
			}
			$.get("<?php echo U('pageAll', '', '');?>/8/" + (++pageNum), {
				type: orderType,
				cid: goodCid
			}, function(list) {
				if(clear) {
					goodList.html("");
				}
	       		$.each(list, function() {
	       			var item = goodTemplate.clone().removeClass("mui-hidden").removeAttr("id");
	       			$("a", item).attr("href", "/index.php/Home/Index/" + this.gid);
					$(".yyg-goods-img-container", item).css("background-image", "url(" + this.thumb + ")");
					if(this.xiangou > 0) {
						item.addClass('yyg-xiangou');
					}
	       			$("p", item).text("(第" + this.qishu + "期) " + this.title);
	       			$(".yyg-progressing", item).css("width", 100 * (this.canyurenshu/this.zongrenshu) + "%");
	       			$("span.money", item).text(this.money);
	       			$(".yyg-good-cart", item).attr("gid", this.gid);
	       			$("r", item).text(this.danjia);
	       			goodList.append(item);
	       		});
	       });
		}
		pageAll();
		
		var goodNav = $("#goodNav").on("touchend", "a.yyg-bar-nav-btn", function() {
			var $this = $(this);
			if($this.hasClass("yyg-active")) {
				return;
			}
			$("a.yyg-active", goodNav).removeClass("yyg-active");
			$this.addClass("yyg-active");
			orderType = $this.attr("type");
			pageAll(true);
		});
		var goodCategories = $("#goodCategories");
		var categories = null;
		var buttonCategoy = $("#buttonCategoy").click(function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			buttonCategoy.toggleClass("yyg-active");
			goodCategories.toggleClass("yyg-active");
			
			var $this = $(this);
			var scrollTop = $this.parent().offset().top - $this.height();
			if(scrollTop > 10) {
				$('html,body').animate({ scrollTop: scrollTop });
			}
			
			if(!categories) {
				$.get("<?php echo U('category', '', '');?>", null, function(list){
					categories = list;
					$.each(list, function(index) {
						$("<li>").text(this.name)
							.attr("index", index)
							.attr("cid", this.cid)
							.appendTo(ulCategories);
					});
					
					if(goodCid == 0) {
						$(">li:first-child",ulCategories).addClass("yyg-active");
					} else {
						$("li[cid='"+ goodCid +"']",ulCategories).addClass("yyg-active");
					}
				});
			}
			
			if(buttonCategoy.hasClass("yyg-active")) {
				window.addEventListener("click", onclosecategory);
			} else {
				window.removeEventListener("click", onclosecategory);
			}
		});
		
		function onclosecategory() {
			buttonCategoy.toggleClass("yyg-active");
			goodCategories.toggleClass("yyg-active");
			window.removeEventListener("click", onclosecategory);
			console.log("自动关闭");
		}
		
		
		var ulCategories = $("ul", goodCategories)
			.on("touchend", "li", oncategory);
			
		function oncategory(evt) {
			var $this = $(this);
			if(evt && evt.stopPropagation) {
				evt.stopPropagation();
				evt.preventDefault();
			}
			if($this.hasClass("yyg-active")) {
				return;
			}
			$("li.yyg-active", ulCategories).removeClass("yyg-active");
			$this.addClass("yyg-active");
			
			goodCid = $this.attr("cid");
			pageAll(true);
			buttonCategoy.toggleClass("yyg-active");
			goodCategories.toggleClass("yyg-active");
			$("span", buttonCategoy).text($this.text());
			window.removeEventListener("click", onclosecategory);
		}
		
		goodList.on("click", ".yyg-good-cart", function(evt) {
			evt.stopPropagation();
			evt.preventDefault();
			var $this = $(this);
			var gid = $this.attr("gid");
			$.post("<?php echo U('Cart/add', '', '');?>/" + gid + "/1", null, function(result) {
				new Android_Toast({content: result.message});
			})
		});
		
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