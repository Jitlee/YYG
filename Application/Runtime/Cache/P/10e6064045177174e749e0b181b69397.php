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
             <li id="liMobile" class="u-arr">
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
             </li>
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
                         <li class="num"><cite><em>0</em></cite><i></i></li>
                         <li class="num"><cite><em>0</em></cite><i></i></li>
                         <li class="num"><cite><em>0</em></cite><i></i></li>
                         <li class="nobor">,</li>
                         <li class="num"><cite><em>{wc:fun:go_count_renci6()}</em></cite><i></i></li>
                         <li class="num"><cite><em>{wc:fun:go_count_renci5()}</em></cite><i></i></li>
                         <li class="num"><cite><em>{wc:fun:go_count_renci4()}</em></cite><i></i></li>
                         <li class="nobor">,</li>
                         <li class="num"><cite><em>{wc:fun:go_count_renci3()}</em></cite><i></i></li>
                         <li class="num"><cite><em>{wc:fun:go_count_renci2()}</em></cite><i></i></li>
                         <li class="num"><cite><em>{wc:fun:go_count_renci1()}</em></cite><i></i></li> 
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
             <div id="divSortList" class="m-all-sort" style="display: none;">
                 <dl>
                     <dt><a href="{WEB_PATH}/goods_list/5_0_0">手机数码</a></dt>
                     <dd>
                         <a href="{WEB_PATH}/goods_list/49_0_0">手机</a>
                         <a href="{WEB_PATH}/goods_list/62_0_0">数码影像</a>
                         <a href="{WEB_PATH}/goods_list/63_0_0">时尚影音</a>
                     </dd>
                 </dl>
                 <dl>
                     <dt><a href="{WEB_PATH}/goods_list/13_0_0">电脑办公</a></dt>
                     <dd>
                         <a href="{WEB_PATH}/goods_list/64_0_0">电脑配件</a>
                         <a href="{WEB_PATH}/goods_list/65_0_0">外设产品</a>
                         <a href="{WEB_PATH}/goods_list/69_0_0">网络产品</a>
                     </dd>
                 </dl>
                 <dl>
                     <dt><a href="{WEB_PATH}/goods_list/6_0_0">家用电器</a></dt>
                     <dd>
                         <a href="{WEB_PATH}/goods_list/66_0_0">大家电</a>
                         <a href="{WEB_PATH}/goods_list/67_0_0">生活电器</a>
                         <a href="{WEB_PATH}/goods_list/70_0_0">个人护理</a>
                     </dd>
                 </dl>
                 <dl>
                     <dt><a href="{WEB_PATH}/goods_list/12_0_0">化妆个护</a></dt>
                     <dd>
                        <a href="{WEB_PATH}/">面部护理</a>
                         <a href="{WEB_PATH}/">香水</a>
                     </dd>
                 </dl>
                 <dl>
                     <dt><a href="{WEB_PATH}/goods_list/14_0_0">钟表首饰</a></dt>
                     <dd><a href="{WEB_PATH}/goods_list/68_0_0">珠宝首饰</a></dd>
                 </dl>
                 <dl>
                     <dt><a href="{WEB_PATH}/goods_list/15_0_0">其他商品</a></dt>
                     <dd>
                        <a href="{WEB_PATH}/goods_list/21_0_0">腾讯QQ</a>
                         <a href="{WEB_PATH}/goods_list/55_0_0">手机话费</a>
                     </dd>
                 </dl>
             </div>
 
         </div>
         <div class="nav-main fl">
             <ul>
                 <li class="f-nav-home"><a href="/">首页</a></li>
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
 <!--所有商品下拉特效-->
	<script>
		$(document).ready(function(){
				$("#divGoodsSortList").hover(function() {
				$(this).addClass("U-goods-hover").children("div.U-goods-class").show().prev().find("b").addClass("b_Triangle")
				}
				,function() {
					$(this).removeClass("U-goods-hover").children("div.U-goods-class").hide().prev().find("b").removeClass("b_Triangle")
				}
				).find("dl").each(function() {
					$(this).hover(function() {
					$(this).addClass("U-list-hover")
				}
				,function() {
					$(this).removeClass("U-list-hover")
				}
				)});

		});
	</script>
	<script>
$(function(){
	$("#sCart,#liTopCart").hover(
		function(){			
			$("#sCartlist,#sCartLoading").show();
			$("#sCartlist p,#sCartlist h3").hide();
			$("#sCart .mycartcur").remove();
			$("#sCartTotal2").html("");
			$("#sCartTotalM").html("");
			$.getJSON("{WEB_PATH}/member/cart/cartheader/="+ new Date().getTime(),function(data){
				$("#sCart .mycartcur").remove();
				$("#sCartLoading").before(data.li);
				$("#sCartTotal2").html(data.num);
				$("#sCartTotalM").html(data.sum);

				$("#sCartLoading").hide();
				$("#sCartlist p,#sCartlist h3").show();
			});
		},
		function(){
			$("#sCartlist").hide();
		}
	);
	$("#sGotoCart").click(function(){
		window.location.href="{WEB_PATH}/member/cart/cartlist";
	});
})
function delheader(id){
	var Cartlist = $.cookie('Cartlist');
	var info = $.evalJSON(Cartlist);
	var num=$("#sCartTotal2").html()-1;
	var sum=$("#sCartTotalM").html();
	info['MoenyCount'] = sum-info[id]['money']*info[id]['num'];
		
	delete info[id];
	//$.cookie('Cartlist','',{path:'/'});
	$.cookie('Cartlist',$.toJSON(info),{expires:30,path:'/'});
	$("#sCartTotalM").html(info['MoenyCount']);
	$('#sCartTotal2').html(num);
	$('#sCartTotal').text(num);											
	$('#btnMyCart em').text(num);
	$("#mycartcur"+id).remove();
}
$(function(){
	$(".M-my-1yyg").mouseover(function(){
		$(this).addClass("menu-hd-hover");
	});
	$(".M-shop").mouseover(function(){
		$(this).addClass("menu-hd-hover");
	});
	$(".M-my-1yyg").mouseout(function(){
		$(this).removeClass("menu-hd-hover");
	});
	$(".M-shop").mouseout(function(){
		$(this).removeClass("menu-hd-hover");
	});
});
$(function(){
	$("#txtSearch").focus(function(){
		$("#txtSearch").css({background:"#FFFFCC"});
		var va1=$("#txtSearch").val();
		if(va1=='输入“手机”试试'){
			$("#txtSearch").val("");
		}
	});
	$("#txtSearch").blur(function(){
		$("#txtSearch").css({background:"#FFF"});
		var va2=$("#txtSearch").val();
		if(va2==""){
			$("#txtSearch").val('输入“手机”试试');
		}			
	});
	$("#butSearch").click(function(){
		window.location.href="{WEB_PATH}/s_tag/"+$("#txtSearch").val();
	});
});

var getAllNum = function(){
	var a = $("#spBuyCount");
	var b = a.text();
	$.ajax({
		url: "{WEB_PATH}/api/wrenciajax/get",
		type:"POST",
		success: function(data){
			if(b == data){				
			}else{
				a.css({
					color:"white",background:"red"
				}).html(data);
				a.animate({
					opacity:0.1
				}
				,{
					queue:false,duration:1000,complete:function(){
						a.show().css({
							color:"#22AAFF",background:"#F5F5F5",opacity:1
						})
					}
				})

			}
		}
	});
	//setTimeout(getAllNum,3000);
};
getAllNum();
</script>
 <script language="javascript" type="text/javascript">
     var Base = { 
     	head: document.getElementsByTagName("head")[0] || document.documentElement
     	, Myload: function (B, A) { 
     		this.done = false; 
     		B.onload = B.onreadystatechange = function () { 
     			if (!this.done && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) { 
     				this.done = true; 
     				A(); 
     				B.onload = B.onreadystatechange = null; 
     				if (this.head && B.parentNode) { this.head.removeChild(B) } } } 
     	}
     	, getScript: function (A, C) { 
     		var B = function () { }; 
     		if (C != undefined) { B = C } 
     		var D = document.createElement("script"); 
     		D.setAttribute("language", "javascript"); 
     		D.setAttribute("type", "text/javascript"); 
     		D.setAttribute("src", A); this.head.appendChild(D); this.Myload(D, B) 
     	}, getStyle: function (A, CB) { 
     		var B = function () { }; if (CB != undefined) { B = CB } 
     		var C = document.createElement("link"); 
     		C.setAttribute("type", "text/css"); C.setAttribute("rel", "stylesheet"); C.setAttribute("href", A); this.head.appendChild(C); this.Myload(C, B) } 
     }
     function GetVerNum() { var D = new Date(); return D.getFullYear().toString().substring(2, 4) + '.' + (D.getMonth() + 1) + '.' + D.getDate() + '.' + D.getHours() + '.' + (D.getMinutes() < 10 ? '0' : D.getMinutes().toString().substring(0, 1)) }
     Base.getScript('{G_TEMPLATES_JS}/Bottom.js?v=' + GetVerNum());
 </script>
 <script>
$("body").attr('class','lottery');
</script>
<!--end所有商品下拉特效-->
<link rel="stylesheet" type="text/css" href="/Public/P/css/Home.css?date=20140731">	

<div class="main-content clearfix">
<link rel="stylesheet" type="text/css" href="/Public/P/css/layout-Frame.css"/>
<div class="left">
	<div class="head">
		<a href="#" target="_blank">			
			<img id="imgUserPhoto" src="<?php echo get_user_img();?>" width="160" height="160" border="0"/>			
		</a>
	</div>
	<div class="head-but">
		<a href="<?php echo U('Home/userphoto', '', '');?>" class="blue">修改头像</a>
		<a href="<?php echo U('Home/modify', '', '');?>" class="blue fr">编辑资料</a>
	</div>
	<div class="sidebar-nav">
		<p class="sid-line"></p>
		<h2 id="wdwzg" class="sid-icon01"><a href="<?php echo U('Home/index', '', '');?>"><b></b>我的</a></h2>
		<p class="sid-line"></p>
		<h3 id="grsz" class="sid-icon09" ><a href="<?php echo U('Home/modify', '', '');?>"><b></b>个人设置</a></h3>		
		<p class="sid-line"></p>
		<h3 class="sid-icon02">
			<a href="javascript:void();"><b></b>我的云购 <s title="收起"></s></a>
		</h3>
		<ul>
			<li id="zgjl" class=""><a href="<?php echo U('Home/userbuylist', '', '');?>">云购记录</a></li>
			<li id="hddsp" class=""><a href="<?php echo U('Home/orderlist', '', '');?>">获得的商品</a></li>
			<li id="sd" class=""><a href="<?php echo U('Home/singlelist', '', '');?>">晒单</a></li>
		</ul>
		
		
		<p class="sid-line"></p>
		<h3 class="sid-icon04 " >
			<a href="javascript:void();"><b></b>邀请管理 <s title="收起"></s></a>
		</h3>
		<ul>
			<li id="yqhy" class=""><a href="<?php echo U('Home/invitefriends', '', '');?>">邀请好友</a></li>
			<!--<li id="yjmx" class=""><a href="<?php echo U('Home/commissions', '', '');?>">佣金明细</a></li>-->
			
		</ul>
		<p class="sid-line"></p>		
		<h3 class="sid-icon05 " >
			<a href="javascript:void();"><b></b>账户管理 <s title="收起"></s></a>
		</h3>
		<ul>
			<li id="zhmx" class=""><a href="<?php echo U('Home/userbalance', '', '');?>">账户明细</a></li>
			<li id="zhcz" class=""><a href="<?php echo U('Home/userrecharge', '', '');?>">账户充值</a></li>
			<li id="sqtx" class=""><a href="<?php echo U('Home/cashout', '', '');?>">申请提现</a></li>
			<li id="txjl" class=""><a href="<?php echo U('Home/record', '', '');?>">提现记录</a></li>
		</ul>
		<p class="sid-line"></p>
		<h3 id="wdff" class="sid-icon07" hasChild="0" url=""><a href="<?php echo U('Home/userscore', '', '');?>"><b></b>我的积分</a></h3>

	</div>
	<div class="sid-service">
		<p>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo config('qq');?>&site=qq&menu=yes" target="_blank" class="service-btn">
				<s></s><img border="0" src="images/pa" style="display:none;">在线客服
			</a>
		</p>
		<span>客服热线</span>
		<b class="tel"><?php echo config('cell');?></b>
	</div>
</div>
<script type="text/javascript">
var _NavState = [true, true, true, true, true];  
$("div.sidebar-nav").find("h3").each(function(i,v){
	var _This = $(this);
	var _HasClild = _This.attr("hasChild")=="1"; 
	var _SObj = _This.find("s");
	_This.click(function(e){
		if(_HasClild){
			var _State = _NavState[i];                
			/* 一级栏目更改样式 */
			if(_State){
				_This.addClass("sid-iconcur");
				_SObj.attr("title","展开");
			}
			else {
				_This.removeClass("sid-iconcur");
				_SObj.attr("title","收起");
			}                
			/* 二级栏目显示或隐藏 */
			_This.next("ul").children().each(function(){
				if(_State){
					$(this).hide(50);
				}
				else {
					$(this).show(50);
				}
			});
			_NavState[i] = !_State;
		}
	});
});   
</script>

<!--content left end-->
	<link rel="stylesheet" type="text/css" href="/Public/P/css/layout-records.css"/>
	<div class="R-content">
		<div class="member-t"><h2>云购记录</h2></div>
		<div id="GoodsList" class="goods_show">
			<ul class="gtitle">
				<li>商品图片</li>
				<li class="gname">商品名称</li>
				<li class="yg_status">云购状态</li>
				<li class="joinInfo">参与人次</li>
				<li class="do">操作</li>
			</ul>	
			 
	        
	        <style>
				#divPageNav{ padding-top:10px;text-align:right}
				#divPageNav li a{ padding:5px;}
				.mui-hidden{display: none;}
			</style>
			<!--<div id="divPageNav" class="page_nav">
	        	{wc:page:one} <li>共 {wc:$total} 条</li>
	        </div>-->
		</div>
	</div>
</div>
		 <ul class="goods_list mui-hidden" id="goodTemplate">	
				<li><a title="" target="_blank" class="pic" href=""><img src=""></a></li>
				<li class="gname"style="margin:10px 0 0 0;">
					<a target="_blank" href="" class="blue">
						<span class="zcontent"></span>
					</a>
					<p class="gray02">获得者：<a href="{WEB_PATH}/uname/{wc:fun:idjia($jiexiao['q_uid'])}" target="_blank" class="blue">
	                {wc:fun:get_user_name($jiexiao['q_user'])}
	                </a></p>
					<p class="gray02">揭晓时间：<span class="ztime"></span></p>
				</li>
				<li class="yg_status" style="margin:23px 0 0 0;"><span class="orange">已揭晓</span></li>
				<li class="joinInfo" style="margin:23px 0 0 0;"><p><em>{wc:$rt['gonumber']}</em>人次</p></li>
				<li class="do" style="margin:23px 0 0 0;"><a href="{WEB_PATH}/member/home/userbuydetail/{wc:$rt['id']}" class="blue" title="详情">详情</a></li>
			</ul>
			
			<ul class="goods_list mui-hidden" id="goodTemplateing">	
				<li><a title="" target="_blank" class="pic goodurl" href="{WEB_PATH}/goods/{wc:$rt['shopid']}"><img src=""></a></li>
				<li class="gname" style="margin:15px 0 0 0;">
					<a target="_blank" href="" class="blue goodurl">
						<span class="zcontent"></span>
					</a>				
					<p class="gray02 ">购买时间：<span class="ztime"></span></p>
				</li>
				<li class="yg_status" style="margin:23px 0 0 0;"><span class="orange">正在进行...</span></li>
				<li class="joinInfo" style="margin:23px 0 0 0;"><p><r> </r>人次</p></li>
				<li class="do" style="margin:23px 0 0 0;"><a href="{WEB_PATH}/member/home/userbuydetail/{wc:$rt['id']}" class="blue" title="查看云购码">查看云购码</a></li>
			</ul>
			
<script type="text/javascript">
	$(function(){
		
		$(document).bind("scroll", onscrollend);
		
		function onscrollend() {
			if ($(window).scrollTop() + $(window).height() == $(document).height()) {
       			console.info("滚动到底了");
				pageAll();
			}
		}		
		// 全部商品翻页
		var pageNum = 0;
		var goodList = $("#GoodsList");
		var goodTemplate = $("#goodTemplate");
		var goodTemplateing=$("#goodTemplateing");
		var useTemplate;
		var orderType = 1;
		function pageAll(clear) {
			if(clear) {
				pageNum = 0;
			}
			$.get("<?php echo U('pageAllMR', '', '');?>/8/" + (++pageNum), {
				type: orderType
				 
			}, function(list) {
				if(clear) {
					goodList.html("");
				}
	       		$.each(list, function() {
	       			useTemplate=goodTemplateing;
	       			if(this.jishijiexiao==1)
	       			{
	       				useTemplate=goodTemplate;
	       			}	       			
	       			var item = useTemplate.clone().removeClass("mui-hidden").removeAttr("id");
	       			$(".goodurl", item).attr("href", "<?php echo U('/Home/Index', '', '');?>/" + this.gid);

					$("img", item).attr("src", this.thumb);
	       			$(".zcontent", item).text("(第" + this.qishu + "期) " + this.title);
//	       			$(".money", item).text(this.zongrenshu);
	       			$("r", item).text(this.canyurenshu);
	       			
	       			$(".pl", item).text(this.canyurenshu);
					$(".pc", item).text(this.zongrenshu);
					$(".pr", item).text(this.shengyurenshu);
	       			
	       			$(".ztime", item).text(this.time);
	       			goodList.append(item);
	       		});
	       });
		}
		pageAll(); 		
	});
</script>

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
<!--end右侧导航-->

</body>

</html>