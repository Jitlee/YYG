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
				<li class="mui-table-view-cell yyg-cart-item">
					<div class="yyg-cart-img-container">
						<img src="<?php echo ($data["thumb"]); ?>"/>
					</div>
					<div class="yyg-cart-body">
						<p class="yyg-cart-title"> <?php echo ($data["title"]); ?><r><?php echo ($data["subtitle"]); ?></r></p>
						<h5>保证金: ¥ <?php echo ($data["baozhengjin"]); ?></h5>
					</div>
				</li>
			</ul>
			
			<p class="yyg-pay-total">总共支付金额：¥ <r> <?php echo ($total); ?> </r></p>
			
			<ul class="mui-table-view">
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
				money: _money,  // 余额支付金额
				third: _total, // 第三方支付金额
				bgid: <?php echo ($data["gid"]); ?>, // 商品id
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
					bgid:<?php echo ($data["gid"]); ?>
	            },                      //(可选，用户自定义参数，若存在自定义参数则壹收款会通过 POST 方法透传给 charge_url)
	            open_id:''                             //(可选，使用微信公众号支付时必须传入)
	        },function(res){
	            if(!res.status){
					new Android_Toast("支付异常");
	            }
	            else{
	                pingpp_one.success(function(res){
	                    if(!res.status){
							new Android_Toast("支付异常");
	                    }
	                },function(res){
						console.info(res);
	                });
	            }
	        });
		}
	});
</script>