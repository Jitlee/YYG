<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1449475927_2126234.css" rel="stylesheet" type="text/css" />
		<?php if(isset($images)): ?><link href="/Public/Home/css/idangerous.swiper.css" rel="stylesheet"><?php endif; ?>
		<link href="/Public/Home/css/mobile.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/android_toast.min.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<?php if(isset($images)): ?><script src="/Public/Home/js/idangerous.swiper-1.9.1.min.js"></script>
		<script src="/Public/Home/js/idangerous.swiper.scrollbar-1.2.js"></script><?php endif; ?>
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
		<div class="mui-content" style="padding-top: 0;padding-bottom: 54px;">
			<div class="yyg-body">
	<div class="swiper-outter">
		<div class="swiper-container swiper-loop">
		    <div class="swiper-wrapper">
		    	<?php if(is_array($images)): foreach($images as $key=>$image): ?><div class="swiper-slide" style="background-image: url(<?php echo ($image["image_url"]); ?>);"></div><?php endforeach; endif; ?>
		    </div>
		</div>
		<div class="pagination pagination-loop"></div>
	</div>
	
	<p class="yyg-view-title yyg-view-margin">
		<?php echo ($data["title"]); ?> <r><?php echo ($data["subtitle"]); ?></r>
	</p>
	<h5 class="yyg-view-margin"><label class="filed-label-60">当前价格</label><r>¥</r> <r class="larger"><span id="zuigaojiaLabel"><?php echo ($data["zuigaojia"]); ?></span></r></h5>
	<h5 class="yyg-view-margin"><label class="filed-label-60">起拍价格</label>¥ <?php echo ($data["qipaijia"]); ?></h5>
	<h5 class="yyg-view-margin"><label class="filed-label-60">加价幅度</label>¥ <?php echo ($data["jiafujia"]); ?></h5>
	<h5 class="yyg-view-margin"><label class="filed-label-60">保证金额</label>¥ <?php echo ($data["jiafujia"]); ?></h5>
	<h5 class="yyg-view-margin"><label class="filed-label-60">立拍价格</label>¥ <?php echo ($data["lijijia"]); ?></h5>
	<?php if($baoliu): ?><h5 class="yyg-view-margin"><label class="filed-label-60">有保留价</label>是</h5><?php endif; ?>
	<h5 class="yyg-view-margin"><label class="filed-label-60">剩余时间</label><time yj="false" _countdown="<?php echo (strtotime($data["end_time"])); ?>"></time></h5>
</div>

<ul class="mui-table-view yyg-margin20">
	<li class="mui-table-view-cell"><a class="mui-navigate-right" href="<?php echo U('record', '','');?>/<?php echo ($data["gid"]); ?>">出价记录(<span id="chujiacishuLabel"><?php echo ($data["chujiacishu"]); ?></span>)</a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right" href="<?php echo U('detail', '', '');?>/<?php echo ($data["gid"]); ?>">图文详情 <span class="yyg-tiny">(建议WIFI下使用)</span></a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right">商品晒单</a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right" href="<?php echo U('article', '', '');?>/chengnuo">卖家承诺</a></li>
	<li class="mui-table-view-cell"><a class="mui-navigate-right" href="<?php echo U('article', '', '');?>/baozhengjin">保证金须知</a></li>
</ul>
<footer class="yyg-footer">
	<div class="yyg-footer-left">
		<a class="yyg-btn yyg-btn-link" href="javascript:history.back()"><i class="mui-icon mui-icon-back"></i></a>
		<?php if(isset($isBaozheng)): ?><a id="chujiaButton" class="yyg-btn yyg-btn-primary">我要出价</a>
		<?php else: ?>
			<a href="<?php echo U('Pay/baozhengjin','','');?>/<?php echo ($data["gid"]); ?>" class="yyg-btn yyg-btn-primary">缴纳保证金</a><?php endif; ?>
	</div>
	<div class="yyg-footer-right">
		<div id="lijiButton" class="yyg-btn yyg-btn-success">立即揭标</div>
		<a class="yyg-btn yyg-btn-link" href="<?php echo U('Cart/index', '','');?>"><i class="iconfont icon-yyg_cart mui-icon"></i></a>
	</div>
</footer>

<?php if(isset($isBaozheng)): ?><style>
		.yyg-chujia-bg{
			background-color: rgba(0,0,0,0.2);
			position: fixed;
			top:0;
			left:0;
			width:100%;
			height:100%;
			z-index: 9999;
		}
		
		.yyg-chujia-inner {
			position: absolute;
			top:50%;
			left:50%;
			transform: translate(-50%,-50%);
			-webkit-transform: translate(-50%,-50%);
			-moz-transform: translate(-50%,-50%);
			-o-transform: translate(-50%,-50%);
			-ms-transform: translate(-50%,-50%);
			
			width: 280px;
			background:#fff;
			border-radius: 8px;
			padding: 30px 10px;
		}
		
		.yyg-chujia-inner .mui-numbox [class*=mui-numbox-btn]{
			width: auto;
		}
		
		.yyg-chujia-inner .mui-numbox, .yyg-chujia-inner .yyg-btn {
			display: block;
			margin: 10px;
			width: auto;
		}
		
		.yyg-chujia-inner .yyg-btn {
			margin-top:30px;
		}
		
	</style>
	<div id="chujiaBlock" class="yyg-chujia-bg" style="display: none;">
		<div class="yyg-chujia-inner">
			<div class="mui-numbox">
			  <!-- "-"按钮，点击可减小当前数值 -->
			  <button class="mui-btn mui-numbox-btn-minus" type="button">-<?php echo ($data["jiafujia"]); ?></button>
			  <input id="inputChujia" class="mui-numbox-input" type="number" value="<?php echo ($zuidijia); ?>" />
			  <!-- "+"按钮，点击可增大当前数值 -->
			  <button class="mui-btn mui-numbox-btn-plus" type="button">+<?php echo ($data["jiafujia"]); ?></button>
			</div>
			<div class="yyg-btn yyg-btn-primary" id="dochujiaButton">出价</div>
		</div>
	</div><?php endif; ?>

<script type="text/javascript">
	$(function() {
		<?php if(isset($isBaozheng)): ?>var qipaijia = <?php echo ($data["qipaijia"]); ?>;
			var zuigaojia = <?php echo ($data["zuigaojia"]); ?>;
			var jiafujia = <?php echo ($data["jiafujia"]); ?>;
			var zuidijia = <?php echo ($zuidijia); ?>;
			var chujiacishu = <?php echo ($data["chujiacishu"]); ?>;
			var chujiaBlock = $("#chujiaBlock");
			var inputChujia = $("#inputChujia");
			var zuigaojiaLabel = $("#zuigaojiaLabel");
			var chujiacishuLabel = $("#chujiacishuLabel");
			var refreshHandler = null;
			startReresh();
			
			$("#chujiaButton").click(function() {
				dochujiaButton.prop("disabled", false);
				// 设置状态
				stopRefresh();
				
				inputChujia.val(zuidijia);
				
				chujiaBlock.show();
			});
			
			
			var dochujiaButton = $("#dochujiaButton").click(function() {
				dochujiaButton.prop("disabled", true);
				var money = Number(inputChujia.val());
				$.post("<?php echo U('chujia', '', '');?>/<?php echo ($data["gid"]); ?>/" + money,null,function(result) {
					startReresh();
					chujiaBlock.hide();
					if(result.status != 0) {
						// 出价成功
						new Android_Toast({content: result.message});
					} else {
						zuigaojia = money;
						chujiacishu++;
						zuigaojiaLabel.text(zuigaojia);
						chujiacishuLabel.text(chujiacishu);
						zuidijia = zuigaojia + jiafujia;
					}
				});
			});
			
			function startReresh() {
				// 自动刷新最高价状态
				refreshHandler = window.setInterval(function() {
					$.get("<?php echo U('refresh', '', '');?>/<?php echo ($data["gid"]); ?>", null, function(data) {
						if(data.status < 2) {
							chujiacishu = data.chujiacishu;
							zuigaojia = data.zuigaojia;
							zuigaojiaLabel.text(zuigaojia);
							chujiacishuLabel.text(chujiacishu);
							if(data.zuigaojia > zuidijia) {
								zuidijia = zuigaojia + jiafujia;
							}
							
						} else {
							alert("商品已经结束");
							window.location.href = "<?php echo U('view', '', '');?>/<?php echo ($data["gid"]); ?>";
						}
					})
				}, 10000);
			}
			
			function stopRefresh() {
				window.clearInterval(refreshHandler);
			}
			
			$(".mui-numbox-btn-minus").click(function() {
				var money = Number(inputChujia.val());
				if(zuidijia <= money - jiafujia) {
					inputChujia.val(money - jiafujia);
				}
			});
			$(".mui-numbox-btn-plus").click(function() {
				var money = Number(inputChujia.val());
				inputChujia.val(money + jiafujia);
			});<?php endif; ?>
		$("#lijiButton").click(function() {
			$.post("<?php echo U('Cart/add', '', '');?>/<?php echo ($data["gid"]); ?>/3", null, function(result) {
				window.location.href = "<?php echo U('Cart/index', '','');?>";
			})
		});
		
		document.getElementById("chujiaBlock").addEventListener("click", function(evt) {
			if(evt.srcElement.id == "chujiaBlock") {
				chujiaBlock.hide();
			}
		});
	});
</script>

		</div>
		<div class="gotop backtop" style="display:none;"></div>
	</body>

</html>
<script type="text/javascript">
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
		
		<?php if(isset($images)): ?>//Partial Slides
		swiperLoop = $('.swiper-loop').swiper({
			pagination : '.pagination-loop',
			slidesPerSlide : Math.min(3, <?php echo (count($images)); ?>),
			loop:true
		});<?php endif; ?>
	});
</script>