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
	<!--期数修改弹出框-->
<style>
#paywindow{position:absolute;z-index:999; display:none}
#paywindow_b{width:542px;height:360px;background:#2a8aba; filter:alpha(opacity=60);opacity: 0.6;position:absolute;left:0px;top:0px; display:block}
#paywindow_c{width:530px;height:348px;background:#fff;display:block;position:absolute;left:6px;top:6px;}
.p_win_title{ line-height:40px;height:40px;background:#f8f8f8;}
.p_win_title b{float:left}
.p_win_title a{float:right;padding:0px 10px;color:#f60}
.p_win_content h1{font-size:25px;font-weight:bold;}
.p_win_but,.p_win_mes,.p_win_ctitle,.p_win_text{ margin:10px 20px;}
.p_win_mes{border-bottom:1px solid #eee;line-height:35px;}
.p_win_mes span{margin-left:10px;}
.p_win_ctitle{overflow:hidden;}
.p_win_x_b{float:left; width:73px;height:68px;background-repeat:no-repeat;}
.p_win_x_t{ font-size:18px; font-weight:bold;font-family: "Helvetica Neue",\5FAE\8F6F\96C5\9ED1,Tohoma;color:#f00; text-align:center}
.p_win_but{ height:40px; line-height:40px;}
.p_win_but a{ padding:8px 15px; background:#f60; color:#fff;border:1px solid #f50; margin:0px 15px;font-family: "Helvetica Neue",\5FAE\8F6F\96C5\9ED1,Tohoma; font-size:15px; }
.p_win_but a:hover{ background:#f50}
.p_win_text a{ font-size:13px; color:#f60}
.pay_window_quit:hover{ color:#f00}
</style>
<style>
		#wuliu_select{ padding:5px 8px; width:80px; background-color:#F60;border-radius:2px;font-family: 微软雅黑; color:#fff; font-size:12px; margin-left:30px; }		
		.wuliubtn{ padding:3px 5px;background-color:#2af;border-radius:2px; color:#fff; font-size:12px; }
		.wuliubtn:hover{ color:#fff; cursor:pointer}
		.single-img .pic{ text-indent:0px;}
		#divPageNav{ padding-top:10px;text-align:right}		
		.listTitle .sdzt b{color: #fe6c00; font-weight:bold}
		.message{ background:#fffce2; border:1px solid #fd9; color:#f60; padding:5px 8px; text-indent:10px;}
		.single-xx-has span{ display:inline-block;  width:180px}
</style>

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

<link rel="stylesheet" type="text/css" href="/Public/P/css/layout-commodity.css"/>
<div class="R-content">
	<div class="member-t"><h2>获得的商品</h2></div>
	<div class="get-pro gray02">您总共成功云购获得商品 <b id="goodsCount" class="orange"></b> 个
    	  <a href="#" id="wuliu_select">查询物流</a>
    </div>	
    
    <div class="message">你还没有填写收货信息,请填写收货信息！ <a href="<?php echo U('Home/address', '', '');?>" style="font-weight:bold; color:#2af">去填写!</a></div>
        
    
    <div style="clear:both; width:100%; height:20px; display:block;"></div>
	<div id="tbList" class="single-C list-tab">
		<ul class="listTitle">
			<li class="single-img">商品图片</li>
			<li class="single-xx-has">商品信息</li>
			<!--<li class="sdzt">状态</li>-->
			<li class="single-Control">价值</li>
		</ul>
	</div>
		<div id="divPageNav" class="page_nav">
        	<!--{wc:page:two} <li>共 {wc:$total} 条</li>-->
        </div>
</div>
</div>

<ul class="listTitle mui-hidden" style="background:#fff; height:80px; padding:10px 0 0 0;" id="goodTemplate">
	<li class="single-img"><a target="_blank" class="pic" href="{WEB_PATH}/dataserver/{wc:$recd['shopid']}"><img src="{G_UPLOAD_PATH}/{wc:fun:yunjl($recd['shopid'])}"></a></li>
	<li class="single-xx-has"><a target="_blank" href="{WEB_PATH}/dataserver/{wc:$recd['shopid']}" class="blue zcontent"></a>
    <br/>物流公司::: <i class="company"></i>快递单号:::<i class="company_code"></i>
    </li>
	<li class="sdzt"><b></b></li>
    <li class="single-Control">￥<span class="money"></span></li>
</ul>

<div id="paywindow">
	<div id="paywindow_b"></div>
	<div id="paywindow_c">
		<div class="p_win_title"><a href="javascript:void();" class="pay_window_quit">[关闭]</a><b>　 物流查询</b></div>
		<div class="p_win_content">			
            	<iframe name="kuaidi100" src="http://www.kuaidi100.com/frame/app/index2.html" width="527" height="300" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>        
		</div>
	</div>
</div>

<script>
$(function(){
	var width = ($(window).width()-542)/2;
	var height = ($(window).height()-360)/2;
	$("#paywindow").css("left",width);
	$("#paywindow").css("top",height);
		
	$(".pay_window_quit").click(function(){
		$("#paywindow").hide();								 
	});	
	$("#wuliu_select").click(function(){
		$("#paywindow").show();								 
	});	
	
	$(".wuliubtn").click(function(){
		var uid = $(this).attr("uid");	
		var oid = $(this).attr("oid");	
		$.post("{WEB_PATH}/api/dingdan/set",{"uid":uid,"oid":oid},function(sdata){
			if(sdata=='1'){
				alert("更新成功");
			}
			else{
				alert("更新失败");
			}											   
		});					  
	});
});

</script>
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
		var goodList = $("#tbList");
		var goodTemplate = $("#goodTemplate");
		 
		var useTemplate;
		var orderType = 1;
		function pageAll(clear) {
			if(clear) {
				pageNum = 0;
			}
			$.get("<?php echo U('pageAllzj', '', '');?>/10/" + (++pageNum), {
				type: orderType
				 
			}, function(list) {
				if(clear) {
					goodList.html("");
				}
				
				if(pageNum ==1 && list && list.length==0)
				{
					$("#goodsCount").text("0");
					goodList.append('<div class="tips-con"><i></i>无相应的获得商品记录</div>');
					return;
				}
				$("#goodsCount").text(list.length);
				
				$('.orange').text((pageNum-1)*10 + list.length);
	       		$.each(list, function() {
	       			useTemplate=goodTemplate;
	       			
	       			var item = useTemplate.clone().removeClass("mui-hidden").removeAttr("id");
	       			$(".goodurl", item).attr("href", "<?php echo U('/Home/Index', '', '');?>/" + this.gid);

					$("img", item).attr("src", this.thumb);
	       			$(".zcontent", item).text("(第" + this.qishu + "期) " + this.title);
	       			$(".money", item).text(this.zongrenshu);

					if(this.company){
	       				$(".company", item).text(this.company);
	       				$(".company_code", item).text(this.company_code);
	       			}
	       			$(".ztime", item).text(this.time);
	       			goodList.append(item);
	       		});
	       });
		}
		pageAll(); 
		
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
	<div class="copyright"><?php echo config("web_copyright");?> </div>
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