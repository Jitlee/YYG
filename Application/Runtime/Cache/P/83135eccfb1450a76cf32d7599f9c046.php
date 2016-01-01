<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="一元云购" />
    <meta name="description" content=""/>
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/P/css/header222.css?date=20140731">
	<link href="/Public/P/css/register.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/Public/P/css/comm.css?date=20140731">	
	 <link rel="stylesheet" type="text/css" href="/Public/P/css/comm1.css?date=20140731">
	 <link rel="stylesheet" type="text/css" href="/Public/P/css/CartList.css?date=20140731">
	 	
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>	
	<script type="text/javascript" src="/Public/P/js/jquery.cookie.js"></script>
    <script type="text/javascript" id="pageJS" data="/Public/P/js/Index.js"></script>
</head>
	<body>
		<div class="logo">
			<div class="float">
				<span class="logo_pic"><a href="/index.php/P" class="a" title="<?php echo ($sitename); ?>">
			<img src="/Public/P/images/logo/logo.jpg"/>
		</a></span>
				<span class="tel"><a href="/index.php/P" style="color:#999;">返回首页</a></span>
			</div>
		</div>
		<div class="shop_process">
			<ul class="process">
				<li class="first_step">第一步：提交订单</li>
				<li class="arrow_1"></li>
				<li class="secend_step">第二步：网银支付</li>
				<li class="arrow_2"></li>
				<li class="third_step">第三步：支付成功 等待揭晓</li>
				<li class="arrow_2"></li>
				<li class="fourth_step">第四步：揭晓获得者</li>
			</ul>
			<div class="i_tips"></div>
			<div class="submitted">
				<ul class="order">
					<li class="top">
						<span class="goods">商品</span>
						<span class="name">名称</span>
						<span class="moneys">价值</span>
						<span class="money">云购价</span>
						<span class="num">云购人次</span>
						<span class="xj">小计</span>
						<span class="do">操作</span>
					</li>
					<?php if(is_array($list)): foreach($list as $key=>$item): ?><li class="end" id="<?php echo ($item["id"]); ?>">
						<span class="goods">
							<a href="<?php echo U('Index/view', '', '');?>/<?php echo ($item["gid"]); ?>">
		                   	 <img src="<?php echo ($item["good"]["thumb"]); ?>" />
		                    </a>                    
						</span>
						<span class="name">
							<a href="<?php echo U('Index/view', '', '');?>/<?php echo ($item["gid"]); ?>" ><?php echo ($item["good"]["title"]); ?></a>
							<p>总需 <span class="color"><?php echo ($item["good"]["zongrenshu"]); ?></span>人次参与，还剩
								<span class="gorenci"><?php echo ($item["good"]["shengyurenshu"]); ?></span> 人次
							</p>
						</span>
						<span class="moneys">￥<?php echo ($item["good"]["money"]); ?></span>
						<span class="money"><span class="color">￥<b><?php echo ($item["good"]["danjia"]); ?></b></span></span>
						<span class="num">				
							<dl class="add">					
							<dd>
								<input id="input_<?php echo ($item["id"]); ?>" xg="<?php echo ($item["good"]["xiangou"]); ?>" type="type" sy="<?php echo ($item["good"]["shengyurenshu"]); ?>" dj="<?php echo ($item["good"]["danjia"]); ?>" val="<?php echo ($item["id"]); ?>" onkeyup="value=value.replace(/\D/g,'')" bk="<?php echo ($item["count"]); ?>" value="<?php echo ($item["count"]); ?>" class="amount" /></dd>
								<dd>
									<a href="JavaScript:;" val="<?php echo ($item["id"]); ?>" class="jia"></a>
									<a href="JavaScript:;" val="<?php echo ($item["id"]); ?>" class="jian"></a>
								</dd>                        
							</dl>
		                    	<p id="message_<?php echo ($item["id"]); ?>" class="message"></p>
						</span>
						<span id="xj_<?php echo ($item["id"]); ?>" class="xj">¥<?php echo ($item['good']['danjia'] * $item['count']); ?></span>
						<span class="do"><a href="javascript:;void(0)" class="delgood" val="<?php echo ($item["id"]); ?>" >删除</a></span>
					</li><?php endforeach; endif; ?>
					<li class="ts">
						<p class="right">云购金额总计:￥<span id="moenyCount"><?php echo ($total); ?></span></p>
					</li>
				</ul>
			</div>
			<h5>
				<a href="/index.php/P" id="but_on"></a>
				<input id="but_ok" type="button" value=""  name="submit"/>
			</h5>
		</div>
		<script type="text/javascript">
			$(function() {
				$(".jia").click(onamountchange);
				$(".jian").click(onamountchange);
				$(".amount").change(onamountchange);
				
				function onamountchange() {
					var $this = $(this);
					var id = $this.attr("val");
					var input = $("#input_" + id);
					var count = Number(input.val());
					var bkCount = Number(input.attr('bk'));
					var shengyu = Number(input.attr('sy'));
					var xiangou = Number(input.attr("xg"));
					var danjia = Number(input.attr("dj"));
					var message = $("#message_" + id);
					var xj = $("#xj_" + id);
					var flag = $this.hasClass("jia") ? 1 : ($this.hasClass("jian") ? -1 : 0);
					
					if(xiangou > 0 && (count + flag > xiangou)) {
						message.text("该商品限购" + xiangou + "人次");
						return;
					}
					
					if(count > shengyu) {
						count = shengyu
					}
					
					if(flag == -1 && count <= 1) {
						return;
					}
					
					if(count < -1) {
						input.val(bkCount);
						return;
					}
					
					if(count + flag == bkCount) {
						return;
					}
					count += flag;
					input.val(count);
					xj.text(count * danjia);
					sum();
					message.text("");
					
					$.post("<?php echo U('edit', '', '');?>/" + id + "/" + count, null, function(result) {
						if(result.status == 0) {
							input.attr("bk", result.count);
						} else { // 失败
							message.text("修改失败");
							
							xj.text(bkCount * danjia);
							input.val(bkCount);
							sum();
						}
					});
				}
				
				var moenyCount = $("#moenyCount");
				function sum() {
					var total = 0;
					$(".end").each(function() {
						var $this = $(this);
						var input = $("input", $this);
						var count = Number(input.val());
						var danjia = Number(input.attr("dj"));
						total += count * danjia;
					});
					moenyCount.text(total);
				}
				
				$(".delgood").click(function() {
					var $this = $(this);
					var id = $this.attr("val");
					var message = $("#message_" + id);
					$.post("<?php echo U('remove', '', '');?>/" + id, null, function(result) {
						if(result.status == 0) {
							$this.closest(".end").remove();
							sum();
							countCart(-1);
						} else { // 失败
							message.text("删除失败");
						}
					});
				});
				window.removeCart = function(id) {
					$("#" + id).remove();
					sum();
				}
			});
		</script>
<link rel="stylesheet" type="text/css" href="/Public/P/css/header1.css" />
<!--新闻列表-->
<div class="g-frame-footer">
	<div class="g-width footer">
		<div class="M-guide">
			<?php echo footerHelp();?>
			<!--<dl class="ft-newbie">
				<dt><span>新手指南</span></dt>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/1' target='_blank'>了解云购</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/2' target='_blank'>常见问题</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/3' target='_blank'>服务协议</a></dd>
			</dl>
			<dl class="ft-newbie">
				<dt><span>云购保障</span></dt>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/4' target='_blank'>保障体系</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/5' target='_blank'>正品保障</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/6' target='_blank'>安全支付</a></dd>
			</dl>
			<dl class="ft-newbie">
				<dt><span>商品配送</span></dt>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/7' target='_blank'>商品配送</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/8' target='_blank'>配送费用</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/9' target='_blank'>验货签收</a></dd>
			</dl>
			<dl class="ft-newbie">
				<dt><span>云购基金</span></dt>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/10' target='_blank'>基金去向</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/11' target='_blank'>建立基金</a></dd>
				<dd><b></b><a href='<?php echo U('Help/index', '', '');?>/12' target='_blank'>基金筹款</a></dd>
			</dl>-->

			<dl class="ft-fwrx">
				<dt><span>官方群</span></dt>

				<dd class="ft-fwrx-service"><a style="text-indent:0em; background:none;width:160px;" target="_blank" rel="nofollow" href="javascript:;">官方QQ群：<em class="orange Fb">88888</em></a></dd>
				<dd class="ft-fwrx-service"><a style="text-indent:0em; background:none;width:160px;" target="_blank" rel="nofollow" href="javascript:;">官方QQ群：<em class="orange Fb">99999</em></a></dd>
				<dd class="ft-fwrx-service"><a style="text-indent:0em; background:none;width:160px;" target="_blank" rel="nofollow" href="javascript:;">官方QQ群：<em class="orange Fb">188526887</em></a></dd>

			</dl>
			<dl>
				<dt>携手云购</dt>
				<dd>
					<a href="http://localhost:9999/?/single/business" target="_blank">商务合作</a>
				</dd>
				<dd>
					<a href="http://localhost:9999/?/link" target="_blank">友情链接</a>
				</dd>
				<dd>
					<a href="http://localhost:9999/?/group_qq" target="_blank">官方QQ群交流</a>
				</dd>
			</dl>
		</div>

		<!--<div class="service-promise">
			<ul>
				<li class="M-android "><s class="F-bg"></s>
					<p class="F-txt">
						<b class="gray9">手机客户端下载</b>
						<a class="orange_btn" href="/app/index.html" target="_blank"><img src="/statics/uploads/banner/ljxz_03.png" /></a>
					</p>
				</li>
				<li class="M-wx">
					<a target="_blank">
						<s class="F-wxm"> <img
									src="/Public/P/images/index/wzg-wx.jpg" border="0" alt="" width="75" height="75"></s>
					</a>
					<p class="F-txt">
						<a target="_blank"> </a>
						<a target="_blank"> <b class="gray9"><i></i>关注官方微信</b> <s class="F-wx-img"></s>
						</a>
					</p>
				</li>
				<li class="M-time"><s class="F-bg"></s>
					<p class="F-txt" id="pServerTime">
						<b class="gray9">服务器时间</b><span id="sp_ServerTime" class="F-txt-dig"></span>
					</p>
				</li>
				<li class="M-fund"><s class="F-bg"></s>
					<p class="F-txt">
						<b class="gray9">云购公益基金</b> <a href="http://localhost:9999/?/single/fund" target="_blank"><span class="F-fund-buy fam-y"
									id="spanFundTotal"><i class="rmbf">￥</i>0000000.00</span></a>
					</p>
				</li>
				<li class="M-tel"><s class="F-bg"></s>
					<p class="F-txt">
						<b class="gray9">服务热线</b> <i class="F-tel-img">4006-000-000</i> <a href="http://wpa.qq.com/msgrd?v=3&uin=123456&site=qq&menu=yes" id="btnBtmQQ" class="F-icon-guest" target="_blank"><s></s>在线客服</a>
					</p>
				</li>
			</ul>
		</div>-->
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
		<a href="http://localhost:9999/?/group">云购圈子</a>
		<b></b>
		<a href="<?php echo U('Help/index', '', '');?>/1">关于云购</a>
		<b></b>
		<a href="http://localhost:9999/?/single/business">合作专区</a>
		<b></b>
		<a href="http://localhost:9999/?/link">友情链接</a>
		<b></b>
		<a href="<?php echo U('Help/index', '', '');?>/13">联系我们</a>
		<b></b>		</div>
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
		var serverTime = <?php echo ($serverTime); ?> * 1000;
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