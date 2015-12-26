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
						<li><a href="/index.php/Admin/Category/../Public/logout">退出</a></li>
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
		 <form class="form-horizontal" role="form" method="post" data-toggle="validator">
	<?php if(isset($data["cid"])): ?><input type="hidden" name="cid" value="<?php echo ($data["cid"]); ?>" /><?php endif; ?>
	<div class="form-group">
		<label for="inputName" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="name" id="inputName" placeholder="分类名称" value="<?php echo ($data["name"]); ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="thumbButton" class="col-sm-2 control-label">图标</label>
		<div class="col-sm-10">
			<button id="thumbButton" type="button" class="btn btn-default" style="padding: 0;">
				<img src="<?php echo ((isset($data["thumb"]) && ($data["thumb"] !== ""))?($data["thumb"]):'/Public/Admin/images/favicon.png'); ?>" class="img-thumbnail thumb" alt="缩略图" />
			</button>
			<input class="hidden" id="inputThumb" name="thumb" value="<?php echo ($data["thumb"]); ?>" />
			<span id="thumbTips" class="label label-info" thumb="<?php echo ($data["thumb"]); ?>">点击图标可以上传品牌缩略图</span>
		</div>
	</div>
	<div class="form-group">
		<p id="checkTips" class="check-tips text-danger"></p>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"> 提交 </button>
			<a class="btn btn-default" href="<?php echo U('index','','');?>"> 取消 </a>
		</div>
	</div>
</form>
<div id="modalUpload" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 id="modelUploadTitle" class="modal-title">图片上传</h4>
			</div>
			<div class="modal-body">
				<p>
					最多上传
					<span id="modelUploadLimitLabel" class="label label-info">1</span> 个附件,单文件最大
					<span class="label label-info">488KB</span> 类型:
					<span class="label label-info"> *.png;*.jpg;*.gif;*.jpeg;</span>
				</p>
				<input id="modalUploadFile" type="file" name="file" accept="image/*" />
				<div id="uploadPreviewImageTemplate" class="hidden col-xs-4 col-md-3">
					<a href="#" class="thumbnail">
						<img alt=""/>
						<button type="button" class="btn btn-link">删除</button>
					</a>
				</div>
				<div id="uploadPreviewBody" class="row">
				</div>
			</div>
			<div class="modal-footer">
				<button id="modalUploadCancelButton" type="button" class="btn cancel" data-dismiss="modal">取消</button>
				<button id="modalUploadOKButton" type="button" class="btn btn-primary ok" data-dismiss="modal">确定</button>
			</div>
		</div>
	</div>
</div>
<link href="/Public/Admin/css/uploadify.css" rel="stylesheet">
<script src='/Public/Static/js/jquery.uploadify.min.js'></script>
<script type="text/javascript">
	$(function() {
		var modalUploadCancelButton = $("#modalUploadCancelButton");
		var modelUploadLimitLabel = $("#modelUploadLimitLabel");
		var modalUploadOKButton = $("#modalUploadOKButton");
		var modelUploadTitle = $("#modelUploadTitle");
		var modalUpload = $("#modalUpload");
		var ui = window.UI || (window.UI = {});
		var cancel = null;
		var ok = null;
		var files = [];
		modalUploadCancelButton.click(function() {
			if (cancel) {
				cancel();
				cancel = null;
			}
		});
		modalUploadOKButton.click(function() {
			if (ok) {
				ok(files);
				ok = null;
			}
		});
		var uploadify = $("#modalUploadFile");
		var uploadPreviewImageTemplate = $("#uploadPreviewImageTemplate");
		var uploadPreviewBody = $("#uploadPreviewBody").on("click", "button", function() {
			var self = $(this);
			var url = self.attr("url");
			var key = self.attr("key");
			$.post("<?php echo U('removefile','','');?>/" + key);
			self.closest("div").remove();
			var num = files.length;
			while(num--) {
				if(files[num].url == url) {
					files.splice(num, 1);
					break;
				}
			}
		});

		function initUploadify(options) {
			files.length = 0;
			var data = uploadify.data("uploadify");
			if (data) {
				$("#modalUploadFile").uploadify("destroy");
				uploadPreviewBody.empty();
			}
			uploadify.uploadify({
				swf: "/Public/Static/swf/uploadify.swf",
				buttonText: '选择文件上传',
				multi: options.limit > 1,
				uploadLimit: options.limit,
				removeCompleted: true,
				fileTypeDesc : "图片文件",
        			fileTypeExts : "*.png;*.jpg;*.gif;*.jpeg",
				uploader: "<?php echo U('upload','','');?>",
				onUploadSuccess: function(file, data) {
					var data = JSON.parse(data);
					if (data && data.status == 0) {
						files.push(data);
						var previewImage = uploadPreviewImageTemplate
							.clone()
							.removeAttr("id")
							.removeClass("hidden");
						uploadPreviewBody.append(previewImage);
						
						$(".btn",previewImage).attr("key", data.key).attr("url", data.url);
						$("img",previewImage).attr("src", data.url);
					}
				}
			});
		}
		ui.upload = function(title, options) {
			if (options) {
				modelUploadTitle.text(title);
				modelUploadLimitLabel.text(options.limit||1);
				options.limit = options.limit||1;
				initUploadify(options);
				ok = options.ok;
				cancel = options.cancel;
			}
			modalUpload.modal();
		};
	});
</script>
<script type="text/javascript">
	 //表单提交
	$(document).ajaxStart(function() {
		$("button:submit").attr("disabled", true);
	}).ajaxStop(function() {
		$("button:submit").attr("disabled", false);
	});
	 //刷新验证码
	$(function() {
		var thumbButton = $("#thumbButton").click(function(){
			UI.upload("上传缩略图", {
				ok: function(files) {
					if (files.length > 0) {
						var url = files[0].url;
						$("img", thumbButton).attr("src", url);
						$("input", thumbButton.parent()).val(url);
					}
				}
			});
		});
		
		$("form").submit(function() {
			var self = $(this);
			$.post('<?php echo ($action); ?>', self.serialize(), success, "json");
			return false;
	
			function success(data) {
				if (data.status) {
					window.location.href = data.url;
				} else {
					$("#checkTips").text(data.info);
				}
			}
		});
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