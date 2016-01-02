<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>支付－<?php echo config("web_name");?></title>
<meta name="keywords" content="{wc:if isset($keywords)}{wc:$keywords}{wc:else}{wc:fun:_cfg("web_key")}{wc:if:end}" />
<meta name="description" content="{wc:if isset($description)}{wc:$description}{wc:else}{wc:fun:_cfg("web_des")}{wc:if:end}" />
<link rel="stylesheet" type="text/css" href="/Public/P/css/Comm.css"/>
<link rel="stylesheet" type="text/css" href="/Public/P/css/MyCart.css"/>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>	
<style>
	.yeepay_bank img{ border:1px solid #eee; padding:2px; width:130px; height:35px; }
</style>
</head>
<body>
<script src="https://one.pingxx.com/lib/pingpp_one.js" type="text/javascript"></script>
<div class="logo">
	<div class="float">
		<span class="logo_pic"><a href="/index.php/P" class="a" title="<?php echo config("web_name");?>">
			<img src="/Public/P/images/logo/logo.jpg"/>
		</a></span>
		<span class="tel"><a href="/index.php/P" style="color: #999;">返回首页</a></span>
	</div>
</div>
<div class="shop_payment">
	<ul class="payment">
		<li class="first_step">第一步：提交订单</li>
		<li class="arrow_1"></li>
		<li class="secend_step orange_Tech">第二步：网银支付</li>
		<li class="arrow_3"></li>
		<li class="third_step">第三步：支付成功 等待揭晓</li>
		<li class="arrow_2"></li>
		<li class="fourth_step">第四步：揭晓获得者</li>
		<!-- <li class="arrow_2"></li>
		<li class="fifth_step">第五步：晒单奖励</li> -->
	</ul>
	<div class="payment_Con">
		<ul class="order_list">
			<li class="top">
				<span class="name">商品名称</span>
				<span class="moneys">报名人数</span>
				<span class="money">保证金</span>
			</li>               
			<li class="end">
				<span class="name">
               		<a class="blue" href="<?php echo U('Index/view', '', '');?>/<?php echo ($data["gid"]); ?>"><?php echo ($data["title"]); ?> <b><?php echo ($data["subtitle"]); ?></b></a>
                </span>
				<span class="moneys"><?php echo ($data["baomingrenshu"]); ?></span>
				<span class="money"><span class="color">￥<b><?php echo ($data["baozhengjin"]); ?></b></span></span>
			</li>
            <!-- 余额支付 start-->
			<li class="point_in" id="liPayByBalance">
				<div class="payment_List_Lc">					
					<input type="checkbox" name="moneycheckbox" id="yueCheckBox" class="input_choice"/>使用账户余额支付，账户余额：
					<span class="green F18"><?php echo ($account["money"]); ?></span>元
				</div>
				<p style="" class="pay_Value" id="pBalanceTip">
				<span>◆</span><em>◆</em>账户余额支付更快捷，
				<a class="blue" target="_blank" href="{WEB_PATH}/member/home/userrecharge">立即充值</a></p>
				<p class="payment_List_Rc">余额支付：<span id="pay_money" class="orange F20">0</span> 元</p>
			</li>
            <!-- 余额支付 end--> 
		
			<li id="liPayByOther" class="point_in point_bank" style="display:list-item;">
				<div class="payment_List_Lc gary01 Fb">第三方支付</div>
				<p class="payment_List_Rc">需要支付：<span id="thirdMoney" class="orange F20"><?php echo ($total); ?></span> 元</p>
			</li>
		</ul>
	</div>
    <div class="payment_but" style="margin:15px 0 0 0;">
			<input id="zhifuButton" class="shop_pay_but" type="button" value="">
	</div>
	<div class="answer">
		<h6><span></span>付款遇到问题</h6>
		<ul class="answer_list">
			<li>1、如果您有支付宝、手机支付账户，可将款项先充入相应账户内，然后使用账户余额进行一次性支付；</li>
			<li>2、如果第三方已经扣款，但您的账户中没有显示，有可能因为网络原因导致，将在第二个工作日恢复。</li>
			<li class="more"><a href="{WEB_PATH}/help/liaojie">更多帮助</a>&nbsp;&nbsp;<a href="{WEB_PATH}/member/home">进入我的云购中心&gt;&gt;</a></li>
		</ul>
	</div>
    
</div><!--payment_Con end-->
<script type="text/javascript">
$(function(){
	var money = <?php echo ($account["money"]); ?>;
	var score = <?php echo ($account["score"]); ?>;
	var total = <?php echo ($total); ?>;
	var _money = 0;
	var _score = 0;
	var _total = total;
	var thirdMoney = $("#thirdMoney");
	var payScore = $("#pay_score");
	var payScore = $("#pay_score");
	var payMoney = $("#pay_money");
	var yueCheckBox = $("#yueCheckBox").click(function() {
		if(yueCheckBox.prop("checked")) {
			if(money > 0) {
				var needMoney = total - _score/100;
				if(needMoney > 0) {
					_money = Math.min(money, needMoney);
					_total -= _money;
					payMoney.text(_money);
					thirdMoney.text(_total);
				} else {
					yueCheckBox.prop("checked", false);
				}
			} else {
				yueCheckBox.prop("checked", false);
				alert("余额不足");
			}
		} else {
			_total += _money;
			_money = 0;
			payMoney.text(0);
			thirdMoney.text(_total);
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
			score: _score, // 福分支付金额
			money: _money,  // 余额支付金额
			third: _total, // 第三方支付金额, // 第三方支付金额
			bgid: <?php echo ($data["gid"]); ?>, // 商品id
		}, function(result) {
			if(result == 0) {
				window.location.href ="<?php echo U('success','','');?>";
			} else {
				alert("支付失败,错误代码：" + result);
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
            channel:['alipay_wap'],
            charge_url:"<?php echo U('thirdpay','','');?>",  //商户服务端创建订单的url
            charge_param:{				
				third: _total,
				money: _money,
				score: _score,
				bgid:<?php echo ($data["gid"]); ?>
            },                      //(可选，用户自定义参数，若存在自定义参数则壹收款会通过 POST 方法透传给 charge_url)
            open_id:''                             //(可选，使用微信公众号支付时必须传入)
        },function(res){
           // alert(res);
           console.info(res);
            if(!res.status){
                //处理错误
				alert("支付异常");
            }
            else{
                //若微信公众号渠道需要使用壹收款的支付成功页面
                //则在这里进行成功回调，调用 pingpp_one.success 方法，你也可以自己定义回调函数
                //其他渠道的处理方法请见第 2 节
                pingpp_one.success(function(res){
                    if(!res.status){
						alert("支付异常");
                    }
                },function(res){
                    //这里处理支付成功页面点击“继续购物”按钮触发的方法，例如：若你需要点击“继续购物”按钮跳转到你的购买页，
                    //则在该方法内写入 window.location.href = "你的购买页面 url"
//	                    window.location.href='http://yourdomain.com/payment_succeeded';//示例
                });
            }
        });
	}
});
</script>
<link rel="stylesheet" type="text/css" href="/Public/P/css/header1.css" />
<!--新闻列表-->
<div class="g-frame-footer">
	<div class="g-width footer">
		<div class="M-guide">
			<?php echo footerHelp();?>
			<dl class="ft-fwrx">
				<dt><span>官方群</span></dt>
				<dd class="ft-fwrx-service"><a style="text-indent:0em; background:none;width:160px;"  href="javascript:void(0);">官方QQ群：<em class="orange Fb">88888</em></a></dd>
				<dd class="ft-fwrx-service"><a style="text-indent:0em; background:none;width:160px;"  href="javascript:void(0);">官方QQ群：<em class="orange Fb">99999</em></a></dd>
				<dd class="ft-fwrx-service"><a style="text-indent:0em; background:none;width:160px;" href="javascript:void(0);">官方QQ群：<em class="orange Fb">188526887</em></a></dd>
			</dl>
			<dl>
				<dt>携手云购</dt>
				<dd><a href="<?php echo U('Help/business', '', '');?>" target="_blank">商务合作</a></dd>
				<dd><a href="<?php echo U('Help/index', '', '');?>/13">联系我们</a></dd>
			</dl>
		</div>
		<div class="M-security">
			<a href="<?php echo U('Help/index', '', '');?>/4" class="U-fair" target="_blank"> <s class="F-security-img"></s>
				<p class="F-security-T">100%公平公正</p>
				<p class="F-security-C">参与过程公开透明，用户可随时查看</p>
			</a>
			<a href="<?php echo U('Help/index', '', '');?>/5" class="U-security" target="_blank"> <s class="F-security-img"></s>
				<p class="F-security-T">100%正品保证</p>
				<p class="F-security-C">精心挑选优质商家，100%品牌正品</p>
			</a>
			<a href="<?php echo U('Help/index', '', '');?>/7" class="U-free" target="_blank"> <s class="F-security-img"></s>
				<p class="F-security-T">全国免运费</p>
				<p class="F-security-C">全场商品全国包邮（港澳台地区除外）</p>
			</a>
		</div>
	</div>
</div>
<!--end 新闻列表-->

<!-- 底部版权 -->
<div class="g-frame copyright">
	<div class="footer_links">
		<a href="<?php echo U('Index/index', '', '');?>">首页</a><b></b>
		<a href="<?php echo U('Help/index', '', '');?>/1">关于云购</a><b></b>
		<a href="<?php echo U('Help/business', '', '');?>">合作专区</a><b></b>
		<a href="<?php echo U('Help/index', '', '');?>/13">联系我们</a><b></b>		
	</div>
	<div class="copyright">
		Copyright © 2011 - 2015 </div>
	<div class="footer_icon">
		<a href="" target="_blank" class="fi_ectrustchina"></a>
		<a href="" target="_blank" class="fi_315online"></a>
		<a href="" target="_blank" class="fi_qh"></a>
		<a href="" target="_blank" class="fi_cnnic"></a>
		<a href="" target="_blank" class="fi_anxibao"></a>
		<a href="" target="_blank" class="fi_pingan"></a>
	</div>
</div>
<!--end 底部版权 -->

<!--右侧导航-->
<div id="divRighTool" class="quickBack" style="display: block;bottom: 60px;right: 0px;">
	<dl class="quick_But">
		<dd id="divRigCart" class="quick_cart" style="">
			<a id="btnMyCart" href="<?php echo U('Cart/index');?>" target="_blank" class="quick_cartA"><b>购物车</b><s></s><em><span class="cart-count"><?php echo session('cartCount');?></span></em></a>
			<div style="display: none;" id="rCartlist" class="Roll_mycart">
				<ul style="display: none;">
				</ul>
				<li id="roolCartTemplate" style="display: none;">
					<a href="javascript:void(0);" title="删除" class="Close"></a>
					<a class="link"><img class="img"></a>
					<span class="orange renci"></span>人次
				</li>
				<li id="roolCartMore" class="Roll_CartMore" style="display: none;">
					<a target="_blank" title="查看更多" href="'.WEB_PATH.'/member/cart/cartlist">
						更多<i>&gt;</i>
					</a>
				</li>
				<div class="quick_goods_loding" id="rCartLoading">
					<img border="0" alt="" src="/Public/P/images/goods_loading.gif">正在加载......
				</div>
				<p id="p1" style="display: none;">共计<span id="rCartTotal2">0</span> 件商品 金额总计：<span class="rmbgray" id="rCartTotalM">0</span></p>
				<h3 style="display: none;">
							<a target="_blank" href="<?php echo U('Cart/index', '', '');?>"
								class="orange_btn">去购物车结算</a>
						</h3>
			</div>
		</dd>
		<dd class="quick_service">
			<a href="http://wpa.qq.com/msgrd?V=1&uin=1194339041&Site=1元抱&Menu=yes" id="btnRigQQ" class="quick_serviceA " target="_blank"><b>在线客服</b><s></s></a>
		</dd>
		<dd class="quick_Collection">
			<a id="btnFavorite" href="javascript:void();" class="quick_CollectionA"><b>收藏本站</b><s></s></a>
		</dd>
		<dd class="quick_Return">
			<a id="btnGotoTop" href="javascript:void()" class="quick_ReturnA"><b>返回顶部</b><s></s></a>
		</dd>
	</dl>
</div>
<script type="text/javascript">
	$(function(){
		var sp_ServerTime = $("#sp_ServerTime");
		var serverTime = <?php echo ($serverTime); ?>000;
		function showTime() {
			serverTime += 1000;
			var now = new Date(serverTime);
			var hours = now.getHours();
			var muintes = now.getMinutes();
			var seconds = now.getSeconds();
			hours = hours > 9 ? String(hours) : "0" + hours;
			muintes = muintes > 9 ? String(muintes) : "0" + muintes;
			seconds = seconds > 9 ? String(seconds) : "0" + seconds;
			sp_ServerTime.html([hours, muintes, seconds].join(":"));
		}
		showTime();
		window.setInterval(showTime, 1000);
		
		// 计算购物车
		var cartCount = <?php echo (session('cartCount')); ?> * 1;
		var cartCountSpan = $(".cart-count");
		function countCart(count) {
			cartCount += count;
			cartCountSpan.text(cartCount);
		}
		window.countCart = countCart;
		
		$(".add-cart").click(function(evt) {
			var offset = $("#btnMyCart").offset();
			evt.stopPropagation();
			evt.preventDefault();
			var $this = $(this);
			var gid = $this.attr("gid");
			
			var img = $this.attr("src");
			var flyer = $('<img class="u-flyer" src="'+img+'">');
			var goodOffset = $this.offset();
			flyer.fly({
				start: {
					left: goodOffset.left,
					top: goodOffset.top - $(document).scrollTop()
				},
				end: {
					left: offset.left,
					top: offset.top - $(document).scrollTop(),
					width: 0,
					height: 0
				},
				onEnd: function(){
					this.destory();
				}
			});
			
			$.post("<?php echo U('Cart/add', '', '');?>/" + gid + "/1", null, function(result) {
				if(result.count > 0) {
					countCart(1);	
				} else {
					
				}
			})
		});
		
		
		// 购物车
		$(".quick_cart").hover(oncarthover,
			function(){
				$("#rCartlist,#rCartlist ul,#rCartlist p,#rCartlist h3").hide();
			}
		);
		$("#rGotoCart").click(function(){
			window.location.href="<?php echo U('Cart/index');?>";
		});
		
		function oncarthover(){			
			$("#rCartlist,#rCartLoading").show();
			$("#rCartlist p,#rCartlist h3").hide();
			$("#rCartTotal2").html("");
			$("#rCartTotalM").html("");
			var listUL = $("#rCartlist ul");
			var roolCartTemplate = $("#roolCartTemplate");
			var roolCartMore = $("#roolCartMore").hide();
			listUL.html("");
			$.getJSON("<?php echo U('Cart/box', '','');?>",function(data){
				if(data.count > 0) {
					for(var i = 0, len = data.list.length; i < len; i++) {
						var item = data.list[i];
						var li = roolCartTemplate.clone().removeAttr("id").show();
						li.appendTo(listUL);
						$(".Close", li).attr("cid", item.id).click(removeCart);
						$(".img", li).attr("src", item.good.thumb);
						$(".renci", li).text(item.count);
						$(".link", li).attr("href", "<?php echo U('Index/view', '', '');?>/" + item.gid)
							.attr("title", item.good.title);
					}
					if(data.count > 7) {
						roolCartMore.clone().show().appendTo(listUL);
					}
				}
				$("#rCartTotal2").html(data.count);
				$("#rCartTotalM").html(data.total);
				$("#rCartLoading").hide();
				$("#rCartlist ul,#rCartlist p,#rCartlist h3").show();				
			});
		}
		function removeCart(evt) {
			var $this = $(this);
			var cid = $this.attr("cid");
			$.post("<?php echo U('Cart/remove', '', '');?>/" + cid, null, function(result) {
				if(result.status == 0) {
					$this.parent().remove();
					countCart(-1);
					oncarthover();
					if(window.removeCart) {
						window.removeCart(cid);
					}
				} else { // 失败
					message.text("删除失败");
				}
			});
		}
	});
</script>
<!--end右侧导航-->
</body>

</html>