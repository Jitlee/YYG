<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title>支付异常</title>
	</head>
	<body>
		<h4>支付出现异常(错误代码：<?php echo ($status); ?>)</h4>
		<script>
			window.setTimeout(function() {
				window.location.href = "<?php echo U('Index/index', '','');?>";
			}, 2000);
		</script>
	</body>
</html>