<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title><?php echo ($title); ?></title>
		<link href="/Public/Home/css/mui.min.css" rel="stylesheet" type="text/css" />
		<link href="http://at.alicdn.com/t/font_1448782434_6313894.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/mobile.css" rel="stylesheet" type="text/css" />
		<link href="/Public/Home/css/android_toast.min.css" rel="stylesheet" type="text/css" />

		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="/Public/Home/js/android_toast.min.js"></script>
	</head>

	<body>
		<script src="https://one.pingxx.com/lib/pingpp_one.js"></script>
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
			if(_total > 0) {
				thirdPay();
			} else {
				localPay();
			}
		});
		
		function localPay() {
			$.post("<?php echo U('localpay','','');?>", {
				score: 0, // 福分支付金额
				money: _money,  // 余额支付金额
				third: _total // 第三方支付金额
			}, function(result) {
				if(result == 0) {
					window.location.href ="<?php echo U('success','','');?>";
				} else {
					new Android_Toast({content: "支付失败,错误代码：" + result});
				}
				zhifuButton.prop("disabled", false);
			});
		}
		
		function thirdPay() {
			pingpp_one.init({
	            app_id:'app_5K8yzLfvnT4Gaj1S',                     //该应用在ping++的应用ID
	            order_no:"0",                     //订单在商户系统中的订单号
	            amount:_total,                                   //订单价格，单位：人民币 分
	            // 壹收款页面上需要展示的渠道，数组，数组顺序即页面展示出的渠道的顺序
	            // upmp_wap 渠道在微信内部无法使用，若用户未安装银联手机支付控件，则无法调起支付
	            channel:['alipay_wap','wx_pub','upacp_wap','yeepay_wap','jdpay_wap','bfb_wap'],
	            charge_url:"<?php echo U('thridpay','','');?>",  //商户服务端创建订单的url
	            charge_param:{				
					third: _total,
					money: _money,
					score: _score
	            },                      //(可选，用户自定义参数，若存在自定义参数则壹收款会通过 POST 方法透传给 charge_url)
	            open_id:''                             //(可选，使用微信公众号支付时必须传入)
	        },function(res){
	           // alert(res);
	            if(!res.status){
	                //处理错误
					new Android_Toast("支付异常");
//					console.error(res.chargeUrlOutput);
	            }
	            else{
	                //若微信公众号渠道需要使用壹收款的支付成功页面
	                //则在这里进行成功回调，调用 pingpp_one.success 方法，你也可以自己定义回调函数
	                //其他渠道的处理方法请见第 2 节
	                pingpp_one.success(function(res){
	                    if(!res.status){
//	                        alert(res.msg);
							new Android_Toast({content: res.msg});
	                    }
	                },function(res){
	                    //这里处理支付成功页面点击“继续购物”按钮触发的方法，例如：若你需要点击“继续购物”按钮跳转到你的购买页，
	                    //则在该方法内写入 window.location.href = "你的购买页面 url"
//	                    window.location.href='http://yourdomain.com/payment_succeeded';//示例
						console.info(res);
	                });
	            }
	        });
		}
	});
</script>