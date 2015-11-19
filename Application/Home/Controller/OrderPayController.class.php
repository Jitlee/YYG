<?php
namespace Home\Controller;
use Think\Controller;
 

class OrderPayController extends Controller {
	
public function Pay(){
    	$this->assign('title', '支付');
		//$this->assign('pid', 'miaosha');
        $this->display();
}	

public function GetCharge()
{
	//\Lib\Pingpp\Pingpp::setApiKey('sk_test_48SSW5e1GqDKv9qnP8vLevLC');
	
	//$qqobj=    new \Lib\Login\C();//::retrieve();
	
	\Lib\Pingpp\Pingpp::setApiKey('sk_test_48SSW5e1GqDKv9qnP8vLevLC');
	try {
	    $ch = \Lib\Pingpp\Charge::create(
	        array(
	            'subject'   => 'Your Subject',
	            'body'      => 'Your Body',
	            'amount'    => $amount,
	            'order_no'  => $orderNo,
	            'currency'  => 'cny',
	            'extra'     => $extra,
	            'channel'   => $channel,
	            'client_ip' => $_SERVER['REMOTE_ADDR'],
	            'app'       => array('id' => 'app_5K8yzLfvnT4Gaj1S')
	        )
	    );	     
		$this->ajaxReturn($ch, 'JSON');
	} catch (\Lib\Pingpp\Error\Base $e) {
	    header('Status: ' . $e->getHttpStatus());
		$this->ajaxReturn($e->getHttpBody(), 'JSON');
	}
		
}

}
	