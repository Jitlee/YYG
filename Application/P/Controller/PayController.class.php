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
	
	public function index($payid){
		if(is_login()) {
			parent::index($payid);
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
	
	public function notify()
	{
		layout(false);
		$message=$_POST["message"];
		$signature=$_POST["signature"];
		
		vendor('jubaopay.jubaopay');
		$jubaopay=new \jubaopay('jubaopay.ini');
		$jubaopay->decrypt($message);
		// 校验签名，然后进行业务处理
		$result=$jubaopay->verify($signature);
		if($result==1) {
		   // 得到解密的结果后，进行业务处理
		   $payid=$jubaopay->getEncrypt("payid");
		   $state=$jubaopay->getEncrypt("state");
		   $amount=$jubaopay->getEncrypt("amount");
		   $orderNo=$jubaopay->getEncrypt("orderNo");
		   $result="payid=	$payid	state=$state 	
amount=$amount	orderNo=$orderNo ";
		   if($state == '2')//成功 充值
			{
	   			$db = M('account');
				$data = $db->find($payid);
				if($data)
				{
					$status=(int)$data["status"];
					$type=(int)$data["type"];
					$uid=$data["uid"];
					$third=floatval($data["third"]);
					if($status==0)
					{
						if($type==30 || $type==31)//充值
						{
							$udb = M('member');
							$member = array('money'		=> array('exp', '`money` + '.$third));
							if($udb->where(array('uid'	=> $uid))->save($member) == FALSE) {
								//return 404; // 扣除个人余额失败
								logger('*************失败*************');
							}
							else
							{
								$data["status"]=1;
								if($db->where(array('payid'	=> $payid))->save($data) == FALSE) 
								{
									
								}
							}
						}
						else if($type==1 || $type==11)//一元购物
						{
							$this->pay($payid);
						}		
					}
				}
			}
			else//失败
			{
			   		
			}		   
		    logger($result);
			echo "success"; 	//向服务返回 "success"
		}
	}
	public function back()
	{
		$message=$_GET["message"];
		$signature=$_GET["signature"];
		
		vendor('jubaopay.jubaopay');
		$jubaopay=new \jubaopay('jubaopay.ini');
		$jubaopay->decrypt($message);
		// 校验签名，然后进行业务处理
		$result=$jubaopay->verify($signature);
		if($result==1) {
		   // 得到解密的结果后，进行业务处理
		   $payid=$jubaopay->getEncrypt("payid");
		   $state=$jubaopay->getEncrypt("state");
//		   $amount=$jubaopay->getEncrypt("amount");
//		   $orderNo=$jubaopay->getEncrypt("orderNo");
				$db = M('account');
				$data = $db->find($payid);
				if($data)
				{
					$status=(int)$data["status"];
					$type=(int)$data["type"];
				}
				
			    if($state == '2')//成功
				{
				   	$this->display("success");
				}
				else//失败
				{
				  	$this->display("error");
				}
		}
	}
	
	public function paypc()
	{
		layout(false);
		$this->display();
	}
	
	
}