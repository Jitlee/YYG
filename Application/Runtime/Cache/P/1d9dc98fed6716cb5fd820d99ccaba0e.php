<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="format-detection" content="telephone=no">
		<title>支付成功</title>	
	</head>
	<body>
		<h4>恭喜支付成功</h4>
		<?php echo ($orderno); ?>
		<br />
		<?php echo ($status); ?>
		<script>
			window.setTimeout(function() {
				window.location.href = "<?php echo U('Home/index', '','');?>";
			}, 5000);
		</script>
	</body>
</html>