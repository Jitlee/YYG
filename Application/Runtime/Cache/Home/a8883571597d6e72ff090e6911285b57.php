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
		<script src="/Public/Home/js/jquery.fly.min.js"></script>
		
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
			
<header class="mui-bar mui-bar-nav">
  <button class="mui-btn mui-btn-link mui-btn-nav mui-pull-left" onclick="history.go(-1)">
    <span class="mui-icon mui-icon-left-nav" ></span>
    	返回
  </button>
  <h1 class="mui-title"><?php echo ($title); ?></h1>
</header>

<div class="mui-content">
    <div class="g-Total gray9">您的当前余额：<span class="orange arial">0.00</span>元</div>
    <section class="clearfix g-member">
        <div class="g-Recharge">
	        <ul id="ulOption">
		        <li money="10"><a href="javascript:void(0);" class="z-sel">10元<s></s></a></li>
		        <li money="20"><a href="javascript:void(0);">20元<s></s></a></li>
		        <li money="50"><a href="javascript:void(0);">50元<s></s></a></li>
		        <li money="100"><a href="javascript:void(0);">100元<s></s></a></li>
		        <li money="200"><a href="javascript:void(0);">200元<s></s></a></li>
		        <li money="500"><a href="javascript:void(0);">500元<s></s></a></li>
	        </ul>
	    </div>
	    <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
		    <ul id="ulBankList">
				<li class="gray6">充值金额<em class="orange" id="addrechange">10.00</em>元</li>
			</ul>
	    </article>
	    <div class="mt10 f-Recharge-btn">
		    <button id='btnrechange' type="button" class="mui-btn mui-btn-block mui-btn-primary">确认充值</button>
	    </div>
    </section>
</div>
<script type="text/javascript" src="https://one.pingxx.com/lib/pingpp_one.js"></script>
<script type="text/javascript">
	$(function(){
		
		 $("#ulOption").find("li").each(function(i,o){
		 		var obj =$(o);
		 		obj.click(function(){
		 			$(".z-sel").removeClass("z-sel");
		 			$(this).find("a").addClass("z-sel");
		 			$("#addrechange").text(obj.attr("money"));
		 		});
		 });
		 
		 $("#btnrechange").click(function(){
		 	  var vmoney=$("#addrechange").text();
			 	pingpp_one.init({
	            app_id:'app_5K8yzLfvnT4Gaj1S',                     //该应用在ping++的应用ID
	            order_no:'<?php echo ($data["rderNo"]); ?>',                     //订单在商户系统中的订单号
	            amount: parseInt(vmoney),                                   //订单价格，单位：人民币 分
	            // 壹收款页面上需要展示的渠道，数组，数组顺序即页面展示出的渠道的顺序
	            // upmp_wap 渠道在微信内部无法使用，若用户未安装银联手机支付控件，则无法调起支付
	            channel:['alipay_wap','wx_pub'],
	            charge_url:"<?php echo U('OrderPay/Index', '', '');?>",  //商户服务端创建订单的url
	            charge_param:{
	            	sourceType:"recharge",
								a:1,
								b:2
	            },                      //(可选，用户自定义参数，若存在自定义参数则壹收款会通过 POST 方法透传给 charge_url)
	            open_id:'5K8yzLfvnT4Gaj1S'                             //(可选，使用微信公众号支付时必须传入)
	        },function(res){
	           // alert(res);
	            if(!res.status){
	                //处理错误
	                alert(res.chargeUrlOutput);
	                alert(res.msg);
	            }
	            else{
	                //若微信公众号渠道需要使用壹收款的支付成功页面
	                //则在这里进行成功回调，调用 pingpp_one.success 方法，你也可以自己定义回调函数
	                //其他渠道的处理方法请见第 2 节
	                pingpp_one.success(function(res){
	                    if(!res.status){
	                        alert(res.msg);
	                    }
	                },function(){
	                    //这里处理支付成功页面点击“继续购物”按钮触发的方法，例如：若你需要点击“继续购物”按钮跳转到你的购买页，
	                    //则在该方法内写入 window.location.href = "你的购买页面 url"
	                    window.location.href="<?php echo U('Index/Index', '', '');?>";//示例
	                });
	            }
	        });
        
		 });
	});
</script>
<style>
a { color: #000;text-decoration: none;outline: medium none;}
* {margin: 0px;padding: 0px;}
ul, li {list-style: outside none none;}
.g-Total {
    background: #F4F4F4 none repeat scroll 0% 0%;
    border-bottom: 1px solid #DCDCDC;
    line-height: 30px;
    padding: 5px 10px 0px;
    font-size: 14px;
}
.gray6{ font-size: 14px; font-weight: bold;}
.g-Recharge li a, .g-Recharge li .z-initsel, .g-Recharge li b {
    color: #959595;
    width: 90%;
    line-height: 30px;
    display: inline-block;
    background: #FFF none repeat scroll 0% 0%;
    border-radius: 5px;
    text-align: center;
    border: 1px solid #EAEAEA;
    box-shadow: 1px 1px 1px #EDEDED;
    position: relative;
}
.g-Recharge li a.z-sel {
    border: 1px solid #F60;
    color: #666;
}
.g-member {
    background: #F4F4F4 none repeat scroll 0% 0%;
    padding: 10px 5px;
    box-sizing: border-box;
}
.clearfix {
    display: block;
}

.g-Recharge li:nth-child(3n-1) {
    width: 34%;
    text-align: center;
}
.g-Recharge li,.z-init {
    width: 33%;
    float: left;
    margin-bottom: 10px;
}
div, ul, li, dl, dt, dd, table, td, input {
    font-size: 12px;
}
 .g-Recharge li .z-init {
    width: 90%;
    padding: 0px 0px;
    text-align: center;
    border: medium none;
}
.g-Recharge li a, .g-Recharge li .z-initsel, .g-Recharge li b{
    color: #959595;
    line-height: 30px;
    text-align: center;
}
.g-Recharge li input {
    color: #959595;
}
input {
    vertical-align: middle;
}
body, button, input, select, textarea {
    font-size: 12px;
    font-family: arial,微软雅黑;
}
</style>
    
 
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
				<span class="mui-icon iconfont icon-yyg_cart"><span id="cartCount" class="mui-badge"  <?php if($_SESSION['user_']['cartCount']== 0): ?>style="display:none"<?php endif; ?>><?php echo session('cartCount');?></span></span>
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
		
		var cartCount = <?php echo (session('cartCount')); ?> * 1;
		var cartCountSpan = $("#cartCount");
		function countCart(count) {
			cartCount += count;
			cartCountSpan.text(cartCount);
			if(cartCount <= 0) {
				cartCountSpan.hide();
			} else {
				cartCountSpan.show();
			}
		}
		window.countCart = countCart;
	});
</script>