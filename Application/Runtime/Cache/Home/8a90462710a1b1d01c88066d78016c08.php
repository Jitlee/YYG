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
	</head>

	<body>
		<div class="mui-content" style="padding-top: 0;padding-bottom: 54px;">
			<ul class="mui-table-view yyg-cart">
				<?php if(is_array($list)): foreach($list as $key=>$item): ?><li class="mui-table-view-cell yyg-cart-item">
					<?php if($item["type"] == 3): ?><div class="yyg-cart-img-container">
							<img src="<?php echo ($item["paimai"]["thumb"]); ?>"/>
						</div>
						<div class="yyg-cart-body">
							<p class="yyg-cart-title">( 立即揭标 ) <?php echo ($item["paimai"]["title"]); ?></p>
							<h5>立即揭标价:<?php echo ($item["paimai"]["lijijia"]); ?></h5>
						</div>
					<?php else: ?>
						<div class="yyg-cart-img-container">
							<img src="<?php echo ($item["good"]["thumb"]); ?>"/>
						</div>
						<div class="yyg-cart-body">
							<p class="yyg-cart-title">(第 <?php echo ($item["good"]["qishu"]); ?> 期)<?php echo ($item["good"]["title"]); ?></p>
							<h5><?php echo ($item["count"]); ?>人次/¥<?php echo ($item["good"]["danjia"]); ?></h5>
						</div><?php endif; ?>
					</li><?php endforeach; endif; ?>
			</ul>
			
			<p class="yyg-pay-total">总共支付金额：¥ <r> <?php echo ($total); ?> </r></p>
			
			<ul class="mui-table-view">
				<li class="mui-table-view-cell">
					<label  id="scoreButton" for="scoreCheckBox" class="mui-input-row mui-checkbox">
						<div>福分抵扣：<span class="yyg-gray">(可用福分<?php echo ($account["score"]); ?>)</span></div>
						<input id="scoreCheckBox" type="checkbox">
					</label>
				</li>
				<li class="mui-table-view-cell">
					<label id="yueButton" for="yueCheckBox" class="mui-input-row mui-checkbox  mui-disabled">
						<div>余额支付：<span class="yyg-gray">(余额¥<?php echo ($account["money"]); ?>)</span></div>
						<input id="yueCheckBox" type="checkbox">
					</label>
				</li>
			</ul>
			
			<ul class="mui-table-view yyg-margin20">
				<li class="mui-table-view-cell mui-collapse">
					<a class="mui-navigate-right">
						第三方支付
						<span class="yyg-cell-left yyg-gray">需要支付 <r id="thridMoney">¥ <?php echo ($total); ?></r></span>
					</a>
				</li>
			</ul>
			
			<footer class="yyg-footer">
				<div id="zhifuButton" class="yyg-btn yyg-btn-primary">立即支付</div>
			</footer>
		</div>
	</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {
		$("#scoreButton").click(function() {
			
		});
		
		var money = <?php echo ($account["money"]); ?>;
		var scroe = <?php echo ($account["score"]); ?>;
		var total = <?php echo ($total); ?>;
		var _money = 0;
		var _score = 0;
		var _total = total;
		var thridMoney = $("#thridMoney");
		var yueCheckBox = $("#yueCheckBox").click(function() {
			if(yueCheckBox.prop("checked")) {
				var needMoney = total - _score;
				_money = Math.min(money, needMoney);
				_total -= _money;
				thridMoney.text("¥ " + _total);
			} else {
				_total += _money;
				thridMoney.text("¥ " + _total);
			}
		});
		
		var zhifuButton = $("#zhifuButton").click(function(){
			// 无需第三方付款
			zhifuButton.prop("disabled", true);
			$.post("<?php echo U('zhifu','','');?>", {
				score: 0, // 福分支付金额
				money: _money,  // 余额支付金额
				third: _total // 第三方支付金额
			}, function(result) {
				if(result.status == 0) {
					window.location.href ="<?php echo U('success','','');?>";
				} else {
					console.log(result.status);
					new Android_Toast({content: "支付失败"});
				}
				zhifuButton.prop("disabled", false);
			});
		});
	});
</script>