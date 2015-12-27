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
<link rel="stylesheet" type="text/css" href="/Public/P/css/layout-setUp.css"/>
 


	<div class="R-content">
		<div class="prompt orange">完善以下资料，<?php echo config('web_name_two');?>不会以任何形式公开您的个人隐私，请放心填写！<s></s></div>
		<div class="info">
		<form class="registerform" method="post">
			<table border="0" cellpadding="0" cellspacing="8">
				<tr>
							
					<td align="right"><em><font>*</font><label>手机：</label></em></td>
					<td>
						<b><?php echo ($data["mobile"]); ?></b>
						<?php if($data["mobilecode"] == 1): ?>已验证<?php endif; ?>
					</td>
					<td>
						 <?php if($data["mobilecode"] == 0): ?><a style="margin-left:0;" href="<?php echo U('Home/mobilechecking', '', '');?>" title="绑定手机">绑定手机</a><?php endif; ?>
					 </td>
				</tr>
				
	
				<tr>
					<td align="right"><em><font>*</font><label>昵称：</label></em></td>
					<td>
						<input id="nicxx" datatype="nic" nullmsg="昵称不能为空" name="username" value="<?php echo ($data["username"]); ?>" type="text"  class="txt gray" maxlength="20" />					
					</td>					
					<td><div class="Validform_checktip">昵称为2-20个汉字、字母、数字、“_”字符组成</div></td>
				</tr>
				<tr>
					<td align="right"><em><font>&nbsp;</font><label>签名：</label></em></td>
					<?php if($data["qianming"] == ''): ?><td><textarea name="qianming" class="info_txtarea gray03" >让别人看到不一样的你！</textarea></td>
					<?php else: ?>
						<td><textarea name="qianming" class="info_txtarea gray03" ><?php echo ($data["qianming"]); ?></textarea></td><?php endif; ?>
				</tr>
				<tr>
					<td><em>&nbsp;</em></td>
					<td><input name="submit" type="submit"  class="bluebut" value="保存"></td>
				</tr>
			</table>
		</form>	
		</div>
	</div>
</div>
 <script type="text/javascript">
	function checked(ss){
		$("#showimg").attr("src",ss.src);
		$("#membimg").val(ss.id);
	}
	
	$(document).ajaxStart(function() {
				$("button:submit").attr("disabled", true);
			}).ajaxStop(function() {
				$("button:submit").attr("disabled", false);
			});
			$(function() {		
				$("form").submit(function() {
					var self = $(this);
					//alert(self.serialize());
					$.post("<?php echo U('Home/modify','','');?>", self.serialize(), success, "json");
					return false;
					function success(data) {
						if (data.status) {
							window.location.href="<?php echo U('Home/index','','');?>";
						} else {
							alert(data.msg);
						}
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