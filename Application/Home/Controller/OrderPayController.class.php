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
		//sourceType":"recharge
		$sourceType=$params->sourceType;
		if($sourceType=="recharge")
		{
			$result["status"]=0;
			$result["msg"]="操作成功。";
			if(is_login()) {
				//$db = M('member_addmoney_record');
				
				$db = M('member_addmoney_record');
				$data = array(
					'uid'		=>session("_uid"),
					'code'		=>$orderNo,
					'money'		=>$amount,
					'pay_type'	=>$channel,
					'status'	=>0,
					'time'		=>time()
				);

				if($db->add($data) != false) {		
					//$result["status"]=1;
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
                $extra = array(
                	'success_url' => 'http://' . $_SERVER['HTTP_HOST'] . U('thirdpaysuccess', '', '')
                	, 'cancel_url' => 'http://' . $_SERVER['HTTP_HOST'] . U('cancel', '', '')
				);
					
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
	
	
	// 第三方支付成功页面
	public function thirdpaysuccess() {
		layout(false);
		$tradeNo = I('request.out_trade_no');
		$result = I('request.result');
		if($result != 'success') {
			$this->assign('status', 18);
			$this->display('error');	
		} else if($tradeNo == session('_trade_no_') && session("?" . $tradeNo)) {
			session('_trade_no_', null);
			$_pay = session($tradeNo);
			$status = $this->pay(false, $_pay);
			if($status == 0) {
				$this->display('success');	
			} else { // TODO: 失败了没有机制
				$this->assign('status', $status);
				$this->display('error');	
			}
			session($tradeNo, null);
		} else {
			$this->assign('status', 19);
			$this->display('error');	
		}
	}
	
	public function success() {
		layout(false);
		$this->display();
	}
	
	public function cancel() {
		layout(false);
		$this->display();
	}
	
	public function error() {
		layout(false);
		$this->display();
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
	