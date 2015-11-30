<?php
namespace Home\Controller;
use Think\Controller;

 
class OrderPayController extends Controller {
		
	public function _initialize()
	{
	 	vendor( "PingppSDK.init");
	}
	
	public function Index(){
			
		$params = json_decode(file_get_contents('php://input'));
		if(empty($params->amount) || empty($params->channel)) {
			 echo $params->amount;
			 exit();
		}
		
		$amount = $params->amount;
		$channel = $params->channel;
		 
        $orderNo = substr(md5(time()), 0, 12);
		
		$sourceType=$params->sourceType;
		if($sourceType=="recharge")
		{
			$result["status"]=0;
			$result["msg"]="操作成功。";
			if(is_login()) {
				$db = D('member_addmoney_record');
				$data["uid"] 		=session("_uid");
				$data["code"] 		=$orderNo;
				$data["money"] 		=$amount;
				$data["pay_type"] 	=$channel;
				$data["status"] 	=0;
				$data["time"] 		=date('y-m-d-h-i-s'); 
				$db->create();
				if($db->add() != false) {
					$result["status"]=1;
				} 
				else 
				{
					$result["msg"]='保存订单失败。';
					exit;
				}
			}
			else 
			{
				$result["msg"]='没有登录。';
				exit;
			}
		}
		
	
        //$extra 在使用某些渠道的时候，需要填入相应的参数，其它渠道则是 array() .具体见以下代码或者官网中的文档。其他渠道时可以传空值也可以不传。
        $extra = array();
        switch ($channel) {
            case 'alipay_wap' :
                $extra = array('success_url' => 'http://www.yourdomain.com/success', 'cancel_url' => 'http://www.yourdomain.com/cancel');
                break;
            case 'upmp_wap' :
                $extra = array('result_url' => 'http://www.yourdomain.com/result?code=');
                break;
            case 'bfb_wap' :
                $extra = array('result_url' => 'http://www.yourdomain.com/result?code=', 'bfb_login' => true);
                break;
            case 'upacp_wap' :
                $extra = array('result_url' => 'http://www.yourdomain.com/result');
                break;
            case 'wx_pub' :
                $extra = array('open_id' => 'Openid');
                break;
            case 'wx_pub_qr' :
                $extra = array('product_id' => 'Productid');
                break;
            case 'yeepay_wap' :
                $extra = array('product_category' => '1', 'identity_id' => 'your identity_id', 'identity_type' => 1, 'terminal_type' => 1, 'terminal_id' => 'your terminal_id', 'user_ua' => 'your user_ua', 'result_url' => 'http://www.yourdomain.com/result');
                break;
            case 'jdpay_wap' :
                $extra = array('success_url' => 'http://www.yourdomain.com', 'fail_url' => 'http://www.yourdomain.com', 'token' => 'dsafadsfasdfadsjuyhfnhujkijunhaf');
                break;
        }
		
		//Vendor('PingppSDK.init');
        \Pingpp\Pingpp::setApiKey('sk_test_48SSW5e1GqDKv9qnP8vLevLC');
        try {
			$ch = \Pingpp\Charge::create(array('subject' => 'Your Subject', 'body' => 'Your Body', 'amount' => $amount, 'order_no' => $orderNo, 'currency' => 'cny', 'extra' => $extra, 'channel' => $channel,
             'client_ip' => get_client_ip(), 'app' => array('id' => 'app_5K8yzLfvnT4Gaj1S')));
             echo $ch;
			 exit; 
        } catch (\Pingpp\Error\Base $e) {
             //header('Status: ' . $e->getHttpStatus());
            header("Content-type:text/html;charset=utf-8");
            echo($e->getHttpBody());
        }
    
	}
	
	
public function demo(){
    	$this->assign('title', '支付');
		//$this->assign('pid', 'miaosha');
		$arr=range(1,10000);
		shuffle($arr);
		$slides["rderNo"]='OY00001' . $arr[0];
		$this->assign('data', $slides);
		
        $this->display();
}


}
	