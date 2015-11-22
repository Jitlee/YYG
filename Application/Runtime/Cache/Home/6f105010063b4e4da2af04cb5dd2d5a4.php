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
		<link href="http://at.alicdn.com/t/font_1448212068_2954175.css" rel="stylesheet" type="text/css" />
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
	.mui-content {
		padding-bottom: 100px;
	}
	.yyg-cart-item {
		position: relative;
		padding-top:10px;
		padding-bottom:10px;
	}
	
	.yyg-cart-img-container {
		position: absolute;
		width:75px;
		height:75px;
		border:solid 1px #D5D5D5;
		top:50%;
		left:15px;
		transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-moz-transform: translateY(-50%);
		-o-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
	}
	
	.yyg-cart-img-container img {
		width:100%;
		height:100%;
	}
	
	.yyg-cart-body {
		margin-left:85px;
	}
	
	.yyg-cart-body input[type=number] {
		width:85px;
		padding:3px;
		margin:0;
		height:auto;
	}
	
	.yyg-cart-title {
		color:#666;
		text-overflow:ellipsis;
		white-space:nowrap;
		overflow:hidden;
		font-size: 16px;
	}
	
	.yyg-cart-body .iconfont {
		font-size: 24px;
		color: #8f8f94;
	}
	
	.yyg-cart-remove {
		float: right;
	}
	
	.yyg-cart-footer {
		background-color: #fff;
		border-top:solid 1px #d5d5d5;
		position: fixed;
		bottom:50px;
		height:50px;
		width:100%;
		padding-top: 2px;
    		padding-left: 8px;
	}
	
	.yyg-cart-footer .yyg-btn {
		position:absolute;
		top:50%;
		-webkit-transform: translateY(-50%);
		transform: translateY(-50%,-50%);
		-moz-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		-o-transform: translateY(-50%);
		right:5px;
		width: 100px;
	}
	
	#emptyBlock {
		text-align: center;
		font-size:20px;
		color:#666;
		padding: 20px 0;
	}
	
	#emptyBlock .iconfont {
		font-size: 120px;
		line-height: 150px;
	}
	
</style>

<?php if(isset($list)): ?><ul class="mui-table-view yyg-cart">
	<?php if(is_array($list)): foreach($list as $key=>$item): ?><li class="mui-table-view-cell yyg-cart-item">
			<div class="yyg-cart-img-container">
				<img src="<?php echo ($item["good"]["thumb"]); ?>"/>
			</div>
			<div class="yyg-cart-body">
				<p class="yyg-cart-title">(第 <?php echo ($item["good"]["qishu"]); ?> 期)<?php echo ($item["good"]["title"]); ?></p>
				<h5>剩余<?php echo ($item["good"]["shengyurenshu"]); ?>人次</h5>
				<input type="number" name="count" cid="<?php echo ($item["id"]); ?>" dj="<?php echo ($item["good"]["danjia"]); ?>" value="<?php echo ($item["count"]); ?>" bk="<?php echo ($item["count"]); ?>" class="mui-input" />
				<a class="yyg-cart-remove yyg-btn yyg-btn-link" cid="<?php echo ($item["id"]); ?>"><i class="iconfont icon-remove"></i></a>
			</div>
		</li><?php endforeach; endif; ?>
</ul><?php endif; ?>
<div id="emptyBlock" <?php if(isset($list)): ?>style="display:none"<?php endif; ?>>
	<i class="iconfont icon-emptyshoppingbag"></i>
	<br/>
	购物车为空
</div>
<footer id="footer" class="yyg-cart-footer" <?php if(!isset($list)): ?>style="display:none"<?php endif; ?>>
	<span>合计 <r id="totalMoney" class="larger">¥2.00</r></span>
	<h5>共<span id="goodCount">1</span>个商品</h5>
	<div class="yyg-btn yyg-btn-primary">去结算</div>
</footer>

<script type="text/javascript">
	$(function() {
		function sum() {
			var total = 0;
			var count = 0;
			$(".yyg-cart-item input").each(function() {
				$this = $(this);
				total += Number($this.attr("dj")) * Number($this.val());
				count++;
			});
			$("#goodCount").text(count);
			$("#totalMoney").text("¥" + total.toFixed(2));
		}
		
		var inputHandler = null;
		$(".yyg-cart-item input").bind("input", function() {
			$this = $(this);
			window.clearTimeout(inputHandler);
			inputHandler = window.setTimeout(function() {
				var id = $this.attr("cid");
				var count = $this.val();
				var bkCount = $this.attr("bk");
				if(count > 0) {
					$.post("<?php echo U('edit', '', '');?>/" + id + "/" + count, null, function(result) {
						if(result.status == 1) {
							sum();
							$this.attr("bk", count);
						} else { // 失败
							new Android_Toast({content: "修改失败"});
							$this.val(bkCount);
						}
					});
				}
			}, 200);
		}).bind("blur", function() {
			$this = $(this);
			var count = $this.val();
			var bkCount = $this.attr("bk");
			if(!(count > 0)) {
				$this.val(bkCount);
			}
		});
		
		sum();
		
		$(".yyg-cart-remove").click(function() {
			$this = $(this);
			var id = $this.attr("cid");
			$.post("<?php echo U('remove', '', '');?>/" + id, null, function(result) {
				if(result.status == 1) {
					$this.closest(".yyg-cart-item").remove();
					count();
					if($(".yyg-cart-item").length == 0) {
						$("#emptyBlock").show();
						$("#footer").hide();
					}
				} else { // 失败
					new Android_Toast({content: "删除失败"});
					$this.val(bkCount);
				}
			});
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
			<a id="person" class="mui-tab-item" href="<?php echo U('OrderPay/demo', '', '');?>">
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