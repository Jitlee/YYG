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
		<link href="http://at.alicdn.com/t/font_1447592374_6820765.css" rel="stylesheet" type="text/css" />

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
			<style type="text/css">
	.tuijian {
		display: flex;
		background: #fff;
		line-height: 1;
	}
	
	.tuijian-img-container {
		display: -webkit-box;
		-webkit-box-orient: horizontal;
		-webkit-box-pack: center;
		-webkit-box-align: center;
		display: -moz-box;
		-moz-box-orient: horizontal;
		-moz-box-pack: center;
		-moz-box-align: center;
		display: -o-box;
		-o-box-orient: horizontal;
		-o-box-pack: center;
		-o-box-align: center;
		display: -ms-box;
		-ms-box-orient: horizontal;
		-ms-box-pack: center;
		-ms-box-align: center;
		display: box;
		box-orient: horizontal;
		box-pack: center;
		box-align: center;
	}
	
	.tuijian-img {
		width: 30vw;
		margin-left:3vw;
	}
	
	.tuijian-content {
		flex: 1;
		margin: 3vw;
	}
	
	.tuijian-content-title {
		color: #333;
		line-height: 1;
		margin-bottom: 5px;
	}
	
	.tuijian-content h5,
	.tuijian-content .iconfont {
		line-height: 25px;
		font-size: 12px;
	}
	
	r {
		color: red;
	}
	
	.tuijian-content .larger {
		font-size: 24px
	}
	
	.tuijian-content .small {
		font-size: 8px
	}
	
	.tuijian-content label {
		margin-right: 1vw;
	}
	
	.mui-btn,
	button {
		border-radius: 0;
		padding-left: 30px;
		padding-right: 30px;
	}
	
	.mui-btn-red {
		color: #fff;
		border: 1px solid #FF002B;
		background-color: #FF002B;
	}
	
	d {
		font-family: "digitalfont"!important;
	  	-webkit-font-smoothing: antialiased;
	  	-webkit-text-stroke-width: 0.2px;
	  	-moz-osx-font-smoothing: grayscale;
	  	font-size:14px;
	  	display:inline-block;
	  	background-color: #333;
		color:#fff;
		padding: 2px 3px;
    		margin: 0px 2px;
    		line-height: 1;
	}
	
	@media only screen and (max-width: 330px) {
		d {
			font-size:13px;
			padding: 1px 1px;
	    		margin: 0px 1px;
    		}
	}
	
</style>
<?php if(isset($tuijian)): ?><section class="mui-content-padded" style="display:flex;background-color: #fff;">
		<div class="tuijian-img-container">
			<img class="tuijian-img" src="<?php echo ($tuijian["thumb"]); ?>" />
		</div>
		<div class="tuijian-content">
			<p class="tuijian-content-title"><?php echo ($tuijian["title"]); ?></p>
			<h5><i class="iconfont icon-renminbi"></i><label>当前价格</label><r class="small">¥</r> <r class="larger"><?php echo ($tuijian["zuigaojia"]); ?></r></h5>
			<h5><i class="iconfont icon-add"></i><label>出价次数</label><?php echo ($tuijian["chujiacishu"]); ?>次</h5>
			<h5><i class="iconfont icon-weibiaoti5"></i><label>剩余时间</label><time countdown="<?php echo (strtotime($tuijian["end_time"])); ?>"></time></h5>
			<button type="button" class="mui-btn mui-btn-red">我要出价</button>
		</div>
	</section><?php endif; ?>
<script type="text/javascript">
	$(function(){
		
		var countdownHTML = "<d>0</d><d>0</d>:<d>0</d><d>0</d>:<d>0</d><d>0</d>";
		var countdowns = $("time").each(function() {
			$this = $(this);
			$this.append("<d>0</d><d>0</d>:<d>0</d><d>0</d>:<d>0</d><d>0</d>");
			this.countdown = Number($this.attr("countdown"));
			this.digits = this.getElementsByTagName("d");
		});
		window.setInterval(function() {
			var now = Math.floor(new Date().getTime() / 1000);
			countdowns.each(function(){
				$this = this;
				var time = this.countdown - now;
				var hours = Math.min(Math.floor(time / 3600), 99);
				var muintes = Math.floor(time / 60) % 60;
				var seconds = time%60;
				hours = hours > 9 ? String(hours) : "0" + hours;
				muintes = muintes > 9 ? String(muintes) : "0" + muintes;
				seconds = seconds > 9 ? String(seconds) : "0" + seconds;
				this.digits[0].innerHTML = hours[0];
				this.digits[1].innerHTML = hours[1];
				this.digits[2].innerHTML = muintes[0];
				this.digits[3].innerHTML = muintes[1];
				this.digits[4].innerHTML = seconds[0];
				this.digits[5].innerHTML = seconds[1];
			});
		}, 1000);
		
	});
</script>
		</div>
		<nav class="mui-bar mui-bar-tab">
			<a id="home" class="mui-tab-item" href="<?php echo U('Home/index', '', '');?>">
				<span class="mui-icon mui-icon-home"></span>
				<span class="mui-tab-label">首页</span>
			</a>
			<a id="miaosha" class="mui-tab-item" href="<?php echo U('Miaosha/index', '', '');?>">
				<span class="mui-icon mui-icon-email"><span class="mui-badge">9</span></span>
				<span class="mui-tab-label">秒杀</span>
			</a>
			<a id="xiangou" class="mui-tab-item" href="<?php echo U('Xiangou/index', '', '');?>">
				<span class="mui-icon mui-icon-contact"></span>
				<span class="mui-tab-label">限购</span>
			</a>
			<a id="paimai" class="mui-tab-item" href="<?php echo U('Paimai/index', '', '');?>">
				<span class="mui-icon mui-icon-gear"></span>
				<span class="mui-tab-label">拍卖</span>
			</a>
			<a id="person" class="mui-tab-item" href="<?php echo U('Person/me', '', '');?>">
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
		
		$("#<?php echo ((isset($pid) && ($pid !== ""))?($pid):'index'); ?>").addClass("mui-active");
	});
</script>