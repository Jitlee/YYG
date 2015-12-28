<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<meta name="description" content="">
		<meta name="author" content="">
		<!--<link rel="icon" href="../../favicon.ico">-->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

		<title><?php echo ($title); ?></title>

		<!-- Bootstrap core CSS -->
		<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
		<link href="/Public/Admin/css/bootstrap.css" rel="stylesheet">
		<link href="/Public/Admin/css/index.css" rel="stylesheet">
		<link href="/Public/Admin/css/common.css" rel="stylesheet">	
		<!--<link href="/Application/admin/View/css/global.css" rel="stylesheet">-->
			<style type="text/css">
				.navv .current{background:url(/Public/Admin/images/nav_bg_1.png) no-repeat 0px 0px;border:0px solid #000;}
				
				.navv .current a{
					display:block;
					left:20px;
					height:40px;
					text-align:center;
					padding-right:20px;
					background:url(/Public/Admin/images/nav_bg_1.png) no-repeat right top;
					color:#2a8bbb;
					top:0px;
				}
				#navbar ul li a{color: #ffffff;}
				#navbar ul li p{color: #ffffff;}
			</style>
	</head>

	<body style="padding-top: 90px;">
		<nav class="navbar navbar-inverse navbar-fixed-top" style="background: #2a8bbb; margin-bottom: 0px; height: 80px;">
			<div class="container-fluid">
				<div class="navbar-header" id="header">
					
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="logo"></div>
					<!--<a class="navbar-brand" href="#">后台管理系统</a>-->
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right" >
						<li>
							<p class="navbar-text">admin</p>
						</li>
						<li><a href="#">修改密码</a></li>
						<li><a href="/index.php/Admin/Miaosha/../Public/logout">退出</a></li>
					</ul>
				</div>
			</div>
		<ul id="mainNavTabs" class="navv navbar-fixed-top" style="position: absolute; top:40px; left:500px; z-index: 100; background: none; border-bottom: none; ">
		<li id="sysmgr" class="normal"><a>系统管理</a></li>
		<li id="gdmgr" class="normal"><a>商品管理</a></li>
		<li id="mbmgr" class="normal"><a>会员管理</a></li>
		<li id="uimgr" class="normal"><a>界面管理</a></li>
</ul>
		</nav>

		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js"></script>
		
		<script src="/Public/Admin/js/jquery.maxlength.min.js"></script>
		<!--<script src="/Public/Admin/js/validator.min.js"></script>-->
		<script src="/Public/Admin/js/app.js"></script>
<div class="body">
	
<div id="subNavTabs" style="width: 220px;" >
	<ul id="s_sysmgr" class="nav-sidebar hidden">
		<?php if(ROLE == 1): ?><li id="usrmgr" class="head">
			<a>管理员管理</a>
			<ul>
				<li id="usrlst" class="set"><a href="/index.php/Admin/User">管理员列表</a></li>
				<li id="addusr" class="set"><a href="/index.php/Admin/User/add">添加管理员</a></li>
				<li id="chagpwd" class="set"><a href="/index.php/Admin/User/change">修改密码</a></li>
			</ul>
		</li><?php endif; ?>
	</ul>
	<ul id="s_gdmgr" class="nav-sidebar hidden">
		<li id="msmgr">
			<a>秒杀商品管理</a>
			<ul>
				<li id="mslst"><a href="/index.php/Admin/Miaosha">秒杀商品列表</a></li>
				<li id="addms"><a href="/index.php/Admin/Miaosha/add">添加秒杀商品</a></li>
			</ul>
		</li>
		<!--<li id="xgmgr">
			<a>限购商品管理</a>
			<ul>
				<li id="xglst"><a href="/index.php/Admin/Xiangou">限购商品列表</a></li>
				<li id="addxg"><a href="/index.php/Admin/Xiangou/add">添加限购商品</a></li>
			</ul>
		</li>-->
		<li id="pmmgr">
			<a>拍卖商品管理</a>
			<ul>
				<li id="pmlst"><a href="/index.php/Admin/Paimai">拍卖商品列表</a></li>
				<li id="addpm"><a href="/index.php/Admin/Paimai/add">添加拍卖商品</a></li>
			</ul>
		</li>
		<li id="cmgr">
			<a>分类管理</a>
			<ul>
				<li id="clist"><a href="/index.php/Admin/Category">商品分类列表</a></li>
				<li id="blist"><a href="/index.php/Admin/Brand">品牌管理</a></li>
				<li id="addb"><a href="/index.php/Admin/Brand/add">添加品牌</a></li>
			</ul>
		</li>
	</ul>
	<ul id="s_mbmgr" class="nav-sidebar hidden">
		<li id="mbmgr_">
			<a>会员管理</a>
			<ul>
				<li id="mblst"><a href="/index.php/Admin/Member">会员列表</a></li>
				<li id="fdmb"><a href="/index.php/Admin/Member/find">查找会员</a></li>
				<li id="addmb"><a href="/index.php/Admin/Member/add">添加会员</a></li>
				<li id="vcrcd"><a>充值记录</a></li>
				<li id="cpi"><a>消费记录</a></li>
			</ul>
		</li>
	</ul>
	<ul id="s_uimgr" class="nav-sidebar hidden">
		<li id="mbmgr_">
			<a>界面管理</a>
			<ul>
				<li id="wxhdlist"><a href="/index.php/Admin/Slide">微信幻灯管理</a></li>
				<li id="aclist"><a href="/index.php/Admin/Article">文章管理</a></li>
			</ul>
		</li>
	</ul>
	<div class="nav-sidebar-footer">
	</div>
</div>

<script type="text/javascript">
$(function() {
	var mainNavTabs = $("#mainNavTabs");
	var subNavTabs = $("#subNavTabs");
	
	$("#<?php echo ((isset($pid) && ($pid !== ""))?($pid):'sysmgr'); ?>", mainNavTabs).addClass("active");
	$("#s_<?php echo ((isset($pid) && ($pid !== ""))?($pid):'sysmgr'); ?>", subNavTabs).removeClass("hidden");
	<?php if(isset($mid)): ?>$("#<?php echo ($mid); ?>", subNavTabs).addClass("active");<?php endif; ?>
	
	var pid = "<?php echo ((isset($pid) && ($pid !== ""))?($pid):'sysmgr'); ?>";
	mainNavTabs.on("click", "li", function() {
		var _pid = $(this).attr("id");
		if(_pid != pid) {
			if(pid) {
				$("#" + pid, mainNavTabs).removeClass("active");
				$("#s_" + pid, subNavTabs).addClass("hidden");
			}
			pid = _pid;
			$("#" + pid, mainNavTabs).addClass("active");
			$("#s_" + pid, subNavTabs).removeClass("hidden");
		}
	});
});
</script>

	<div class="main">
		<h1><?php echo ($title); ?></h1>
		 <div class="nav">
	<a type="button" href="<?php echo U('add','','');?>" class="btn btn-primary navbar-btn"><?php echo ($addTitle); ?></a>
</div>
<table id="listTable" class="table table-bordered">
	<thead>
		<tr>
			<th>商品标题</th>
			<th>所属栏目</th>
			<th>已参与/总参</th>
			<th>单价/元</th>
			<th>期数/最大期数</th>
			<th>人气商品</th>
			<?php if($type == 2): ?><th>限购次数</th><?php endif; ?>
			<th style="width:200px">操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($list)): foreach($list as $key=>$good): ?><tr>
			<td><?php echo ($good["title"]); ?></td>
			<td><?php echo ($good["category"]["name"]); ?></td>
			<td><?php echo ($good["canyurenshu"]); ?>/<?php echo ($good["shengyurenshu"]); ?></td>
			<td><?php echo ($good["danjia"]); ?></td>
			<td><?php echo ($good["qishu"]); ?>/<?php echo ($good["maxqishu"]); ?></td>
			<td><?php echo ($good["renqi"]); ?></td>
			<?php if($type == 2): ?><td><?php echo ($good["xiangou"]); ?></td><?php endif; ?>
			<td gid="<?php echo ($good["gid"]); ?>">
				<a type="button" class="edit btn btn-warning btn-sm" href='<?php echo U('edit','','');?>/<?php echo ($good["gid"]); ?>'>编辑</a>
				<button type="button" class="delete btn btn-danger btn-sm">删除</button>
				<a type="button" class="edit btn btn-warning btn-sm" href='<?php echo U('history','','');?>/<?php echo ($good["gid"]); ?>'>查看往期</a>
			</td>
		</tr><?php endforeach; endif; ?>
	</tbody>
</table>
<nav>
  <ul class="pagination">
  	<?php if($minPageNum > 1): ?><li>
      <a href="/index.php/Admin/Miaosha/index/<?php echo ($pageSize); ?>/<?php echo ($minPageNum-1); ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  	<?php else: ?>
    <li class="disabled">
      <span aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </span>
    </li><?php endif; ?>
  	<?php if($pageNum > 1): $__FOR_START_25547__=$minPageNum;$__FOR_END_25547__=$pageNum;for($i=$__FOR_START_25547__;$i < $__FOR_END_25547__;$i+=1){ ?><li><a href="/index.php/Admin/Miaosha/index/<?php echo ($pageSize); ?>/<?php echo ($i); ?>" style="color:#008000"><?php echo ($i); ?></a></li><?php } endif; ?>
	<li class="active"><a><?php echo ($pageNum); ?></a></li>
  <?php $__FOR_START_1960__=$pageNum+1;$__FOR_END_1960__=$maxPageNum;for($i=$__FOR_START_1960__;$i < $__FOR_END_1960__;$i+=1){ ?><li><a href="/index.php/Admin/Miaosha/index/<?php echo ($pageSize); ?>/<?php echo ($i); ?>" style="color:red"><?php echo ($i); ?></a></li><?php } ?>
	<?php if($maxPageNum < $pageCount AND $maxPageNum > 0): ?><li>
      <a href="/index.php/Admin/Miaosha/index/<?php echo ($pageSize); ?>/<?php echo ($maxPageNum); ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  	<?php else: ?>
    <li class="disabled">
      <span aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </span>
    </li><?php endif; ?>
  </ul>
</nav>
<script type="text/javascript">
	$(function(){
		$("#listTable").on("click",".delete", function(evt) {
			var ths = $(this);
			var gid = ths.parent().attr("gid");
			var tr = ths.closest("tr");
			UI.confirm("是否删除", {
				ok: function() {
					remove(tr, gid);
				}
			});
		});
		
		function remove(tr, gid) {
			$.post("<?php echo U('remove','','');?>/" + gid, null, function(data) {
				if(data.status) {
					tr.remove();
				} else {
					$("#tips").text(data.info);
				}
			}, "json");
		}
	});
</script>
		 <p id="tips" class="check-tips text-danger"></p>
	</div>
	<div class="clear"></div>
</div>
<div id="modalConfirm" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 id="modalConfirmContent"></h4>
			</div>
			<div class="modal-footer">
				<button id="modalConfirmCancelButton" type="button" class="btn cancel" data-dismiss="modal">取消</button>
				<button id="modalConfirmOKButton" type="button" class="btn btn-primary ok" data-dismiss="modal">确定</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var modalConfirmCancelButton = $("#modalConfirmCancelButton");
		var modalConfirmOKButton = $("#modalConfirmOKButton");
		var modalConfirmContent = $("#modalConfirmContent");
		var modalConfirm = $("#modalConfirm");
		var ui = window.UI|| (window.UI = {});
		var cancel = null;
		var ok = null;
		
		modalConfirmOKButton.click(function() {
			if(ok) {
				ok();
				ok = null;
			}
		});
		
		modalConfirmCancelButton.click(function() {
			if(cancel) {
				cancel();
				cancel = null;
			}
		});
		
		ui.confirm = function(text, options){
			modalConfirmContent.text(text);
			if(options){
				ok = options.ok;
				cancel = options.cancel;
			}
			modalConfirm.modal();
		};
	});
</script>
		
	</body>
</html>