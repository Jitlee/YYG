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
						<li><p class="navbar-text">admin</p></li>
						<li><a href="#">修改密码</a></li>
						<li><a href="#">帮助</a></li>
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
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			
<ul class="nav-sidebar">
	<li>
		<a>商品管理</a>
		<ul>
			<li>
				<a class="nav-sidebar-selected">添加商品</a>
			</li>
			<li>
				<a>管理商品</a>
			</li>
			<li>
				<a>栏目管理</a>
			</li>
			<li>
				<a>品牌管理</a>
			</li>
		</ul>
	</li>
	<li>
		<a>用户管理</a>
		<ul>
			<li>
				<a>添加用户</a>
			</li>
			<li>
				<a>管理用户</a>
			</li>
		</ul>
	</li>
	<li>
		<a>关于</a>
	</li>
</ul>

		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1><?php echo ($title); ?></h1>
			 <div class="nav">
	<button type="button" class="btn btn-primary navbar-btn">添加栏目</button>
</div>
<table id="categoryTable" class="table table-bordered">
	<thead>
		<tr>
			<th>栏目名称</th>
			<th>键值</th>
			<th style="width:130px">操作</th>
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><tr>
			<td><?php echo ($category["name"]); ?></td>
			<td><?php echo ($category["key"]); ?></td>
			<td cid="<?php echo ($category["cid"]); ?>">
				<button type="button" class="edit btn btn-warning btn-sm">编辑</button>
				<button type="button" class="delete btn btn-danger btn-sm">删除</button>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<script type="text/javascript">
	$(function(){
		$("#categoryTable").on("click",".delete", function(evt) {
			var ths = $(this);
			var cid = ths.parent().attr("cid");
			var tr = ths.closest("tr");
			UI.confirm("是否删除", {
				ok: function() {
					remove(tr, cid);
				}
			});
		});
		
		function remove(tr, cid) {
			$.post("<?php echo U('remove','','');?>/" + cid, null, function(data) {
				if(data.status) {
					tr.remove();
				} else {
					alert(data.info);
				}
			}, "json");
		}
	});
</script>
		</div>
	</div>
</div>
<script type="text/javascript" src="/Public/Admin/js/modal.js"></script>
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
		
   	 	
   	 	<footer>
			<div class="container">
				<p class="navbar-text">&copy;2015 </p>
			</div>
   	 	</footer>
	</body>
</html>