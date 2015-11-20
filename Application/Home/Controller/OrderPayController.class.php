<?php
namespace Home\Controller;
use Think\Controller;
use Pingpp\Pingpp;

class OrderPayController extends Controller {
	
public function Pay(){
    	$this->assign('title', '支付');
		//$this->assign('pid', 'miaosha');
        $this->display();
}	

public function GetCharge()
{
	Pingpp::setApiKey('sk_test_48SSW5e1GqDKv9qnP8vLevLC');
	try {
		$orderNo="OY00001";
		$amount=0.01;
	    $ch = \Pingpp\Charge::create(
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
	} catch (\Pingpp\Error\Base $e) {
	    header('Status: ' . $e->getHttpStatus());
		$this->ajaxReturn($e->getHttpBody(), 'JSON');
	}
		
}

}
	