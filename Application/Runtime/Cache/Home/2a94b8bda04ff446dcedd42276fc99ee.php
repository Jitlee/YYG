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
			<style type="text/css">
	.yyg-bar-nav {
		display:flex;
		line-height: 40px;
		text-align: center;
		border-bottom:solid 1px #D5D5D5;
		background:#fff;
		width: 100%;
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
	
	.yyg-category {
		position: absolute;
		background: rgba(0,0,0,0.2);
		width:100%;
		height:100%;
		display:none;
		z-index: 99;
	}
	.yyg-category-left {
		display: block;
		width:40%;
		background-color: #ddd;
		height:360px;
		padding: 0;
		margin: 0;
		float:left;
		overflow: auto;
	}
	
	.yyg-category-left li {
		width:100%;
		text-align: center;
		color:#999;
		line-height: 45px;
		padding: 0;
		margin: 0;
	}
	
	.yyg-category-left li.yyg-active {
		color:#333;
		background-color:#fff;
	}
	
	.yyg-category-right {
		display: block;
		width:60%;
		height:360px;
		background-color:#fff;
		padding: 0;
		margin: 0;
		float:left;
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
	
	.yyg-category-right li {
		width:100%;
		color:#333;
		line-height: 45px;
		display: table;
	}
	
	.yyg-category-right li span {
		color:#333;
		display: table-cell;
		width:70%;
		padding-left:10px;
	}
	
	.yyg-category-right li label {
		color:#999;
		display: table-cell;
		width:30%;
		text-align: right;
		padding-right:10px;
	}
</style>
<div class="top w">
	<div class="m_banner" id="owl">
		<?php if(is_array($slides)): foreach($slides as $key=>$s): ?><a href="<?php echo ((isset($s["link"]) && ($s["link"] !== ""))?($s["link"]):'#'); ?>" class="item"><img src="<?php echo ($s["img"]); ?>"></a><?php endforeach; endif; ?>
	</div>
	<div class="m_nav">
		<?php if(is_array($allCategories)): foreach($allCategories as $key=>$c): ?><a href="#"><img src="<?php echo ((isset($c["thumb"]) && ($c["thumb"] !== ""))?($c["thumb"]):'/Public/Home/images/m-index_10.png'); ?>"><span><?php echo ($c["name"]); ?></span></a><?php endforeach; endif; ?>
	</div>
</div>
<div id="goodNav" class="yyg-bar-nav">
	<a id="buttonCategoy" type="0" href="javascript:void(0);" class="yyg-bar-nav-primary "><span>商品分类</span><i class="iconfont"></i></a>
	<a type="1" href="javascript:void(0);" class="yyg-bar-nav-btn yyg-active">人气</a>
	<a type="2" href="javascript:void(0);" class="yyg-bar-nav-btn">最新</a>
	<a type="3" href="javascript:void(0);" class="yyg-bar-nav-btn">剩余人次</a>
	<a type="4" href="javascript:void(0);" class="yyg-bar-nav-btn">总需人次</a>
</div>

<div id="goodCategories" class="yyg-category">
	<ul class="yyg-category-left">
		
	</ul>
	<ul class="yyg-category-right">
		
	</ul>
</div>
<ul id="goodList" class="yyg-goods-list">
</ul>
					
<li id="goodTemplate" class="mui-hidden yyg-goods-list-item">
	<a href="">
		<div>
			<div class="yyg-goods-img-container">
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
		var orderType = 1;
		function pageAll(clear) {
			if(clear) {
				pageNum = 0;
			}
			$.get("<?php echo U('pageAll', '', '');?>/8/" + (++pageNum), {
				type: orderType,
				cid: goodCid,
				bid: goodBid,
			}, function(list) {
				if(clear) {
					goodList.html("");
				}
	       		$.each(list, function() {
	       			var item = goodTemplate.clone().removeClass("mui-hidden").removeAttr("id");
	       			$("a", item).attr("href", "/index.php/Home/Index/" + this.gid);
//	       			$("img", item).attr("src", this.thumb);
					$(".yyg-goods-img-container", item).css("background-image", "url(" + this.thumb + ")");
	       			$("p", item).text(this.title);
	       			$("span.money", item).text(this.money);
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
			var scrollTop = $this.offset().top - $this.height();
			if(scrollTop > 0) {
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
					
					if(categories.length > 0) {
						categories[0].brands = [{
							name: "全部商品",
							bid: 0,
							count: categories[0].count
						}];
						oncategory.call($("li:first", ulCategories)[0]);
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
			console.log("自动关闭");
		}
		
		
		var ulCategories = $(".yyg-category-left", goodCategories)
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

			var index = Number($this.attr("index"));
			var cid = $this.attr("cid");
			$("li.yyg-active", ulCategories).removeClass("yyg-active");
			$this.addClass("yyg-active");
			if(categories[index].brands) {
				ulBrands.html("");
				renderBrands(categories[index].brands, cid);
			} else {
				$.get("<?php echo U('brands', '', '');?>/" + cid, null, function(list){
					categories[index].brands = list;
					ulBrands.html("");
					renderBrands(categories[index].brands, cid);
				});
			}
		}
		
		function renderBrands(brands, cid) {
			$.each(brands, function(index) {
				var li = $("<li>").attr("index", index).attr("bid", this.bid).attr("cid", cid);
				var span = $("<span>").text(this.name);
				var label = $("<label>").text("(" + this.count + ")");
				li.append(span);
				li.append(label);
				ulBrands.append(li);
			});
		}
		
		var goodCid = 0;
		var goodBid = 0;
		var ulBrands = $(".yyg-category-right", goodCategories).on("touchend", "li", function(evt){
			var $this = $(this);
			evt.stopPropagation();
			evt.preventDefault();
			buttonCategoy.toggleClass("yyg-active");
			goodCategories.toggleClass("yyg-active");
			if($this.hasClass("yyg-active")) {
				return false;
			}
			var needRefresh = $("li.yyg-active", ulBrands).removeClass("yyg-active").length > 0;
			$this.addClass("yyg-active");
			
			goodCid = $this.attr("cid");
			goodBid = $this.attr("bid");
			var name = $("span", $this).text();
			if(name == "全部") {
				name = $("li[cid='" + goodCid + "']", ulCategories).text();
			}
			$("span", buttonCategoy).text(name);
			
			if(needRefresh) {
				pageAll(true);
			}
			
			return false;
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