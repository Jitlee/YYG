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
                 <h3><a href="<?php echo U('Category/index', '', '');?>">全部商品分类</a><em></em></h3>
             </div>
 
         </div>
         <div class="nav-main fl">
             <ul>
                 <li class="f-nav-home f-active"><a href="/index.php/P">首页</a></li>
                 <li class="f-nav-lottery"><a href="{WEB_PATH}/goods_lottery">最新揭晓</a></li>
                 <li class="f-nav-share"><a href="{WEB_PATH}/go/shaidan">晒单分享</a></li>
                 <li class="f-nav-group"><a href="{WEB_PATH}/group">云购圈</a></li>
                 <li class="f-nav-guide"><a href="{WEB_PATH}/single/newbie">新手指南</a></li>
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
<link rel="stylesheet" type="text/css" href="__css__/js/cloud-zoom.css"/>
<script type="text/javascript" src="/Public/P/js/gdjs.js"></script>
<script type="text/javascript" src="/Public/P/js/cloud-zoom.min.js"></script>
<script type="text/javascript">
$.fn.CloudZoom.defaults = {
	zoomWidth: '400',
	zoomHeight: '310',
	position: 'right',
	tint: false,
	tintOpacity: 0.5,
	lensOpacity: 0.5,
	softFocus: false,
	smoothMove: 7,
	showTitle: false,
	titleOpacity: 0.5,
	adjustX: 0,
	adjustY: 0
};
</script>
<style type="text/css">
.zoom-section{clear:both;margin-top:20px;}
.zoom-small-image{border:2px solid #dedede;float:left;margin-bottom:20px; width:400px; height:400px;}
.zoom-small-image img{ width:400px; height:400px;}
.zoom-desc{float:left;width:404px; height:52px;margin-bottom:20px; overflow:hidden;}
.zoom-desc p{ width:10000px; height:52px; float:left; display:block; position:absolute; top:0; z-index:3; overflow:hidden;}
.zoom-desc label{ width:50px; height:52px; margin:0 5px 0 0; _margin-right:4px; display:block; float:left; overflow:hidden;}
.zoom-tiny-image{border:1px solid #CCC;margin:0px; width:48px; height:50px;}
.zoom-tiny-image:hover{border:1px solid #C00;}
</style>

<div class="Current_nav">
	<a href="{WEB_PATH}">首页</a> <span>&gt;</span>
	<span>&gt;</span>商品详情
</div>
<div class="show_content">
	<!-- 商品期数 -->
	<div id="divPeriodList" class="show_Period" style="max-height:99px;">		
		<div class="period_Open"><a class="gray02" click="off" id="btnOpenPeriod" href="javascript:void(0);">展开<i></i></a></div>
		{wc:$loopqishu}
	</div>
	<script>
		$("#btnOpenPeriod").click(function(){
				var ui_obj = $("#divPeriodList > ul");
				if($(this).attr("click")=='off'){
					$("#divPeriodList").css("max-height",ui_obj.length*33+"px");	
					$(this).attr("click","on");
					$(this).html("收起<s></s>");
					
				}else{
					$("#divPeriodList").css("max-height","99px");	
					$(this).attr("click","off");
					$(this).html("展开<i></i>");
				}			
		});
	</script>	
	<!-- 商品信息 -->
	<div class="Pro_Details">
		<h1><span>(第<?php echo ($data["qishu"]); ?>期)</span><span ><?php echo ($data["title"]); ?></span><span><?php echo ($data["title"]); ?></span></h1>
		<div class="Pro_Detleft">
			<div class="zoom-small-image">
				<span href="<?php echo ($data["thumb"]); ?>" class = 'cloud-zoom' id='zoom1' rel="adjustX:10, adjustY:-2">
                <img width="80px" height="80px" src="<?php echo ($data["thumb"]); ?>" /></span>
			</div>

			<div class="zoom-desc"> 
				<div class="jcarousel-prev jcarousel-prev-disabled"></div>
				<div class="jcarousel-clip" style="height:55px;width:384px;">
				<p>
					{wc:loop $item['picarr'] $imgtu}                  
					<label href="<?php echo ($data["thumb"]); ?>" class='cloud-zoom-gallery'  rel="useZoom: 'zoom1', smallImage: '<?php echo ($data["thumb"]); ?>'">
					<img class="zoom-tiny-image" src="<?php echo ($data["thumb"]); ?>" /></label>			
					{wc:loop:end} 
				</p>
				</div>
				<div class="jcarousel-next jcarousel-next-disabled"></div>
			</div>
			<script>
				var si=$(".jcarousel-clip label").size();
				var label=si*55;
				$(".jcarousel-clip p").css({width:label,left:"0"});
				if(label>395){
					$(".jcarousel-prev,.jcarousel-next").show();
				}else{
					$(".jcarousel-prev,.jcarousel-next").hide();
				}
				$(".jcarousel-prev").click(function(){
					var le=$(".jcarousel-clip p").css("left");
					var le2=le.replace(/px/,"");
					if(le!='0px'){
						$(".jcarousel-clip p").css({left:le2*1+55});
					}						
				})
				$(".jcarousel-next").click(function(){
					var le=$(".jcarousel-clip p").css("left");
					var le2=le.replace(/px/,"");
					var max_next=-(si-7)*55+"px";
					if(le!=max_next){						
						$(".jcarousel-clip p").css({left:le2*1-55});
					}
				})
			</script>			
			
			{wc:if $sid_code}			
			{wc:if $sid_code['q_showtime']=='N'}
			<div class="Pro_GetPrize">				
				<h2>上期获得者</h2>
				<div class="GetPrize">				    
					<dl>
						<dt><a rel="nofollow" href="{WEB_PATH}/uname/{wc:fun:idjia($sid_code['q_uid'])}" target="_blank"><img width="80" height="80" alt="" src="{G_UPLOAD_PATH}/{wc:fun:get_user_key($sid_code['q_uid'],'img')}"></a></dt>
						<dd class="gray02">
							<p>恭喜 <a href="{WEB_PATH}/uname/{wc:fun:idjia($sid_code['q_uid'])}" target="_blank" class="blue">{wc:fun:get_user_name($sid_code['q_uid'])}</a>获得了本商品</p>
							{wc:if $sid_go_record['ip']}
							{wc:fun:get_ip($sid_go_record['id'],'ipcity')}
							{wc:if:end}
							<p>揭晓时间：{wc:fun:microt($sid_code['q_end_time'])}</p>
							<p>云购时间：{wc:fun:microt($sid_go_record['time'])}</p>
							<p>幸运云购码：<em class="orange Fb">{wc:$sid_code['q_user_code']}</em></p>
						</dd>
					</dl>				
				</div>
			</div>
			{wc:if:end}
			{wc:if:end}
		</div>
		<div class="Pro_Detright">
			<p class="Det_money">价值：<span class="rmbgray"><?php echo ($data["money"]); ?></span></p>
			<!--显示揭晓动画 start-->
			{wc:if ($q_showtime=='Y')}
				{wc:templates "index","item_animation"}
			{wc:else}
				{wc:templates "index","item_contents"}
			{wc:if:end}	
			<!--显示揭晓动画 end-->		
			<div class="Security">
				<ul>
					<li><a href="{WEB_PATH}/help/4" target="_blank"><i></i>100%公平公正</a></li>
					<li><a href="{WEB_PATH}/help/5" target="_blank"><s></s>100%正品保证</a></li>
					<li><a href="{WEB_PATH}/help/7" target="_blank"><b></b>全国免费配送</a></li>
				</ul>
			</div>			
			<div class="Pro_Record">
				<ul id="ulRecordTab" class="Record_tit">
					<li class="NewestRec Record_titCur">最新云购记录</li>
					<li class="MytRec">我的云购记录</li>
					<li class="Explain orange">什么是1元云购？</li>
				</ul>
				<div class="Newest_Con hide">
					<ul>
						{wc:loop $us $user}
						<li>
						<a href="{WEB_PATH}/uname/{wc:fun:idjia($user['uid'])}" target="_blank">
						{wc:if !empty($user['uphoto'])}
							<img src="{G_UPLOAD_PATH}/{wc:$user['uphoto']}" border="0" alt="" width="20" height="20">
						{wc:else}
							<img src="{G_UPLOAD_PATH}/photo/member.jpg" border="0" alt="" width="20" height="20">
						{wc:if:end}
						</a>					
						<a href="{WEB_PATH}/uname/{wc:fun:idjia($user['uid'])}" target="_blank" class="blue">{wc:$user['username']}</a>
						{wc:if $user['ip']}
						({wc:fun:get_ip($user['id'],'ipcity')}) 
						{wc:if:end}				
						{wc:fun:_put_time($user['time'])} 云购了
						<em class="Fb gray01">{wc:$user['gonumber']}</em>人次</li>
						{wc:loop:end}
					</ul>
					<p style=""><a id="btnUserBuyMore" href="javascript:;" class="gray01">查看更多</a></p>					
				</div>
				
				<!--我的云购记录-->
				<div class="My_Record hide" style="display:none;">
					{wc:if get_user_uid()}				
					<ul>				
						{wc:m=member.member mod=get_record(get_user_uid(),$item['id'],9)}
						{wc:loop $datas $row}									
						<li>{wc:fun:_put_time($user['time'])}  云购了  {wc:$user['gonumber']}  个云购码</li>						
						{wc:loop:end} 
					</ul>
					{wc:else}					
					<div class="My_RecordReg">
						<b class="gray01">看不到？是不是没登录或是没注册？ 登录后看看</b>
						<a href="{WEB_PATH}/member/user/login" class="My_Signbut">登录</a><a href="{WEB_PATH}/member/user/register" class="My_Regbut">注册</a>
					</div>
					{wc:if:end}
				</div>
				<!--/我的云购记录-->
				<div class="Newest_Con hide" style="display:none;">
					<p class="MsgIntro">{wc:fun:_cfg("web_name_two")}购是指只需1元就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份1元，当一件商品所有“等份”售出后，根据云购规则产生一名幸运者，该幸运者即可获得此商品。</p>
					<p class="MsgIntro1">{wc:fun:_cfg("web_name_two")}以“快乐云购，惊喜无限”为宗旨，力求打造一个100%公平公正、100%正品保障、寄娱乐与购物一体化的新型购物网站。<a href="{WEB_PATH}/help/1" class="blue" target="_blank">查看详情&gt;&gt;</a></p>
				</div>
			</div>			
		</div>
	</div>
</div>
<!-- 商品信息导航 -->
<div class="ProductTabNav">
	<div id="divProductNav" class="DetailsT_Tit">
		<div class="DetailsT_TitP">
			<ul>
				<li class="Product_DetT DetailsTCur"><span class="DetailsTCur">商品详情</span></li>
				<li id="liUserBuyAll" class="All_RecordT"><span class="">所有参与记录</span></li>
				<li class="Single_ConT"><span class="">晒单</span></li>
			</ul>
			<!-- <p><a id="btnAdd2Cart" href="javascript:;" class="white DetailsT_Cart"><s></s>加入购物车</a></p> -->
		</div>
	</div>
</div>

<!--补丁3.1.6_b.0.1-->
<div id="divContent" class="Product_Content">
	<!-- 商品内容 -->
	<div class="Product_Con">{wc:$item['content']}</div>
    <!-- 商品内容 -->
    
    <!-- 购买记录20条 -->
	<div id="bitem" class="AllRecordCon">
		<iframe id="iframea_bitem" g_src="{WEB_PATH}/go/goods/go_record_ifram/{wc:$itemid}/20" style="width:978px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>		
	</div>	
   <!-- /购买记录20条 -->
    
	<!-- 晒单 -->
	<div id="divPost" class="Single_Content">
		<iframe id="iframea_divPost" g_src="{WEB_PATH}/go/shaidan/itmeifram/{wc:$itemid}" style="width:978px; border:none;height:100%" frameborder="0" scrolling="no"></iframe>
	</div>
    <!-- 晒单 -->	
</div>
<!--补丁3.1.6_b.0.1-->


<script type="text/javascript">
<!--补丁3.1.6_b.0.2-->
function set_iframe_height(fid,did,height){	
	$("#"+fid).css("height",height);	
}

$(function(){
	$("#ulRecordTab li").click(function(){
		var add=$("#ulRecordTab li").index(this);
		$("#ulRecordTab li").removeClass("Record_titCur").eq(add).addClass("Record_titCur");
		$(".Pro_Record .hide").hide().eq(add).show();
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
	<!--补丁3.1.6_b.0.2-->
	
	
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
})
var shopinfo={'shopid':{wc:$item['id']},'money':{wc:$item['yunjiage']},'shenyu':{wc:$syrs}};

	
$(function(){
	function baifenshua(aa,n){
	n = n || 2;
	return ( Math.round( aa * Math.pow( 10, n + 2 ) ) / Math.pow( 10, n ) ).toFixed( n ) + '%';
}
	var shopnum = $("#num_dig");
		var ten_per = Math.floor(parseInt({wc:$item['zongrenshu']})) || 1;
	var max_num = (ten_per > parseInt(shopinfo['shenyu'])) ? parseInt(shopinfo['shenyu']) : ten_per;
	shopnum.keyup(function(){
		if(shopnum.val()>=max_num){
			shopnum.val(max_num);
		}
		var numshop=shopnum.val();
		if(numshop=={wc:$item['zongrenshu']}){
			var baifenbi='100%';
		}else{
			var showbaifen=numshop/{wc:$item['zongrenshu']};
			var baifenbi=baifenshua(showbaifen,2);
		}
		$("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");
	});
	
	$("#shopadd").click(function(){
		var shopnum = $("#num_dig");
			var resshopnump='';
			var ten_per = Math.floor(parseInt({wc:$item['zongrenshu']})) || 1;
			var max_num = (ten_per > parseInt(shopinfo['shenyu'])) ? parseInt(shopinfo['shenyu']) : ten_per;
			var num = parseInt(shopnum.val());
			if(num >= max_num){
				shopnum.val(max_num);
				resshopnump = max_num;
			}else{
				resshopnump=parseInt(shopnum.val())+1;
				shopnum.val(resshopnump);
			}
			if(resshopnump=={wc:$item['zongrenshu']}){
				var baifenbi='100%';
			}else{
				var showbaifen=resshopnump/{wc:$item['zongrenshu']};
				var baifenbi=baifenshua(showbaifen,2);
			}
			$("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");
	});
	
	
	$("#shopsub").click(function(){
		var shopnum = $("#num_dig");
		var num = parseInt(shopnum.val());
		if(num<2){
			shopnum.val(1);			
		}else{
			shopnum.val(parseInt(shopnum.val())-1);
		}
		var shopnums=parseInt(shopnum.val());
		if(shopnums=={wc:$item['zongrenshu']}){
				var baifenbi='100%';
			}else{
				var showbaifen=shopnums/{wc:$item['zongrenshu']};
				var baifenbi=baifenshua(showbaifen,2);
			}
			$("#chance").html("<span style='color:red'>获得机率"+baifenbi+"</span>");
	});
});

$(function(){
$(".Det_Cart").click(function(){ 
	//添加到购物车动画
	var src=$("#zoom1 img").attr('src');  
	var $shadow = $('<img id="cart_dh" style="display: none; border:1px solid #aaa; z-index: 99999;" width="400" height="400" src="'+src+'" />').prependTo("body"); 
	var $img = $(".mousetrap").first("img");
	$shadow.css({ 
	   'width' : $img.css('width'), 
	   'height': $img.css('height'),
	   'position' : 'absolute',      
	   'top' : $img.offset().top,
	   'left' : $img.offset().left, 
	   'opacity' :1    
	}).show();
	var $cart =$("#btnMyCart");
	var numdig=$(".num_dig").val();
	$shadow.animate({   
		width: 1, 
		height: 1, 
		top: $cart.offset().top, 
		left: $cart.offset().left,
		opacity: 0
	},500,function(){
		Cartcookie(false);
	});		
});
	$(".Det_Shopbut").click(function(){	
		Cartcookie(true);
	});	
});



function Cartcookie(cook){
	var shopid=shopinfo['shopid'];
	var number=parseInt($("#num_dig").val());
	if(number<=1){number=1;}
	var Cartlist = $.cookie('Cartlist');
	if(!Cartlist){
		var info = {};
	}else{
		var info = $.evalJSON(Cartlist);
		if((typeof info) !== 'object'){
			var info = {};
		}
	}		
	if(!info[shopid]){
		var CartTotal=$("#sCartTotal").text();
			$("#sCartTotal").text(parseInt(CartTotal)+1);
			$("#btnMyCart em").text(parseInt(CartTotal)+1);
	}	
	info[shopid]={};
	info[shopid]['num']=number;
	info[shopid]['shenyu']=shopinfo['shenyu'];
	info[shopid]['money']=shopinfo['money'];
	info['MoenyCount']='0.00';	
	$.cookie('Cartlist',$.toJSON(info),{expires:7,path:'/'});
	if(cook){
		window.location.href="{WEB_PATH}/member/cart/cartlist/"+new Date().getTime();//+new Date().getTime()
	}
}  
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
			<a id="btnMyCart" href="{WEB_PATH}/member/cart/cartlist" target="_blank" class="quick_cartA"><b>购物车</b><s></s><em><span class="cart-count"><?php echo session('cartCount');?></span></em></a>
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
	});
</script>
<!--end右侧导航-->
</body>

</html>