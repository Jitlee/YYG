<?php

include 'jubaopay/jubaopay.php';

// 模拟创建号
function genPayId($length = 6 ) {

	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$password = "";
	for ( $i = 0; $i < $length; $i++ )
		$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];

	return $password;
}

header("Content-Type: text/html; charset=UTF-8");

$payid=genPayId(20);
$partnerid="14061642390911131749";
$amount=$_POST["amount"];
$payerName=$_POST["payerName"];
$remark=$_POST["remark"];
$returnURL="http://pay.xxx.com/result.php";    // 可在商户后台设置
$callBackURL="http://pay.xxx.com/notify.php";  // 可在商户后台设置
$payMethod=$_POST["payMethod"];
$goodsName=$_POST["goodsName"];

//////////////////////////////////////////////////////////////////////////////////////////////////
 //商户利用支付订单（payid）和商户号（mobile）进行对账查询
$jubaopay=new jubaopay('jubaopay/jubaopay.ini');
$jubaopay->setEncrypt("payid", $payid);
$jubaopay->setEncrypt("partnerid", $partnerid);
$jubaopay->setEncrypt("amount", $amount);
$jubaopay->setEncrypt("payerName", $payerName);
$jubaopay->setEncrypt("remark", $remark);
$jubaopay->setEncrypt("returnURL", $returnURL);
$jubaopay->setEncrypt("callBackURL", $callBackURL);
$jubaopay->setEncrypt("goodsName", $goodsName);

//对交易进行加密=$message并签名=$signature
$jubaopay->interpret();
$message=$jubaopay->message;
$signature=$jubaopay->signature;
//将message和signature一起aPOST到聚宝支付
?>
<form method="post" action="http://www.jubaopay.com/apiwapsyt.htm" id="payForm">
	<!-- 正式环境 action="https://www.jubaopay.com/apiwapsyt.htm" -->
	<input type="hidden" name="message" value="<?php echo $message;?>">
	<input type="hidden" name="signature" value="<?php echo $signature;?>">
</form>

<script type="text/javascript">
    document.getElementById('payForm').submit();
</script>