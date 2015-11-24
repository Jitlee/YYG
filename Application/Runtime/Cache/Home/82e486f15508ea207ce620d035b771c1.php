<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1448373727_1371717.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/mobile.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/android_toast.min.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="/Public/Home/js/android_toast.min.js"></script>

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
			<ul class="mui-table-view yyg-cart">
				<li class="mui-table-view-cell yyg-cart-item">
					<div class="yyg-cart-img-container">
						<img src="<?php echo ($data["thumb"]); ?>"/>
					</div>
					<div class="yyg-cart-body">
						<p class="yyg-cart-title"> <?php echo ($data["title"]); ?></p>
						<h5>保证金:<?php echo ($data["baozhengjin"]); ?></h5>
					</div>
				</li>
			</ul>
			
			<p class="yyg-pay-total">总共支付金额：¥ <r> <?php echo ($data["baozhengjin"]); ?> </r></p>
			
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<div class="mui-input-row mui-checkbox">
						<label>福分抵扣：<span class="yyg-gray">(可用福分20)</span></label>
						<input name="checkbox1" value="Item 3" checked="true" type="checkbox" disabled="disabled">
					</div>
				</li>
				<li class="mui-table-view-cell">
					<div class="mui-input-row mui-checkbox  mui-disabled">
						<label>余额支付：<span class="yyg-gray">(余额¥0.00)</span></label>
						<input name="checkbox1" value="Item 3" checked="true" type="checkbox" disabled="disabled">
					</div>
				</li>
			</ul>
			
			<ul class="mui-table-view yyg-margin20">
				<li class="mui-table-view-cell mui-collapse">
					<a class="mui-navigate-right">
						第三方支付
						<span class="yyg-cell-left yyg-gray">需要支付 <r>¥ <?php echo ($data["baozhengjin"]); ?></r></span>
					</a>
				</li>
			</ul>
			
			<footer class="yyg-footer">
				<div class="yyg-btn yyg-btn-primary">立即支付</div>
			</footer>
		</div>
	</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {
		
	});
</script>