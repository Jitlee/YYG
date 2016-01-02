<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="一元云购" />
    <meta name="description" content=""/>
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/P/css/header222.css?date=20140731">
    <link rel="stylesheet" type="text/css" href="/Public/P/css/index2.css?date=20140731">
	<link href="/Public/P/css/register.css" rel="stylesheet" type="text/css" />	
	 <link rel="stylesheet" type="text/css" href="/Public/P/css/comm.css?date=20140731">
	 <link rel="stylesheet" type="text/css" href="/Public/P/css/comm1.css?date=20140731">
    <link rel="stylesheet" type="text/css" href="/Public/P/css/header1.css?date=20140731">
	 	
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>	
	<script type="text/javascript" src="/Public/P/js/jquery.cookie.js"></script>
    <script type="text/javascript" id="pageJS" data="/Public/P/js/Index.js"></script>
    <script type="text/javascript" src="/Public/P/js/jquery.fly.min.js"></script>
</head>

<body id="loadingPicBlock" class="home" rf="1" >
<SCRIPT language=javascript> 
<!-- 
window.onerror=function(){return true;} 
// --> 
</SCRIPT> 
    <div class="wrapper">
        <!--头部-->
        <!--顶部-->
 <div class="g-toolbar">
     <div class="w1190">
         <ul class="fl">
             <li>
                 <div class="u-menu-hd">
                     <a id="addSiteFavorite" href="javascript:;" title="收藏">收藏</a>
                 </div>
             </li>
             <li class="f-gap"><s></s></li>
            
             <li class="f-gap"><s></s></li>
             
             <li>
                 <div class="u-menu-hd">                  
                     <a href="<?php echo U('Help/group_qq', '', '');?>" target="_blank" title="官方QQ群">官方QQ群</a>
                 </div>
             </li>
         </ul>
         <ul id="ulTopRight" class="fr">
         	<?php if($_SESSION['p_']['loginstatus']== 1): ?><li>
				<div class="u-menu-hd u-menu-login">
				<a class="blue" title="" href="<?php echo U('Home/index', '', '');?>"><?php echo get_username();?></a>
				<a title="退出" href="<?php echo U('Main/cook_end', '', '');?>">[退出]</a>
				</div>
				</li>
				<li class="f-gap">
				<s></s>
				</li>
			<?php else: ?>
				<li id="logininfo">
				<div class="u-menu-hd">
				<a title="登录" href="<?php echo U('Main/login', '', '');?>">登录</a>
				</div>
				</li>
				<li class="f-gap">
				<s></s>
				</li>
				<li>
				<div class="u-menu-hd">
				<a title="注册" href="<?php echo U('Main/register', '', '');?>">注册</a>
				</div>
				</li>
				<li class="f-gap">
				<s></s>
				</li><?php endif; ?>
			<li id="liMember" class="u-arr">
				<div class="u-menu-hd">
					<a title="我的" href="<?php echo U('Home/index', '', '');?>">我的</a>
                     <div class="f-top-arrow"><cite>◆</cite><b>◆</b></div>
                 </div>
                 <div class="u-select u-select-my">
                     <span><a href="<?php echo U('Home/userbuylist', '', '');?>" title="云购记录">云购记录</a></span>
                     <span><a href="<?php echo U('Home/orderlist', '', '');?>" title="获得的商品">获得的商品</a></span>
                     <span><a href="<?php echo U('Home/modify', '', '');?>" title="个人设置">个人设置</a></span>
                 </div>
             </li>
             <li class="f-gap"><s></s></li>
             <li id="liTopUMsg" class="u-arr" style="display: none;">
                 <div class="u-menu-hd">
                     <a href="#" title="消息">消息</a>
                     <h3 style="display: none;"></h3>
                     <div class="f-top-arrow"><cite>◆</cite><b>◆</b></div>
                 </div>
                 <div class="u-select u-select-my">
                     <span><a href="#" title="好友请求">好友请求</a></span>
                     <span><a href="#" title="系统消息">系统消息</a></span>
                     <span><a href="#" title="私信" class="f-msg">私信</a></span>
                 </div>
             </li>
             <li class="f-gap" style="display: none;"><s></s></li>
             <li>
                 <div class="u-menu-hd">
                     <a href="#" title="帮助">帮助</a>
                 </div>
             </li>
             <li class="f-gap"><s></s></li>
             <li>
                 <div class="u-menu-hd">
                     <a id="btnTopQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo config('qq');?>&site=qq&menu=yes" title="在线客服" class="u-service-off u-service"><i></i>在线客服</a>
                 </div>
             </li>
         </ul>
     </div>
 </div><!--头部-->
 <div class="g-header">
     <div class="w1190">
         <div id="topLogoAd" class="logo_1yyg fl">
             <a class="logo_1yyg_img" href="<?php echo U('Index/index', '', '');?>" title="">
					<img src="/Public/P/images/logo/logo.jpg"/>
				</a>
         </div>
         <div class="search_cart_wrap fr">
             <div class="number">
                 <a href="{WEB_PATH}/buyrecord" target="_blank">
                     <ul id="spHeadTotalNum">			 
      					<li class="nobor gray6">累计参与</li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci9) && ($goCountRenci9 !== ""))?($goCountRenci9):0); ?></em></cite><i></i></li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci8) && ($goCountRenci8 !== ""))?($goCountRenci8):0); ?></em></cite><i></i></li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci7) && ($goCountRenci7 !== ""))?($goCountRenci7):0); ?></em></cite><i></i></li>
                         <li class="nobor">,</li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci6) && ($goCountRenci6 !== ""))?($goCountRenci6):0); ?></em></cite><i></i></li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci5) && ($goCountRenci5 !== ""))?($goCountRenci5):0); ?></em></cite><i></i></li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci4) && ($goCountRenci4 !== ""))?($goCountRenci4):0); ?></em></cite><i></i></li>
                         <li class="nobor">,</li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci3) && ($goCountRenci3 !== ""))?($goCountRenci3):0); ?></em></cite><i></i></li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci2) && ($goCountRenci2 !== ""))?($goCountRenci2):0); ?></em></cite><i></i></li>
                         <li class="num"><cite><em><?php echo ((isset($goCountRenci1) && ($goCountRenci1 !== ""))?($goCountRenci1):0); ?></em></cite><i></i></li> 
                         <li class="nobor gray6 u-secondary">人次<b><s></s></b></li>
                     </ul>
                 </a>
             </div>
 
             <div class="search">
                 <div class="form">
                     <input id="txtSearch" type="text" value="输入“手机”试试" />
                     <span>
                         <a href="{WEB_PATH}/s_tag/苹果" target="_blank">苹果</a>
                         <a href="{WEB_PATH}/s_tag/电脑" target="_blank">电脑</a>
                         <a href="{WEB_PATH}/s_tag/手机" target="_blank">手机</a>
                     </span>
                 </div>
                 <a id="butSearch" href="javascript:;" class="seaIcon"><i></i></a>
             </div>
         </div>
     </div>
 </div>
 <!--导航-->
 <div class="g-nav">
     <div class="w1190">
         <div id="divGoodsSort" class="m-menu fl">
             <div class="m-menu-all">
                 <h3><a href="<?php echo U('Category/index', '', '');?>">全部商品分类</a><em></em></h3>
             </div> 
         </div>
         <div class="nav-main fl">
             <ul>
                 <li class="f-nav-home f-active"><a href="/index.php/P">首页</a></li>
                 <li class="f-nav-lottery"><a href="<?php echo U('Lottery/index', '', '');?>">最新揭晓</a></li>
                 <li class="f-nav-share"><a href="<?php echo U('Saidan/index', '', '');?>">晒单分享</a></li>
                 <li class="f-nav-group"><a href="<?php echo U('Paimai/index', '', '');?>">拍卖专区</a></li>
                 <li class="f-nav-guide"><a href="<?php echo U('Help/nb', '', '');?>">新手指南</a></li>
             </ul>
         </div>
         <div id="divHCart" class="nav-cart fr">
             <div class="nav-cart-btn">
                 <a href="<?php echo U('Cart/index', '', '');?>" target="_blank"><i class="f-cart-icon"></i>购物车<span id="sCartTotal">(<span class="cart-count"><?php echo session('cartCount');?></span>)</span></a>
             </div>
             <div class="nav-cart-con">
                 <div class="m-loading-2014"><em></em></div>
                 <div class="nav-car-cartEmpty"><i></i>您的购物车为空 !</div>
                 <div class="nav-cart-select"></div>
                 <div class="nav-cart-pay"></div>
             </div>
         </div>
 
     </div>
 </div>

<div style="position: relative;" class="w1190">
	<link rel="stylesheet" type="text/css" href="/Public/P/css/GoodsDetail.css"/>
<link rel="stylesheet" type="text/css" href="/Public/P/css/cloud-zoom.css"/>
<style type="text/css">
	em {
		color: #f60;
	}
	
	.paimai-time {
		margin: 0;
		padding: 0;
		height: 50px;	
		position: relative;
		border:#E0DFE3 1px solid;
		overflow: hidden;
		width: 335px;
		margin-bottom: 15px;
	}
	.paimai-time dt{
		background-color: #F60;
		width: 45px;
		height:50px;
		line-height: 20px;
		border: 0;
		padding: 0;
		padding-top: 5px;
		float: left;
		color: #fff;
		font-size: 13px;
		text-align: center;
	}
	
	.paimai-time dd {
		padding-left: 55px;
		display: block;
		height: 25px;
		line-height: 25px;
	}
	
	.paimai-detail {
		margin-top: 30px;
		border-top: #E0DFE3 solid 1px;
		border-bottom: #E0DFE3 solid 1px;
		padding: 15px 0;
	}
	
	.paimai-detail ul {
		margin: 0;
		padding: 0;
		list-style: none;
		font-size: 12px;
		color:#666;
	}
	
	.paimai-detail li {
		display: inline-block;
		zoom: *;
		text-align: left;
		height: 30px;
		line-height: 30px;
	}
	
	.paimai-detail .paimai-detail-label {
		width: 60px;
	}
	
	.paimai-detail .paimai-detail-value {
		width: 100px;
	}
	
	.paimai-money {
		font-size: 12px;
		line-height: 40px;
	}
	.paimai-money .small {
		font-size: 16px;
		font-weight: bold;
	}
	.paimai-money b {
		font-size: 30px;
		font-weight: bold;
	}
	
	.Det_button img {
		height: 36px;
		width: 36px;
		vertical-align: middle;
	}
	
	.paimai-end .paimai-time dt {
		background-color: #999;
	}
	
	.pm-bid-flow {
	    position: relative;
	    overflow: hidden;
	    border: 1px solid #f5f5f5;
	    z-index: 12;
	    margin: 30px 10px;
	}
	
</style>
<script type="text/javascript" src="/Public/P/js/cloud-zoom.min.js"></script>
<div class="Current_nav">
	<a href="{WEB_PATH}">首页</a> <span>&gt;</span>
	<span>&gt;</span>拍卖详情
</div>
<div class="show_content">
	<!-- 商品信息 -->
	<div class="Pro_Details">
		<h1><span ><?php echo ($data["title"]); ?></span><em><?php echo ($data["subtitle"]); ?></em></h1>
		<div class="Pro_Detleft">
			<div class="clould-zoom">
				<div class="clould-zoom-big">
					<img src="<?php echo ($firstImage["image_url"]); ?>" />
					<div class="clould-zoom-bird-outter">
						<div class="clould-zoom-bird"></div>
					</div>
				</div>
				<div class="clould-zoom-view" style="background-image: url(<?php echo ($firstImage["image_url"]); ?>);"></div>
				<div class="cloud-zoom-scroll">
					<a class="colud-zoom-prev cloud-zoom-disabled"><i>&nbsp;</i></a>
					<ul class="clould-zoom-list">
						<?php if(is_array($images)): foreach($images as $key=>$item): ?><li class="cloud-zoom-item" ref="<?php echo ($item["image_url"]); ?>">
							<img src="<?php echo ($item["image_url"]); ?>" />
						</li><?php endforeach; endif; ?>
						<li class="cloud-zoom-clear"></li>
					</ul>
					<a class="colud-zoom-next"><i>&nbsp;</i></a>
				</div>
			</div>
			<script type="text/javascript">
				$(function() {
					$(".clould-zoom").cloudZoom();
				});
			</script>		
		</div>
		<div class="Pro_Detright">
			<?php if($data["status"] < 2): ?><dl class="paimai-time">
					<dt>正在<br/>进行</dt>
			    		<dd>距离结束仅剩：<time countdown="<?php echo (strtotime($data["end_time"])); ?>000"></time></dd>
			    		<dd>报名人数<em class="baomingrenshu"><?php echo ($data["baomingrenshu"]); ?></em></dd>
			    </dl>
			    <script type="text/javascript" src="/Public/P/js/count-down.js"></script>
				<?php if(isset($isBaozheng)): ?><!-- 已交保证金 -->
					<p class="paimai-money">当前价格：<span class="small">¥</span>&nbsp;<b class="zuigaojia"><?php echo ($data["zuigaojia"]); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;出价<em class="chujiacishu"><?php echo ($data["chujiacishu"]); ?></em>次</p>
					<div id="divNumber" class="Pro_number">
						我要出价
						<a href="javascript:void(0);" class="num_del" id="shopsub">-</a>
						<input style="border:1px solid #CFCFCF;width: 100px;" type="text" value="<?php echo ($zuidijia); ?>" maxlength="7" onKeyUp="value=value.replace(/\D/g,'')" class="num_dig" id="num_dig"/>
						<a href="javascript:void(0);" class="num_add" id="shopadd">+</a>
					</div>
					<div id="divBuy" class="Det_button">
						<a id="chujiaButton" href="javascript:void(0);" class="Det_Shopbut"><img src="/Public/P/images/baozhengjin.png"/>出价</a>
					</div>
					<script type="text/javascript">
						$(function() {
							var qipaijia = <?php echo ($data["qipaijia"]); ?>;
							var zuigaojia = <?php echo ($data["zuigaojia"]); ?>;
							var jiafujia = <?php echo ($data["jiafujia"]); ?>;
							var zuidijia = <?php echo ($zuidijia); ?>;
							var chujiacishu = <?php echo ($data["chujiacishu"]); ?>;
							var baomingrenshu = <?php echo ($data["baomingrenshu"]); ?>;
							var chujiaInput = $("#num_dig").change(onChujiaChange);
							var cishuLabels = $(".chujiacishu");
							var baomingLabels = $(".baomingrenshu");
							var zuigaoLabels = $(".zuigaojia");
							var refreshHandler = null;
							startReresh();
							
							function startReresh() {
								// 自动刷新最高价状态
								refreshHandler = window.setInterval(function() {
									$.get("<?php echo U('refresh', '', '');?>/<?php echo ($data["gid"]); ?>", null, function(data) {
										if(data.status < 2) {
											baomingrenshu = data.baomingrenshu;
											chujiacishu = data.chujiacishu;
											zuigaojia = data.zuigaojia;
											if(data.zuigaojia > zuidijia) {
												zuidijia = zuigaojia + jiafujia;
											}
											cishuLabels.text(chujiacishu);
											baomingLabels.text(baomingrenshu);
											zuigaoLabels.text(zuigaojia);
											
											if(Number(chujiaInput.val()) < zuidijia) {
												chujiaInput.val(zuidijia);
											}
										} else {
											window.location.href = "<?php echo U('view', '', '');?>/<?php echo ($data["gid"]); ?>";
										}
									})
								}, 10000);
							}
							
							// 出价
							var chujiaButton = $("#chujiaButton").click(function() {
								chujiaButton.prop("disabled", true);
								var money = Number(chujiaInput.val());
								$.post("<?php echo U('chujia', '', '');?>/<?php echo ($data["gid"]); ?>/" + money,null,function(result) {
									chujiaButton.prop("disabled", false);
									if(result.status != 0) {
										alert(result.message);
									} else {
										zuigaojia = money;
										chujiacishu++;
										zuigaoLabels.text(zuigaojia);
										cishuLabels.text(chujiacishu);
										zuidijia = zuigaojia + jiafujia;
										chujiaInput.val(zuidijia);
										alert("出价成功");
									}
								});
							});
							
							$("#shopsub").click(function() {
								var money = Number(chujiaInput.val());
								if(zuidijia <= money - jiafujia) {
									chujiaInput.val(money - jiafujia);
								}
							});
							$("#shopadd").click(function() {
								var money = Number(chujiaInput.val());
								chujiaInput.val(money + jiafujia);
							});
							
							function onChujiaChange() {
								var money = Number(chujiaInput.val());
								if(money < zuidijia) {
									chujiaInput.val(zuidijia);
								}
							}
						});
					</script>
				<?php else: ?>
					<!-- 未交保证金 -->
				    <p class="paimai-money">当前价格：<span class="small">¥</span>&nbsp;<b><?php echo ($data["zuigaojia"]); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;出价<em class="chujiacishu"><?php echo ($data["chujiacishu"]); ?></em>次</p>
				    <p class="paimai-money">保证金：<em><span class="small">¥</span>&nbsp;<b><?php echo ($data["baozhengjin"]); ?></b></em> <span>&nbsp;&nbsp;&nbsp;&nbsp;拍卖不成则结束退还</span></p>
				    <p class="paimai-money">参与资格： 本次拍卖仅支持注册及以上级别会员参与</p>
				    
				    <div id="divBuy" class="Det_button">
						<a href="<?php echo U('Pay/baozhengjin','','');?>/<?php echo ($data["gid"]); ?>" class="Det_Shopbut"><img src="/Public/P/images/baozhengjin.png"/>交保证金报名</a>
					</div><?php endif; ?>
			<?php else: ?>
				<!-- 已结束 -->
				<div class="paimai-end">
					<dl class="paimai-time">
						<dt>拍卖<br/>结束</dt>
				    		<dd>结束时间：<?php echo ($data["end_time"]); ?></dd>
				    		<dd>报名人数<em><?php echo ($data["baomingrenshu"]); ?></em></dd>
				    </dl>
				    <p class="paimai-money">最高价格：<em><span class="small">¥</span>&nbsp;<b><?php echo ($data["zuigaojia"]); ?></b></em></p>
				    <p class="paimai-money">参与资格： 本次拍卖仅支持注册及以上级别会员参与</p>
				    
				    <div id="divBuy" class="Det_button">
						<a href="javascript:void(0);" class="Det_Shopbut_exit"><img src="/Public/P/images/baozhengjin.png"/>拍卖已结束</a>
					</div>
				</div><?php endif; ?>
		    
		    <div class="paimai-detail">
		    		<ul>
	    				<li class="paimai-detail-label">起拍价：</li>
	    				<li class="paimai-detail-value">¥ <?php echo ($data["qipaijia"]); ?></li>
	    				<li class="paimai-detail-label">加价幅度：</li>
	    				<li class="paimai-detail-value"><em>¥ <?php echo ($data["jiafujia"]); ?></em></li>
	    				<li class="paimai-detail-label">保留价：</li>
	    				<li><?php if($data["baoliujia"] > 0): ?>有<?php else: ?>无<?php endif; ?></li>
	    				
	    				<li class="paimai-detail-label">包邮：</li>
	    				<li class="paimai-detail-value"><?php if($data["baoliujia"] > 0): ?>是<?php else: ?>否<?php endif; ?></li>
	    				<li class="paimai-detail-label">拍卖方式：</li>
	    				<li class="paimai-detail-value">升价拍</li>
	    				<li class="paimai-detail-label">佣金：</li>
	    				<li>无</li>
		    		</ul>
		    </div>
			
			<!--显示揭晓动画 end-->		
			<div class="Security">
				<ul>
					<li><a href="{WEB_PATH}/help/4" target="_blank"><i></i>100%公平公正</a></li>
					<li><a href="{WEB_PATH}/help/5" target="_blank"><s></s>100%正品保证</a></li>
					<li><a href="{WEB_PATH}/help/7" target="_blank"><b></b>全国免费配送</a></li>
				</ul>
			</div>	
		</div>
	</div>

	<div class="pm-bid-flow">
		<img width="948" height="46" src="/Public/P/images/pm-bid-flow.png" class="">
	</div>
</div>
    						
<!-- 商品信息导航 -->
<div class="ProductTabNav">
	<div id="divProductNav" class="DetailsT_Tit">
		<div class="DetailsT_TitP">
			<ul>
				<li class="Product_DetT DetailsTCur"><span class="DetailsTCur">商品详情</span></li>
				<li id="liUserBuyAll" class="All_RecordT"><span class="">出价次数(<span class="chujiacishu"><?php echo ($data["chujiacishu"]); ?></span>)</span></li>
				<li class="Single_ConT"><span class="">卖家承诺</span></li>
				<li class="Single_ConT"><span class="">保证金须知</span></li>
			</ul>
			<!-- <p><a id="btnAdd2Cart" href="javascript:;" class="white DetailsT_Cart"><s></s>加入购物车</a></p> -->
		</div>
	</div>
</div>

<!--补丁3.1.6_b.0.1-->
<div id="divContent" class="Product_Content">
	<!-- 商品内容 -->
	<div class="Product_Con"><?php echo ($data["content"]); ?></div>
    <!-- 商品内容 -->
    
	<div id="bitem" class="AllRecordCon">
		<iframe g_src="<?php echo U('Paimai/record', '', '');?>/<?php echo ($data["gid"]); ?>" style="width:930px; border:none;height:550px" frameborder="0" scrolling="no"></iframe>
	</div>	
	<!-- 卖家承诺 -->
	<div class="Single_Content">
		<iframe name="ifrCN" g_src="<?php echo U('Paimai/article', '', '');?>/chengnuo" style="width:978px; border:none;height:500px" frameborder="0" scrolling="no" onload="this.style.height=window.frames['ifrCN'].document.documentElement.scrollHeight + 'px'"></iframe>
	</div>
    <!-- 卖家承诺 -->	
    
	<!-- 保证金须知 -->
	<div class="Single_Content">
		<iframe name="ifrBZ" g_src="<?php echo U('Paimai/article', '', '');?>/baozhengjin" style="width:978px; border:none;height:500px" frameborder="0" scrolling="no" onload="this.style.height=window.frames['ifrBZ'].document.documentElement.scrollHeight + 'px'"></iframe>
	</div>
    <!-- 保证金须知 -->	
</div>
<!--补丁3.1.6_b.0.1-->

<script src="/Public/P/js/knockout-3.3.0.js" type="text/javascript"></script>
<script type="text/javascript">
function set_iframe_height(fid,did,height){	
	$("#"+fid).css("height",height);	
}

$(function(){
	$("#ulRecordTab li").click(function(){
		var add=$("#ulRecordTab li").index(this);
		$("#ulRecordTab li").removeClass("Record_titCur").eq(add).addClass("Record_titCur");
		$(".Pro_Record ._hiden").hide().eq(add).show();
	});
	
	var DetailsT_TitP = $(".DetailsT_TitP ul li");
	var divContent    = $("#divContent div");	
	DetailsT_TitP.click(function(){
		var index = $(this).index();
			DetailsT_TitP.removeClass("DetailsTCur").eq(index).addClass("DetailsTCur");
	
			var iframe = divContent.hide().eq(index).find("iframe");
			if (typeof(iframe.attr("g_src")) != "undefined") {
			  	 iframe.attr("src",iframe.attr("g_src"));
				 iframe.removeAttr("g_src");
			}
			divContent.hide().eq(index).show();
	});
	
	$("#btnUserBuyMore").click(function(){
		fouli.removeClass("DetailsTCur").eq(1).addClass("DetailsTCur");
		
		$("#divContent .hide").hide().eq(1).show();
		$("html,body").animate({scrollTop:941},1500);
		$("#divProductNav").addClass("nav-fixed");
	});
	$(window).scroll(function(){
		if($(window).scrollTop()>=941){
			$("#divProductNav").addClass("nav-fixed");
		}else if($(window).scrollTop()<941){
			$("#divProductNav").removeClass("nav-fixed");
		}
	});
	
	// 出价记录
	var chujiaVM = ko.observableArray();
	ko.applyBindings(model, document.getElementById("bitem"));
});
</script> 
</div>

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