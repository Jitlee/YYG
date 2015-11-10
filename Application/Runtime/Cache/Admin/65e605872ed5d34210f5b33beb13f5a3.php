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
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">后台管理系统</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<p class="navbar-text">admin</p>
						</li>
						<li><a href="#">修改密码</a></li>
						<li><a href="/index.php/Admin/User/../Public/logout">退出</a></li>
					</ul>
				</div>
			</div>
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
	<ul id="mainNavTabs" class="nav nav-tabs navbar-fixed-top">
	<li id="sysmgr"><a>系统管理</a></li>
	<li id="gdmgr"><a>商品管理</a></li>
	<li id="mbmgr"><a>会员管理</a></li>
</ul>
<div id="subNavTabs">
	<ul id="s_sysmgr" class="nav-sidebar hidden">
		<?php if(ROLE == 1): ?><li id="usrmgr">
			<a>管理员管理</a>
			<ul>
				<li id="usrlst"><a href="/index.php/Admin/User/../User">管理员列表</a></li>
				<li id="addusr"><a href="/index.php/Admin/User/../User/add">添加管理员</a></li>
				<li id="chagpwd"><a href="/index.php/Admin/User/../User/change">修改密码</a></li>
			</ul>
		</li><?php endif; ?>
	</ul>
	<ul id="s_gdmgr" class="nav-sidebar hidden">
		<li id="msmgr">
			<a>秒杀商品管理</a>
			<ul>
				<li id="mslst"><a href="/index.php/Admin/User/../Miaosha">秒杀商品列表</a></li>
				<li id="addms"><a href="/index.php/Admin/User/..//Miaosha/add">添加秒杀商品</a></li>
			</ul>
		</li>
		<li id="cmgr">
			<a>分类管理</a>
			<ul>
				<li id="clist"><a href="/index.php/Admin/User/../Category">商品分类列表</a></li>
				<li id="blist"><a href="/index.php/Admin/User/../Brand">品牌管理</a></li>
				<li id="addb"><a href="/index.php/Admin/User/../Brand/add">添加品牌</a></li>
			</ul>
		</li>
	</ul>
	<ul id="s_mbmgr" class="nav-sidebar hidden">
		<li id="mbmgr_">
			<a>会员管理</a>
			<ul>
				<li id="mblst"><a>会员列表</a></li>
				<li id="fdmb"><a>查找会员</a></li>
				<li id="addmb"><a>添加会员</a></li>
				<li id="vcrcd"><a>充值记录</a></li>
				<li id="cpi"><a>消费记录</a></li>
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
	<a type="button" href="<?php echo U('add','','');?>" class="btn btn-primary navbar-btn">添加管理员</a>
</div>
<table id="adminTable" class="table table-bordered">
	<thead>
		<tr>
			<th>用户名</th>
			<th>所属角色</th>
			<th>Email</th>
			<th>最后登陆IP</th>
			<th>最后登陆时间</th>
			<th>历史登陆次数</th>
			<th style="width:150px">操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($list)): foreach($list as $key=>$admin): ?><tr>
				<td><?php echo ($admin["username"]); ?></td>
				<td>
					<?php if($admin["role"] == 1): ?>超级管理员
						<?php else: ?>管理员<?php endif; ?>
				</td>
				<td><?php echo ($admin["email"]); ?></td>
				<td><?php echo ($admin["login_ip"]); ?></td>
				<td><?php echo ($admin["login_time"]); ?></td>
				<td><?php echo ($admin["login"]); ?></td>
				<td uid="<?php echo ($admin["uid"]); ?>">
					<a type="button" class="edit btn btn-warning btn-sm" href='<?php echo U('edit','','');?>/<?php echo ($admin["uid"]); ?>'>编辑</a>
					<button type="button" class="delete btn btn-danger btn-sm">删除</button>
				</td>
			</tr><?php endforeach; endif; ?>
	</tbody>
</table>
<nav>
  <ul class="pagination">
  	<?php if($minPageNum == 1): ?><li class="disabled">
      <span aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </span>
    </li>
  	<?php else: ?>
    <li>
      <a href="/index.php/Admin/User/index/<?php echo ($pageSize); ?>/<?php echo ($minPageNum-1); ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li><?php endif; ?>
    <?php $__FOR_START_1553001335__=$minPageNum;$__FOR_END_1553001335__=$pageNum;for($i=$__FOR_START_1553001335__;$i < $__FOR_END_1553001335__;$i+=1){ ?><li><a href="/index.php/Admin/User/Index/<?php echo ($pageSize); ?>/<?php echo ($i); ?>" style="color:#008000"><?php echo ($i); ?></a></li><?php } ?>
	<li class="active"><a><?php echo ($pageNum); ?></a></li>
    <?php $__FOR_START_1385252440__=$pageNum+1;$__FOR_END_1385252440__=$maxPageNum;for($i=$__FOR_START_1385252440__;$i < $__FOR_END_1385252440__;$i+=1){ ?><li><a href="/index.php/Admin/User/index/<?php echo ($pageSize); ?>/<?php echo ($i); ?>" style="color:red"><?php echo ($i); ?></a></li><?php } ?>
	<?php if($maxPageNum == $pageCount): ?><li class="disabled">
      <span aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </span>
    </li>
  	<?php else: ?>
    <li>
      <a href="/index.php/Admin/User/index/<?php echo ($pageSize); ?>/<?php echo ($maxPageNum); ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li><?php endif; ?>
  </ul>
</nav>
<script type="text/javascript">
	$(function(){
		$("#adminTable").on("click",".delete", function(evt) {
			var ths = $(this);
			var uid = ths.parent().attr("uid");
			var tr = ths.closest("tr");
			UI.confirm("是否删除", {
				ok: function() {
					remove(tr, uid);
				}
			});
		});
		
		function remove(tr, uid) {
			$.post("<?php echo U('remove','','');?>/" + uid, null, function(data) {
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