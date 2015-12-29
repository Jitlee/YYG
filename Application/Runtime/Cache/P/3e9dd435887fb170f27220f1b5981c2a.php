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
                 <li class="f-nav-share"><a href="<?php echo U('Saidan/index', '', '');?>">晒单分享</a></li>
                 <li class="f-nav-group"><a href="<?php echo U('Paimai/index', '', '');?>">拍卖专区</a></li>
                 <li class="f-nav-guide"><a href="<?php echo U('Help/index', '', '');?>">新手指南</a></li>
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
		<div class="period_Open">
			<a class="gray02" click="off" id="btnOpenPeriod" href="javascript:void(0);">展开<i></i></a>
			
		</div>
		<ul class="Period_list">
			<li><a <?php if($data["current"] != $qishu): ?>href="<?php echo U('Index/view', '', '');?>/<?php echo ($data["gid"]); ?>"<?php endif; ?>><b class="period_Ongoing period_ArrowCur" style="padding-left:0px;">第<?php echo ($data["current"]); ?>期<i></i></b></a></li>
			<?php $__FOR_START_692236263__=$data['current'] - 1;$__FOR_END_692236263__=0;for($i=$__FOR_START_692236263__;$i > $__FOR_END_692236263__;$i+=-1){ ?><li><a <?php if($i != $qishu): ?>href="<?php echo U('Index/view', '', '');?>/<?php echo ($data["gid"]); ?>/<?php echo ($i); ?>"<?php endif; ?> class="gray02">第<?php echo ($i); ?>期</a></li><?php } ?>
		</ul>
	</div>
	<script>
		$("#btnOpenPeriod").click(function(){
			var ui_obj = $("#divPeriodList li");
			if($(this).attr("click")=='off'){
				$("#divPeriodList").css("max-height",(Math.ceil(ui_obj.length / 9) * 33)+"px");	
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
		<h1><span>(第<?php echo ($data["qishu"]); ?>期)</span><span ><?php echo ($data["title"]); ?></span><em><?php echo ($data["subtitle"]); ?></em></h1>
		<div class="Pro_Detleft">
			<div class="zoom-small-image">
				<a class="cloud-zoom" id="zoom1" href="<?php echo ($firstImage["image_url"]); ?>" rel="adjustX: 10, adjustY:-4, softFocus:true">
					<img src="<?php echo ($firstImage["image_url"]); ?>">
				</a>
			</div>

			<div class="zoom-desc"> 
				<div class="jcarousel-prev jcarousel-prev-disabled"></div>
				<div class="jcarousel-clip" style="height:55px;width:384px;">
				<p>
					<?php if(is_array($images)): foreach($images as $key=>$item): ?><label href="<?php echo ($item["image_url"]); ?>" class='cloud-zoom-gallery'  rel="useZoom: 'zoom1', smallImage: '<?php echo ($item["image_url"]); ?>'">
					<img class="zoom-tiny-image" src="<?php echo ($item["image_url"]); ?>" /></label><?php endforeach; endif; ?>
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
			
			<?php if(isset($data["prizer"])): ?><div class="Pro_GetPrize">		
				<?php if($data["current"] == $qishu): ?><h2>本期获得者</h2>
				<?php else: ?>
				<h2>上期获得者</h2><?php endif; ?>
				<div class="GetPrize">				    
					<dl>
						<dt><a rel="nofollow" href="<?php echo U(Person/index);?>/<?php echo ($data["prizer"]["uid"]); ?>" target="_blank"><img width="80" height="80" alt="" src="<?php echo ((isset($data["prizer"]["img"]) && ($data["prizer"]["img"] !== ""))?($data["prizer"]["img"]):'/Public/P/images/member.jpg'); ?>"></a></dt>
						<dd class="gray02">
							<p>恭喜 <a href="<?php echo U(Person/index);?>/<?php echo ($data["prizer"]["uid"]); ?>" target="_blank" class="blue"><?php echo ($data["prizer"]["username"]); ?></a>获得了本商品</p>
							<p>揭晓时间：<?php echo ($data["prizer"]["end_time"]); ?></p>
							<p>云购时间：<?php echo ($data["prizer"]["record_time"]); ?></p>
							<p>幸运云购码：<em class="orange Fb"><?php echo ($data["prizer['prizecode']+10000001"]); ?></em></p>
						</dd>
					</dl>				
				</div>
			</div><?php endif; ?>
		</div>
		<div class="Pro_Detright">
			<p class="Det_money">价值：<span class="rmbgray"><?php echo ($data["money"]); ?></span></p>
			<?php if(isset($end_time)): ?><div id="divLotteryTimer" class="Announced_Frame">
		<div class="Announced_FrameTin">揭晓倒计时</div>
		<div class="Announced_FrameCode">
			<div class="Announced_FrameClock"><img src="/Public/P/images/Announced_Clock.gif" border="0" alt=""></div>
				 <ul class="Announced_FrameClockMar">
					<li id="liMinute1" class="Code_9">9<b></b></li>
					<li id="liMinute2" class="Code_9">9<b></b></li>
					<li class="Code_Point">:<b></b></li>
					<li id="liSecond1" class="Code_9">9<b></b></li>
					<li id="liSecond2" class="Code_9">9<b></b></li>
					<li class="Code_Point">:<b></b></li>
					<li id="liMilliSecond1" class="Code_9">9<b></b></li>
					<li id="last" class="Code_9">9<b></b></li>
				</ul>
		</div>
			<div class="Announced_FrameGet">
				<p class="Announced_FrameLanguage"><img id="imgFunny" src="/Public/P/images/10.gif" border="0" alt=""></p>
			</div>
			<div class="Announced_FrameBm"></div>
</div>
		
<div id="divLotteryTiming" class="Announced_Frame" style="display:none;">
		<div class="Announced_FrameTin">正在计算</div>
		<div class="Announced_FrameCal">
			<p><img src="/Public/P/images/Announced_6.png" border="0" alt=""></p>
			<span><img src="/Public/P/images/Announced_4.gif" border="0" alt=""></span>
		</div>
		<div class="Announced_FrameBm"></div>
</div>
<div id="span_a"></div>
<div id="span_b"></div>
		
		
<script type="text/javascript">	 
	function show_date_time_location(){
		window.setTimeout(function(){
			$("#divLotteryTimer").hide();
			$("#divLotteryTiming").show();	
			//$.post("{WEB_PATH}/api/getshop/lottery_shop_set/",{"lottery_sub":"true","gid":{wc:$item['id']}},null);
			//window.setTimeout(function(){window.location.href="{WEB_PATH}/dataserver/{wc:$item['id']}";},5000);
		},1000);
	}
	function show_date_time(endTime,obj){	
		if(!this.endTime){
			this.endTime=endTime;this.obj=obj;
		}
		rTimeout = window.setTimeout("show_date_time()",30);	
		timeold = this.endTime-(new Date().getTime());
		if(timeold <= 0){		
			$("#liMinute1").attr("class","Code_0");
			$("#liMinute2").attr("class","Code_0");
			$("#liSecond1").attr("class","Code_0");
			$("#liSecond2").attr("class","Code_0");
			$("#liMilliSecond1").attr("class","Code_0");
			$("#last").attr("class","Code_0");	
			rTimeout && clearTimeout(rTimeout);	
			show_date_time_location();	
			return;
		}
		sectimeold=timeold/1000
		secondsold=Math.floor(sectimeold); 
		msPerDay=24*60*60*1000
		e_daysold=timeold/msPerDay 	
		daysold=Math.floor(e_daysold); 				//天	
		e_hrsold=(e_daysold-daysold)*24; 
		hrsold=Math.floor(e_hrsold); 				//时
		e_minsold=(e_hrsold-hrsold)*60;	
		//分
		minsold=Math.floor((e_hrsold-hrsold)*60);
		minsold = (minsold<10?'0'+minsold:minsold)
		minsold = new String(minsold);
		minsold_1 = minsold.substr(0,1);
		minsold_2 = minsold.substr(1,1);	

		//秒
		e_seconds = (e_minsold-minsold)*60;	
		seconds=Math.floor((e_minsold-minsold)*60);
		seconds = (seconds<10?'0'+seconds:seconds)
		seconds = new String(seconds);
		seconds_1 = seconds.substr(0,1);
		seconds_2 = seconds.substr(1,1);	
		//毫秒	
		ms = e_seconds-seconds;
		ms = new String(ms)
		ms_1 = ms.substr(2,1);
		ms_2 = ms.substr(3,1);
		
		$("#liMinute1").attr("class","Code_"+minsold_1);
		$("#liMinute2").attr("class","Code_"+minsold_2);
		$("#liSecond1").attr("class","Code_"+seconds_1);
		$("#liSecond2").attr("class","Code_"+seconds_2);
		$("#liMilliSecond1").attr("class","Code_"+ms_1);
		$("#last").attr("class","Code_"+ms_2);
		//this.obj.innerHTML=daysold+"天"+(hrsold<10?'0'+hrsold:hrsold)+"小时"+(minsold<10?'0'+minsold:minsold)+"分"+(seconds<10?'0'+seconds:seconds)+"秒."+ms;
	}

	$(function(){
//		$.ajaxSetup({async:false});
//		$.post("{WEB_PATH}/api/getshop/lottery_shop_get",{"lottery_shop_get":true,"gid":{wc:$item['id']},"times":Math.random()},function(sdata){	
//			if(sdata!='no'){
//				show_date_time((new Date().getTime())+(parseInt(sdata))*1000,null);
//			}
//		});
		show_date_time(<?php echo (strtotime($data["end_time"])); ?> * 1000, null);
	});
</script>
			<?php else: ?>
				<div class="Progress-bar">
	<p title="已完成<?php echo round($data['canyurenshu']*100 / $data['shengyurenshu'], 2);?>%"><span style="width:<?php echo ($data['canyurenshu']*100 / $data['shengyurenshu']); ?>%;"></span></p>
	<ul class="Pro-bar-li">
		<li class="P-bar01"><em><?php echo ($data["canyurenshu"]); ?></em>已参与人次</li>
		<li class="P-bar02"><em id="CodeQuantity"><?php echo ($data["zongrenshu"]); ?></em>总需人次</li>
		<li class="P-bar03"><em id="CodeLift"><?php echo ($data["shengyurenshu"]); ?></em>剩余人次</li>
	</ul>
</div>

<?php if(empty($data['prizeuid']) AND empty($data['end_time']) AND $data['shengyurenshu'] == 0): ?><div class="Immediate">
      <span style="left:10px;right:0px;">这个商品未揭晓成功,请联系客服手动揭晓！</span>  
    </div><?php endif; ?>

 <!-- 限时揭晓 -->
<?php if(isset($data["end_time"])): ?><div id="divAutoRTime" class="Immediate">
	    <span><a class="orange" target="_blank" href="#">限时揭晓的规则？</a></span>
	     <i id="timeall" endtime="<?php echo ($data["end_time"]); ?>" lxfday="no"></i>		                           
	</div>
<script type="text/javascript">			
	function lxfEndtime(xsjx_time_shop,this_time){	
		if(!this.xsjx_time_shop){
			this.xsjx_time_shop = xsjx_time_shop;	
			this.this_time		= this_time
		}
		this.this_time = this.this_time + 1000;
		lxfEndtime_setTimeout  = window.setTimeout("lxfEndtime()",1000);				
		var endtime = <?php echo (strtotime($data["end_time"])); ?>000;
	    var youtime = endtime - this.this_time;	   	   //还有多久(毫秒值)
		
		var seconds = youtime/1000;
		var minutes = Math.floor(seconds/60);
		var hours = Math.floor(minutes/60);
		var days = Math.floor(hours/24);
		var CDay= days;
		var CHour= hours % 24;
		var CMinute= minutes % 60;
		var CSecond= Math.floor(seconds%60);//"%"是取余运算，可以理解为60进一后取余数，然后只要余数							
		this.xsjx_time_shop.html("<b>限时揭晓</b><p>剩余时间：<em>"+days+"</em>天<em>"+CHour+"</em>时<em>"+CMinute+"</em>分<em>"+CSecond+"</em>秒</p>");
		delete youtime,seconds,minutes,hours,days,CDay,CHour, CMinute, CSecond;
		if(endtime <= this.this_time){			
			lxfEndtime_setTimeout && window.clearTimeout(lxfEndtime_setTimeout);					
			this.xsjx_time_shop.html("<b>限时揭晓</b><p>正在计算中....</p>");//如果结束日期小于当前日期就提示过期啦	
			xsjx_time_shop = this.xsjx_time_shop;
			// 刷新页面
			window.location.href = "<?php echo U('view', '', '');?>/<?php echo ($data["gid"]); ?>/<?php echo ($data["qishu"]); ?>";
		}							
  	}			  
 	$(function(){
 		lxfEndtime($("#timeall"),<?php echo ($serverTime); ?>000);
 	});
</script><?php endif; ?>		
<!-- 限时揭晓end -->

<p class="Pro_Detsingle" style="font-size:14px;">云购价格：¥<b style="color:#999;"><?php echo ($data["danjia"]); ?></b></p>
<?php if($data["xiangou"] > 0): ?><p class="Pro_Detsingle" style="font-size:14px;">限购次数：<b style="color:#999;"><?php echo ($data["xiangou"]); ?></b>人次</p><?php endif; ?>
<div id="divNumber" class="Pro_number">
	我要云购 
	<a href="javascript:void(0);" class="num_del" id="shopsub">-</a>
	<input style="border:1px solid #CFCFCF" type="text" value="1" maxlength="7" onKeyUp="value=value.replace(/\D/g,'')" class="num_dig" id="num_dig"/>
	<a href="javascript:void(0);" class="num_add" id="shopadd">+</a>人次 
	<span id="chance" class="gray03">购买人次越多获得几率越大哦！</span>
</div>
<div style="display:none;" id="hqid"><?php echo ($data["gid"]); ?></div>
<div id="divBuy" class="Det_button">
	<a href="javascript:void(0);" class="Det_Shopbut">立即云购</a>
	<a href="javascript:void(0);" class="Det_Cart add-cart" src="<?php echo ($data["thumb"]); ?>" gid="<?php echo ($data["gid"]); ?>"><i></i>加入购物车</a>							
</div>
<script type="text/javascript">
	$(function() {
		// 加减号
		var shopsub = $("#shopsub").click(onamountchange);
		var shopadd = $("#shopadd").click(onamountchange);
		var input = $("#num_dig").change(onamountchange);
		var chance = $("#chance");
		var id = <?php echo ($data["gid"]); ?>;
		var shengyu = <?php echo ($data["shengyurenshu"]); ?>;
		var zongshu = <?php echo ($data["zongrenshu"]); ?>;
		var xiangou = <?php echo ($data["xiangou"]); ?>;
		function onamountchange() {
			var $this = $(this);
			var count = Number(input.val());
			var flag = $this.is(shopadd) ? 1 : ($this.is(shopsub) ? -1 : 0);
			
			if(xiangou > 0 && (count + flag > xiangou)) {
				return;
			}
			
			if(count > shengyu) {
				count = shengyu;
			}
			
			if(flag == -1 && count <= 1) {
				return;
			}
			
			if(count < -1) {
				input.val(1);
				return;
			}
			count += flag;
			input.val(count);
			var jilv = (count * 100.0 / zongshu);
			jilv = Math.round(jilv * 100.0) / 100.0;
			chance.html("<span style='color:red'>获得机率"+jilv+"%</span>");
		}
		
		// 立即云购
		$(".Det_Shopbut").click(function() {
			$.post("<?php echo U('Cart/add', '', '');?>/<?php echo ($data["gid"]); ?>/<?php echo ($data["type"]); ?>/" + Number(input.val()), null, function(result) {
				window.location.href = "<?php echo U('Cart/index', '','');?>";
			})
		});
	});
</script><?php endif; ?>
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
				<div class="Newest_Con _hiden" style="">
					<?php if(isset($records)): ?><ul>
						<?php if(is_array($records)): foreach($records as $key=>$item): ?><li>
						<a href="<?php echo U('Person', '', '');?>/<?php echo ($item["uid"]); ?>" target="_blank">
							<img src="<?php echo ((isset($item["img"]) && ($item["img"] !== ""))?($item["img"]):'/Public/P/images/member.png'); ?>" border="0" alt="" width="20" height="20">
						</a>					
						<a href="<?php echo U('Person', '', '');?>/<?php echo ($item["uid"]); ?>" target="_blank" class="blue"><?php echo ($item["username"]); ?></a>
						<!-- todo: IP -->			
						<?php echo ($item["time"]); ?> 云购了
						<em class="Fb gray01"><?php echo ($item["count"]); ?></em>人次</li><?php endforeach; endif; ?>
					</ul>
					<p style=""><a id="btnUserBuyMore" href="javascript:;" class="gray01">查看更多</a></p>
					<?php else: ?>
					<p style="">暂时没有人购买</p><?php endif; ?>
				</div>
				
				<!--我的云购记录-->
				<div class="My_Record _hiden" style="display: none;">
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
				<div class="Newest_Con _hiden" style="display: none;">
					<p class="MsgIntro">购是指只需1元就有机会买到想要的商品。即每件商品被平分成若干“等份”出售，每份1元，当一件商品所有“等份”售出后，根据云购规则产生一名幸运者，该幸运者即可获得此商品。</p>
					<p class="MsgIntro1">以“快乐云购，惊喜无限”为宗旨，力求打造一个100%公平公正、100%正品保障、寄娱乐与购物一体化的新型购物网站。<a href="<?php echo U('Help/index');?>/1" class="blue" target="_blank">查看详情&gt;&gt;</a></p>
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
	<div class="Product_Con"><?php echo ($data["content"]); ?></div>
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