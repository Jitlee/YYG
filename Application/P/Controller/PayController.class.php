<?php
namespace P\Controller;
/**
 * 支付界面控制器
 */
class PayController extends \Home\Controller\PayController {

	protected function _initialize() {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/Application/Runtime/Data/renci.xml';
		// check task
		if(file_exists($path)) {
			$file = fopen($path, 'r');
			$renci = fgets($file);
			fclose($file);
			$len = strlen($renci);
			for($i = 0; $i < $len; $i++) {
				$this->assign('goCountRenci'.($len - $i), $renci[$i]);
			}
		}
		
		$this->assign('serverTime', time());
		$this->assign('title', '壹元夺宝');		
		count_cart(0);
	}
	
	public function index(){
		if(is_login()) {
			parent::index();
		} else {
			$this->redirect('P/Main/login/'.encode('Pay/index', '', ''));
		}
    }
	
	public function baozhengjin($gid) {
		if(is_login()) {
			parent::baozhengjin($gid);
		} else {
			$this->redirect('P/Main/login/'.encode('Pay/baozhengjin/'.$gid, '', ''));
		}
	}
	
	
	
	// 模拟创建号
	function genPayId($length = 6 ) {
	
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$password = "";
		for ( $i = 0; $i < $length; $i++ )
			$password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
	
		return $password;
	}
	
	public function noity()
	{
		layout(false);
		$this->display();
	}
	public function back()
	{
		layout(false);
		$this->display();
	}
	public function paypc()
	{
		layout(false);
		$this->display();
	}
	
	public function jubaopay()
	{			
			vendor('jubaopay.jubaopay');
				 
			$payid=$this->genPayId(20);
			$partnerid=C("jubaopay.partnerid");//14061642390911131749";
			
			$amount=$_POST["amount"];
			$accountmoney=$_POST["accountmoney"];
			$accountscore=$_POST["accountscore"];
			$accountbgid=$_POST["accountbgid"];
			
			$goodsName=$_POST["goodsName"];
			$remark=$_POST["remark"];
			$paytype=$_POST["paytype"];
			
			

			//$orderNo = md5(time());
			$orderNo=$payid;
			session('_trade_no_', $orderNo);
			
			
			session($orderNo, array(
				'money'			=> $accountmoney,
				'third'			=> $amount,
				'score'			=> $accountscore,
				'bgid'			=> $accountbgid,
			));
			
			
			$payerName="zs001";//$_POST["payerName"];
			$returnURL=C("jubaopay.returnURL");//"http://pay.xxx.com/result.php";    // 可在商户后台设置
			$callBackURL=C("jubaopay.callBackURL");//"http://pay.xxx.com/notify.php";  // 可在商户后台设置
			$payMethod= "WANGYIN";//$_POST["payMethod"];
			
			//测试
			$amount=0.05;
			
			//////////////////////////////////////////////////////////////////////////////////////////////////
			 //商户利用支付订单（payid）和商户号（mobile）进行对账查询
			$jubaopay=new \jubaopay('jubaopay.ini');
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
		 
			$this->assign("message",$message);
			$this->assign("signature",$signature);
			$this->assign("payMethod",$payMethod);
		
			layout(false);
			if($paytype=="wap")
			{
				$this->display("jubaopaywap");
			}
			else
			{
				$this->display("jubaopaypc");
			}
			
	}
}