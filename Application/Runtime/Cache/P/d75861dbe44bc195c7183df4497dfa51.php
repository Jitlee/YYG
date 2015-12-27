<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="一元云购" />
    <meta name="description" content=""/>
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/P/css/header222.css?date=20140731">
	<link href="/Public/P/css/register.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/Public/P/css/index2.css?date=20140731">
	<link rel="stylesheet" type="text/css" href="/Public/P/css/comm.css?date=20140731">	
	 <link rel="stylesheet" type="text/css" href="/Public/P/css/comm1.css?date=20140731">
	 	
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>	
	<script type="text/javascript" src="/Public/P/js/jquery.cookie.js"></script>
    <script type="text/javascript" id="pageJS" data="/Public/P/js/Index.js"></script>
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
             <!--<li id="liMobile" class="u-arr">
                 <div class="u-menu-hd">
                     <a href="#" title="手机云购">手机云购</a>
                     <div class="f-top-arrow"><cite>◆</cite><b>◆</b></div>
                 </div>
                 <div class="u-select u-select-weix">
                     <p>
                         <a href="#" target="_blank">
                             <img src="/Public/P/images/wx-2014.jpg?v=20141105" />
                             下载客户端
                         </a>
                     </p>
                 </div>
             </li>-->
             <li class="f-gap"><s></s></li>
             <li>
                 <div class="u-menu-hd">
                     <a href="{WEB_PATH}/group_qq" target="_blank" title="官方QQ群">官方QQ群</a>
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
                 <h3><a href="{WEB_PATH}/goods_list">全部商品分类</a><em></em></h3>
             </div>
 
         </div>
         <div class="nav-main fl">
             <ul>
                 <li class="f-nav-home f-active"><a href="/">首页</a></li>
                 <li class="f-nav-lottery"><a href="{WEB_PATH}/goods_lottery">最新揭晓</a></li>
                 <li class="f-nav-share"><a href="{WEB_PATH}/go/shaidan">晒单分享</a></li>
                 <li class="f-nav-group"><a href="{WEB_PATH}/group">云购圈</a></li>
                 <li class="f-nav-guide"><a href="{WEB_PATH}/single/newbie">新手指南</a></li>
             </ul>
         </div>
         <div id="divHCart" class="nav-cart fr">
             <div class="nav-cart-btn">
                 <a href="{WEB_PATH}/member/cart/cartlist" target="_blank"><i class="f-cart-icon"></i>购物车<span id="sCartTotal">(0)</span></a>
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
</script>

<div style="position: relative;" class="w1190">
	<!-- 商品分类 -->
<div id="divSortList" class="m-all-sort">
	<?php if(is_array($allCategories)): foreach($allCategories as $key=>$c): ?><dl>
		     <dt><a href=""><?php echo ($c["name"]); ?></a></dt>
		     <dd>
			     <?php if(is_array($c['brands'])): foreach($c['brands'] as $key=>$b): ?><a ><?php echo ($b["name"]); ?></a><?php endforeach; endif; ?>
		     </dd>
		 </dl><?php endforeach; endif; ?>
 </div>
 
 <!-- 幻灯片 -->
<link rel="stylesheet" href="/Public/P/css/swiper.min.css" />
<script src="/Public/P/js/swiper.jquery.min.js"></script>
 <!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php if(is_array($slides)): foreach($slides as $key=>$item): ?><div class="swiper-slide"><a href="<?php echo ($item["link"]); ?>" class="swiper-img" style="background-image: url('<?php echo ($item["img"]); ?>');"></a></div><?php endforeach; endif; ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
</div>

<!-- 幻灯片下方推荐位 -->
<div class="yyg-tuijian">
	<?php if(is_array($tuijians)): foreach($tuijians as $key=>$t): ?><div class="yyg-tuijian-item">
			<p class="title"><a><?php echo ($t["title"]); ?></a></p>
			<p class="gray">已参与 <?php echo ($t["canyurenshu"]); ?> 人次</p>
			<img src="<?php echo ($t["thumb"]); ?>" style="width:100px;height:100px;"/>
		</div><?php endforeach; endif; ?>
</div>

<!-- 商品列表 -->
<div class="g-wrap w1190">
	<div class="g-title">
        <h3 class="fl">最新揭晓</h3>
        <div class="m-other fr">
            <cite>
                <a href="" target="_blank" title="查看全部商品">查看全部商品</a>
            </cite>
        </div>
    </div>
    <div class="g-list">
   		<ul id="ulNewAwary">
		<?php if(is_array($zuixins)): foreach($zuixins as $key=>$item): ?><li >
                <dl>
                    <dt><a href="" target="_blank" title="第<?php echo ($item["qishu"]); ?>期 <?php echo ($item["title"]); ?>" rel="nofollow">
                        <img src="<?php echo ($item["thumb"]); ?>" alt="第<?php echo ($item["qishu"]); ?>期 <?php echo ($item["title"]); ?>" width="300" height="300" /></a></dt>
                    <dd class="f-gx">
                        <div class="f-gx-user">
                            <span>恭喜</span>
                            <span class="blue"><a href="" target="_blank" title="<?php echo ($item["username"]); ?>" class="blue" ><?php echo ($item["username"]); ?></a></span>
                            <span>获得</span>
                        </div>
                    </dd>
                    <dd class="u-name"><a href="" target="_blank" title="第<?php echo ($item["qishu"]); ?>期 <?php echo ($item["title"]); ?>">第<?php echo ($item["qishu"]); ?>期 <?php echo ($item["title"]); ?></a></dd>
                </dl>
                <cite></cite>
            </li><?php endforeach; endif; ?>
    		</ul>
	</div>
    
    <div class="g-title">
        <h3 class="fl">热门推荐</h3>
        <div class="m-other fr">
            <a href="#" target="_blank" title="更多" class="u-more">更多</a>
        </div>
    </div>
    <div class="g-hot clrfix">
    		<div class="g-hotL fl">
    			<?php if(is_array($remens)): foreach($remens as $key=>$r): ?><div class="g-hotL-list">
				<div class="g-hotL-con">
					<ul>
						<li class="g-hot-pic">
						<a title="<?php echo ($r["title"]); ?>" target="_blank" href="#">
						<img src="<?php echo ($r["thumb"]); ?>" alt="<?php echo ($r["title"]); ?>">
						</a>
						</li>
						<li class="g-hot-name">
						<a title="<?php echo ($r["title"]); ?>" target="_blank" href="http://192.168.0.103:8080/YYYGCMS/?/goods/43"><?php echo ($r["title"]); ?></a>
						</li>
						<li class="gray">价值：￥<?php echo ($r["money"]); ?></li>
						<li class="g-progress">
							<dl class="m-progress">
								<dt title="已完成">
									<b style="width:<?php echo ($r['canyurenshu']*100/$r['zongrenshu']); ?>%"></b>
								</dt>
								<dd>
									<span class="orange fl"><em><?php echo ($r["canyurenshu"]); ?></em>已参与</span>
									<span class="gray6 fl"><em><?php echo ($r["zongrenshu"]); ?></em>总需人次</span>
									<span class="blue fr"><em><?php echo ($r["shengyurenshu"]); ?></em>剩余</span>
								</dd>
							</dl>
						</li>
						<li>
							<a class="u-imm" title="立即1元云购" target="_blank" href="">立即1元云购</a>
						</li>
					</ul>
				</div>
			</div><?php endforeach; endif; ?>
    		</div>
    </div>
    
    <div class="g-title m-sort">
        <h3 class="fl">即将揭晓</h3>
        <div class="fr">
            <?php if(is_array($allCategories)): foreach($allCategories as $key=>$c): ?><a href="<?php echo U('Category/index', '', '');?>/" target="_blank" title="<?php echo ($c["name"]); ?>"><?php echo ($c["name"]); ?></a><?php endforeach; endif; ?>
            <a href="" target="_blank" title="全部">全部</a>
        </div>
    </div>
    <div class="announced-soon clrfix" id="divSoonGoodsList">
    	<?php if(is_array($jijiagns)): foreach($jijiagns as $key=>$j): ?><div class="soon-list-con">
			<div class="soon-list">
				<ul>
					<li class="g-soon-pic">
						<a title="<?php echo ($j["title"]); ?>" target="_blank" href="http://192.168.0.103:8080/YYYGCMS/?/goods/47">
							<img id="img_274277" src="<?php echo ($j["thumb"]); ?>" alt="<?php echo ($j["title"]); ?>">
						</a>
					</li>
					<li class="soon-list-name">
						<a title="<?php echo ($j["title"]); ?>" target="_blank" href=""><?php echo ($j["title"]); ?></a>
					</li>
					<li class="gray">价值：￥<?php echo ($j["money"]); ?></li>
					<li class="g-progress">
						<dl class="m-progress">
							<dt title="">
								<b style="width:<?php echo ($j['canyurenshu']*100/$j['zongrenshu']); ?>%;"></b>
							</dt>
							<dd>
								<span class="orange fl"><em><?php echo ($j["canyurenshu"]); ?></em>已参与</span>
								<span class="gray6 fl"><em><?php echo ($j["zongrenshu"]); ?></em>总需人次</span>
								<span class="blue fr"><em><?php echo ($j["shengyurenshu"]); ?></em>剩余</span>
							</dd>
						</dl>
					</li>
					<li>
						<a class="u-now" title="立即1元云购" target="_blank" href="">立即1元云购</a>
						<a class="u-cart" title="加入到购物车" href="javascript:;">
							<s></s>
						</a>
					</li>
				</ul>
			</div>
		</div><?php endforeach; endif; ?>
    </div>
</div>

<script type="text/javascript">
	$(function() {
		var mySwiper = new Swiper ('.swiper-container', {
	      // Optional parameters
	      direction: 'horizontal',
	      pagination: '.swiper-pagination',
	      autoplay: 3000,
	      loop: true
	   });
	});
</script>

</div>

<link rel="stylesheet" type="text/css" href="/Public/P/css/header1.css" />
<!--新闻列表-->
<div class="g-frame-footer">
	<div class="g-width footer">
		<div class="M-guide">
			<dl class="ft-newbie">
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
			</dl>

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

		<div class="service-promise">
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
			<a id="btnMyCart" href="{WEB_PATH}/member/cart/cartlist" target="_blank" class="quick_cartA"><b>购物车</b><s></s><em>0</em></a>
			<div style="display: none;" id="rCartlist" class="Roll_mycart">
				<ul style="display: none;"></ul>
				<div class="quick_goods_loding" id="rCartLoading">
					<img border="0" alt="" src="{G_TEMPLATES_STYLE}/images/goods_loading.gif">正在加载......
				</div>
				<p id="p1" style="display: none;">共计<span id="rCartTotal2">0</span> 件商品 金额总计：<span class="rmbgray" id="rCartTotalM">0</span></p>
				<h3 style="display: none;">
							<a target="_blank" href="{WEB_PATH}/member/cart/cartlist"
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
	});
</script>
<!--end右侧导航-->
</body>

</html>