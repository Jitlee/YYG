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
                     <a href="#" target="_blank" title="官方QQ群">官方QQ群</a>
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
	
<link rel="stylesheet" type="text/css" href="/Public/P/css/header.css?date=20140731">
<link rel="stylesheet" type="text/css" href="/Public/P/css/GoodsList.css?date=20140731">
<style>
.wrap{width:1190px;}.Current_nav{width:1190px;}.list_Curtit{width:1190px;}.list_class{width:1190px;}.list_Sort{width:1190px;}.goods-iten{width:228px;margin:13px 0 0 11px;}.g-width{width:1190px;}.list_class dd{width:1118px;}.list_class dd li{width:123px;}
</style>
<div class="wrap" id="loadingPicBlock">
	<div class="Current_nav"><a href="/index.php/P">首页</a> &gt; <?php echo ($title); ?></div>
	<div id="current" class="list_Curtit">
		<h1 class="fl"><?php echo ($title); ?></h1>
		<span id="spTotalCount">(共<em class="orange"><?php echo ((isset($total) && ($total !== ""))?($total):0); ?></em>件相关商品)</span>
	</div>	
	<div class="list_class">
		<dl>
			<dt>分类</dt>
			<dd id="ddBrandList">
				<ul>
	                <li><a href="<?php echo U('Category/index', '', '');?>/" <?php if($cid == 0): ?>class="ClassCur"<?php endif; ?>>全部</a></li>
					<?php if(is_array($allCategories)): foreach($allCategories as $key=>$item): ?><li><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($item["cid"]); ?>" <?php if($cid == $item['cid']): ?>class="ClassCur"<?php endif; ?>><?php echo ($item["name"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</dd>
		</dl>
	</div>
	
	<div class="list_class">
		<dl>
			<dt>品牌</dt>
			
			<dd id="ddBrandList_brand" <?php if($brandsCount > 17): ?>style="height:54px"<?php endif; ?>>
				<ul>
					<li><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>" <?php if($bid == 0): ?>class="ClassCur"<?php endif; ?>>全部</a></li> 
					<?php if(is_array($brands)): foreach($brands as $key=>$item): ?><li><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($item["bid"]); ?>" <?php if($bid == $item['bid']): ?>class="ClassCur"<?php endif; ?>><?php echo ($item["name"]); ?></a></li><?php endforeach; endif; ?>
				</ul>
			</dd>
		</dl>
		<?php if($brandsCount > 17): ?><a id="listClassMore" class="list_classMore" href="javascript:void(0);">展开<i></i></a><?php endif; ?>
	</div>
    <div class="list_Sort">
	    <dl>
		    <dt>排序</dt>
		    <dd>
		        <a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/0" <?php if($sort == 0): ?>class="SortCur"<?php endif; ?>>最新</a>
			    	<a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/1" <?php if($sort == 1): ?>class="SortCur"<?php endif; ?>>即将揭晓</a>
		        <a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/2" <?php if($sort == 2): ?>class="SortCur"<?php endif; ?>>人气</a>
		        <a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/3" <?php if($sort == 3): ?>class="SortCur"<?php endif; ?>>剩余人次</a>
		        <?php if($sort == 4): ?><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/5" class="Price_Sort SortCur">价格 <i></i></a>
		        	<?php elseif($sort == 5): ?>
		        		<a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/4" class="Price_Sort SortCur">价格 <s></s></a>
		        	<?php else: ?>
		        		<a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/4" class="Price_Sort">价格 <s></s></a><?php endif; ?>
	        </dd>
	    </dl>
	</div>
	
	<?php if(isset($list)): ?><!--商品列表-->
	<div class="listContent">
		<ul class="item" id="ulGoodsList">		
			<?php if(is_array($list)): foreach($list as $key=>$item): ?><li class="goods-iten" >
				<div class="pic">
					<a href="<?php echo U('Index/view', '', '');?>/<?php echo ($item["gid"]); ?>" target="_blank" title="<?php echo ($item["title"]); ?>">
						<?php if($item["_time"] < 86400): ?><i class="goods_xp"></i>
						<?php elseif($item["tuijian"] == 1): ?>
							<i class="goods_tj"></i>
						<?php elseif($item["renqi"] == 1): ?>
							<i class="goods_rq"></i><?php endif; ?>
						<img alt="<?php echo ($item["title"]); ?>" src="<?php echo ($item["thumb"]); ?>">
					</a>
					<p name="buyCount" style="display:none;"></p>
				</div>
				<p class="name">
					<a href="<?php echo U('Index/view', '', '');?>/<?php echo ($item["gid"]); ?>" target="_blank" title="<?php echo ($item["title"]); ?>"><?php echo ($item["title"]); ?></a>
				</p>
				<p class="money">价值：<span class="rmbgray"><?php echo ($item["money"]); ?></span></p>
				<div class="Progress-bar">
					<p><span style="width:<?php echo ($item['canyurenshu']*100/$item['zongrenshu']); ?>%"></span></p>
					<ul class="Pro-bar-li">
						<li class="P-bar01"><em><?php echo ($item["canyurenshu"]); ?></em>已参与人次</li>
						<li class="P-bar02"><em><?php echo ($item["zongrenshu"]); ?></em>总需人次</li>
						<li class="P-bar03"><em><?php echo ($item["shengyurenshu"]); ?></em>剩余人次</li>
					</ul>
				</div>
				<div class="gl_buybtn">
					<div class="go_buy">
						<a href="javascript:;" title="立即云购" class="go_Shopping fl">立即云购</a>
						<a href="javascript:void(0);" title="加入购物车" class="go_cart fr add-cart" src="<?php echo ($item["thumb"]); ?>" gid="<?php echo ($item["gid"]); ?>">加入购物车</a>
					</div>
				</div>
			</li><?php endforeach; endif; ?>
		</ul>
		<?php if($num < $total): ?><div class="pagesx">
			<ul id="Page_Ul">
				<li id="Page_Total"><?php echo ($total); ?>条</li>
				<li id="Page_One"><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/<?php echo ($sort); ?>/1">首页</a></li>
				<?php if($pageNo > 1): ?><li id="Page_Prev"><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/<?php echo ($sort); ?>/<?php echo ($pageNo - 1); ?>">上一页</a></li><?php endif; ?>
				<?php if($pageNo > 1): $__FOR_START_1124267353__=$minPageNo;$__FOR_END_1124267353__=$pageNo;for($i=$__FOR_START_1124267353__;$i < $__FOR_END_1124267353__;$i+=1){ ?><li class="Page_Num"><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/<?php echo ($sort); ?>/<?php echo ($i); ?>"><?php echo ($i); ?></a></li><?php } endif; ?>
				<li class="Page_This"><?php echo ($pageNo); ?></li>
				<?php $__FOR_START_1977087591__=$pageNo+1;$__FOR_END_1977087591__=$maxPageNo;for($i=$__FOR_START_1977087591__;$i < $__FOR_END_1977087591__;$i+=1){ ?><li class="Page_Num"><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/<?php echo ($sort); ?>/<?php echo ($i); ?>"><?php echo ($i); ?></a></li><?php } ?>
				<?php if($pageNo < $pageCount): ?><li id="Page_Next"><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/<?php echo ($sort); ?>/<?php echo ($pageNo + 1); ?>">下一页</a></li><?php endif; ?>
				<li id="Page_End"><a href="<?php echo U('Category/index', '', '');?>/<?php echo ($cid); ?>/<?php echo ($bid); ?>/<?php echo ($sort); ?>/<?php echo ($pageCount); ?>">尾页</a></li>
			</ul>
		</div><?php endif; ?>
	</div>
	<!--商品列表完-->
	<?php else: ?>
	<!--未找到商品-->
	<div class="NoConMsg"><span>无相关商品记录哦~！</span></div>
	<!--未找到商品--><?php endif; ?>
	
</div>

<script type="text/javascript">
	$(function() {
		var classMore = $("#listClassMore").click(function() {
			var height = $("#ddBrandList_brand").height();
			if(height == 54) {
				$("#ddBrandList_brand").css("height", "auto");
				classMore.addClass("MoreClick");
				classMore.html("收起<i></i>");
			} else {
				$("#ddBrandList_brand").css("height", "54px");
				classMore.removeClass("MoreClick");
				classMore.html("展开<i></i>");
			}
		});
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