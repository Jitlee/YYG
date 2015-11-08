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
						<li><a href="#">帮助</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<ul id="mainNavTabs" class="nav nav-tabs navbar-fixed-top">
			<li role="presentation"><a>系统管理</a></li>
			<li role="presentation" class="active"><a>商品管理</a></li>
			<li role="presentation"><a>内容管理</a></li>
			<li role="presentation"><a>界面管理</a></li>
			<li role="presentation"><a>云应用</a></li>
		</ul>

		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js"></script>
		
		<script src="/Public/Admin/js/jquery.maxlength.min.js"></script>
		<script src="/Public/Admin/js/app.js"></script>
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
				<a>商品列表</a>
			</li>
			<li>
				<a>商品分类</a>
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
			 <form class="form-horizontal" action="<?php echo ($action); ?>" role="form" method="post">
	<?php if($data["gid"] > 0): ?><input type="hidden" name="gid" value="<?php echo ($data["gid"]); ?>" /><?php endif; ?>

	<table class="table">
		<tr class="form-inline">
			<td class="col-sm-2 control-label">
				<label for="categorySelect" class="control-label">所属分类</label>
			</td>
			<td>
				<select id="categorySelect" class="form-control" name="cid">
					<option>==请选择栏目==</option>
					<?php if(is_array($allCategories)): $i = 0; $__LIST__ = $allCategories;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><option value="<?php echo ($c["cid"]); ?>"><?php echo ($c["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</td>
		</tr>
		<tr class="form-inline">
			<td class="col-sm-2 control-label">
				<label for="brandSelect" class="control-label">所属品牌</label>
			</td>
			<td>
				<select id="brandSelect" class="form-control" name="bid">
					<option>==请选择品牌==</option>
					<?php if(is_array($allBrands)): $i = 0; $__LIST__ = $allBrands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><option value="<?php echo ($b["bid"]); ?>"><?php echo ($b["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="form-inline col-sm-2 control-label">
				<label for="inputTitle" class="control-label">商品标题</label>
			</td>
			<td>
				<input class="form-control" id="inputTitle" name="title" value="<?php echo ($data["title"]); ?>" />
			</td>
		</tr>
		<tr>
			<td class="col-sm-2 control-label">
				<label for="inputSubTitle" class="control-label">副标题</label>
			</td>
			<td>
				<input class="form-control" id="inputSubTitle" name="subtitle" value="<?php echo ($data["subtitle"]); ?>" />
			</td>
		</tr>
		<tr>
			<td class="col-sm-2 control-label">
				<label for="inputDescription" class="control-label">商品描述</label>
			</td>
			<td>
				<textarea class="form-control automaxlength" name="description" id="inputDescription" rows="2" maxlength="255"><?php echo ($data["description"]); ?></textarea>
			</td>
		</tr>
		<tr class="form-inline">
			<td class="col-sm-2 control-label">
				<label for="inputZongjia" class="control-label">商品总价</label>
			</td>
			<td>
				<input class="form-control" style="width:100px" id="inputZongjia" name="money" value="<?php echo ($data["money"]); ?>" />
				<label class="control-label">元</label>
			</td>
		</tr>
		<tr class="form-inline">
			<td class="col-sm-2 control-label">
				<label for="inputDanjia" class="control-label">商品单价</label>
			</td>
			<td>
				<input class="form-control" style="width:100px" id="inputDanjia" name="danjia" value="<?php echo ($data["danjia"]); ?>" />
				<label class="control-label">元</label>
			</td>
		</tr>
		<tr class="form-inline">
			<td class="col-sm-2 control-label">
				<label for="inputMaxQishu" class="control-label">最大期数</label>
			</td>
			<td>
				<input class="form-control" style="width:100px" id="inputMaxQishu" name="maxqishu" value="<?php echo ($data["maxqishu"]); ?>" />
				<label class="control-label">期，期数上限为65535期,每期揭晓后会根据此值自动添加新一期商品！</label>
			</td>
		</tr>
		<tr class="form-inline">
			<td class="col-sm-2 control-label">
				<label for="inputThumb" class="control-label">缩略图</label>
			</td>
			<td>
				<img src="<?php echo ((isset($data["thumb"]) && ($data["thumb"] !== ""))?($data["thumb"]):'/Public/Admin/images/goods.jpg'); ?>" class="img-thumbnail thumb" alt="缩略图" />
				<input class="form-control" style="width:400px" id="inputThumb" name="thumb" readonly value="<?php echo ((isset($data["thumb"]) && ($data["thumb"] !== ""))?($data["thumb"]):'/Public/Admin/images/goods.jpg'); ?>" />
				<button id="thumbButton" type="button" class="btn btn-default">上传图片</button>
			</td>
		</tr>
		<tr class="form-inline">
			<td class="col-sm-2 control-label">
				<label for="imagesButton" class="control-label">展示图片</label>
			</td>
			<td>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							最多上传10张图片
							<button id="imagesButton" type="button" class="btn btn-default">上传图片</button>
						</h3>
					</div>
					<div class="panel-body">
						<div id="photoTemplate" class="hidden col-xs-6 col-md-3">
							<a class="thumbnail">
								<img alt="" />
								<input type="hidden" class="hidden _file" />
								<input type="hidden" class="hidden _key" />
								<button type="button" class="btn btn-link">删除</button>
							</a>
						</div>
						<div id="imagesBody" class="row">
							<?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?><div class="col-xs-6 col-md-3">
									<a class="thumbnail">
										<img alt="" src="<?php echo ($image["image_url"]); ?>" />
										<input type="hidden" class="hidden _file" name="imageUrls[]" value="<?php echo ($image["image_url"]); ?>" />
										<input type="hidden" class="hidden _key" name="imageKeys[]" value="<?php echo ($image["image_key"]); ?>" />
										<button type="button" class="btn btn-link">删除</button>
									</a>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td class="col-sm-2 control-label">
				<label for="contentEdtior" class="control-label">商品内容详情</label>
			</td>
			<td>
				
<script type="text/javascript" charset="utf-8" src="/Public/UEditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/UEditor/ueditor.all.js"></script>
<script type="text/plain" id="contentEdtior" name="content" style=""><?php echo ($data["content"]); ?></script>
<script type="text/javascript">var ue_contentEdtior = UE.getEditor("contentEdtior");</script>

			</td>
		</tr>
		<tr>
			<td class="col-sm-2 control-label">
				<label class="control-label">商品属性</label>
			</td>
			<td>
				<label class="checkbox-inline">
					<input type="checkbox" id="checkRenqi" boolean name="renqi" value="<?php echo ($data["renqi"]); ?>" <?php if($data["renqi"] == 1): ?>checked="true"<?php endif; ?> />推荐
				</label>
				<label class="checkbox-inline">
					<input type="checkbox" id="checkTuijian" boolean name="tuijian" <?php if($data["tuijian"] == 1): ?>checked="true"<?php endif; ?>  value="<?php echo ($data["tuijian"]); ?>">人气
				</label>
			</td>
		</tr>
		<tr>
			<td class="col-sm-2">
			</td>
			<td>
				<button type="submit" class="btn btn-primary"> 提交 </button>
				<a class="btn btn-default" href="<?php echo U('index','','');?>"> 取消 </a>
			</td>
			</div>
	</table>
	<div class="form-group">
		<p id="checkTips" class="check-tips text-danger"></p>
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
						
						$(".btn",previewImage).attr("key", data.key);
						$(".btn",previewImage).attr("url", data.url);
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
				var brandSelect = $("#brandSelect");
				var categorySelect = $("#categorySelect").change(function(evt) {
					var value = $(this).val();
					brandSelect.empty();
					brandSelect.append("<option>==请选择品牌==</option>");
					if (value) {
						$.get("<?php echo ($categoryAction); ?>/" + value, null, ongetbrandsuccess);
					}
				});

				function ongetbrandsuccess(list) {
					if (list && list.length > 0) {
						for (var i = 0, len = list.length; i < len; i++) {
							var option = $("<option>").val(list[i].cid).text(list[i].name);
							brandSelect.append(option);
						}
						brandSelect.val(list[0].cid).change();
					}
				}
				var thumbButton = $("#thumbButton").click(function() {
					UI.upload("上传缩略图", {
						ok: function(files) {
							if (files.length > 0) {
								var url = files[0].url;
								$("img", thumbButton.parent()).attr("src", url);
								$("#inputThumb").val(url);
							}
						}
					});
				});
				$("form").submit(function() {
					var self = $(this);
					$.post(self.attr("action"), self.serialize(), success, "json");
					return false;

					function success(data) {
						if (data.status) {
							window.location.href = data.url;
						} else {
							$("#checkTips").text(data.info);
						}
					}
				});
				// 图片上传
				var photoTemplate = $("#photoTemplate");
				var imagesButton = $("#imagesButton").click(function() {
					var limit = 10 - imagesBody.children().length;
					UI.upload("上传展示图片", {
						limit: limit,
						ok: function(files) {
							for (var i = 0, len = files.length; i < len; i++) {
								var url = files[i].url;
								var key = files[i].key;
								var previewImage = photoTemplate
									.clone()
									.removeAttr("id")
									.removeClass("hidden");
								imagesBody.append(previewImage);
								$("input._file", previewImage).val(url).attr("name", "imageUrls[]");
								$("input._key", previewImage).val(key).attr("name", "imageKeys[]");
								$("img", previewImage).attr("src", url);
							}
							var length = imagesBody.children().length;
							if (length == 10) {
								imagesButton.attr("disabled", true);
							}
						}
					});
				});
				// 删除图片
				var imagesBody = $("#imagesBody").on("click", "button", function() {
					var self = $(this);
					var parent = self.parent();
					var file = $("input._file", parent).val();
					var key = $("input._key", parent).val();
					//			$.post("<?php echo U('removefile','','');?>/" + key);
					self.closest("div").remove();
					imagesButton.attr("disabled", false);
				}); 
				
				<?php if($data["gid"] > 0): ?>// 设置下拉框选中
					categorySelect.val("<?php echo ($data["cid"]); ?>").change();
					brandSelect.val("<?php echo ($data["bid"]); ?>").change();<?php endif; ?>
				
				// 设置勾选狂value
				$("[boolean]").change(function() {
					var self = $(this);
					self.val(self.prop("checked") ? 1 : 0);
				});
	});
</script>
			 <p id="tips" class="check-tips text-danger"></p>
		</div>
	</div>
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