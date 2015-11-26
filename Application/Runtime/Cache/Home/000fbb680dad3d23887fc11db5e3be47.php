<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>支付成功</title>
	</head>
	<body>
		恭喜支付成功
		<script>
			window.setTimeout(function() {
				window.location.href = "<?php echo U('Index/index', '','');?>";
			}, 2000);
		</script>
	</body>
</html>