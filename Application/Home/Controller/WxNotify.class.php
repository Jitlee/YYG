<?php
namespace Home\Controller;
use Think\Controller;
 
class WxNotify
{
	
	/*订单成功，通知到商家*/
 	public function SendOrderNotifyToShops($orderid) {
		logger("orderid=$orderid\n");
		$wxm= new WxUserInfo();
		$m = D('M/Orders');		 
		$obj = $m->orderDetailForNotify($orderid);
		if(!$obj)  return; 
		$openid = $obj["wxopenid"];
		//没有设置提醒		
		$ACCESS_TOKEN =$wxm->accessToken();	
		
		$createTime = $obj["createTime"];
		$totalMoney = $obj["totalMoney"];
		$orderItemData = $obj["goods"];
		$orderType=$obj["orderType"];
		$orderTypeName="";
		if($orderType=="1" || $orderType=="2"){ $orderTypeName="一元购订单"; }
		else if($orderType=="3"){ $orderTypeName="商城订单"; }
		else  { $orderTypeName="商家订单"; } 
		//$orderItemData=$goods;
		if(!empty($openid)){ 
			$this->OrderToShops($ACCESS_TOKEN, $openid, $orderid, $orderTypeName, $totalMoney,$orderItemData);
		}
		$openid = $obj["wxopenid1"];
		if(!empty($openid)){ 
			$this->OrderToShops($ACCESS_TOKEN, $openid, $orderid, $orderTypeName, $totalMoney,$orderItemData);
		}
		$openid = $obj["wxopenid2"];
		if(!empty($openid)){ 
			$this->OrderToShops($ACCESS_TOKEN, $openid, $orderid, $orderTypeName, $totalMoney,$orderItemData);
		}
					
	}

public function OrderToShops($ACCESS_TOKEN, $openid, $orderid, $orderTypeName, $totalMoney, $orderItemData) {
	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$ACCESS_TOKEN";
	$json='
{
	"touser":"'.$openid.'",
	"template_id":"JsODEGXf-FzqYgRddUCbgMmTDHG8htzE0uKDFKhC6xA",
	"url":"http://www.cukayun.cn/index.php/M/Orders/detail.html?id='.$orderid.'",
	"topcolor":"#FF0000",
	"data":{
		"orderType": {
			"value":"'.$orderTypeName.'",
			"color":"#173177"
		},
		"tradeDateTime":{
			"value":"'.date('Y年m月d日 H时i分').'",
			"color":"#173177"
		},
		"customerInfo":{
			"value":"订单金额'.$totalMoney.'元",
			"color":"#173177"
		},
		"orderItemName":{
			"value":"商品信息",
			"color":"#173177"
		},
		"orderItemData":{
			"value":"'.$orderItemData.'",
			"color":"#173177"
		},
		"remark":{
			"value":"",
			"color":"#173177"
		}
	}
}
		';
		
		$result=	$this->postData($url, $json);
		return $result;
}

public function KJNotify($username, $openid, $mobile, $goodsname) {		
		$wxm= new WxUserInfo();		
		$ACCESS_TOKEN =$wxm->accessToken();	
		
	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$ACCESS_TOKEN";
	$json='
{
	"touser":"'.$openid.'",
	"template_id":"Qsa596C8aYhg5zTeYnoVp8F83WrlHIYziiHbcSnjv3Y",
	"url":"http://yiyigw.cn/index.php/Home",
	"topcolor":"#FF0000",
	"data":{
		"first": {
			"value":"恭喜你参与的砍价活动完成！",
			"color":"#173177"
		},
		"keyword1":{
			"value":"'.$username.'",
			"color":"#173177"
		},
		"keyword2":{
			"value":"'.$mobile.'",
			"color":"#173177"
		},
		"keyword3":{
			"value":"",
			"color":"#173177"
		},
		"keyword4":{
			"value":"",
			"color":"#173177"
		},
		"keyword5":{
			"value":"'.$goodsname.'",
			"color":"#173177"
		},		
		"remark":{
			"value":"恭喜您获得：'.$goodsname.',系统将于48小时内自动发放奖品。",
			"color":"#173177"
		}
	}
}
		';
		 
		
		$result=	$this->postData($url, $json);
		return $result;
}
	
	function postData($url, $data){
	    $ch = curl_init();
	    $timeout = 300;
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	    //下面这句是绕过SSL验证
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	    $handles = curl_exec($ch);
	    curl_close($ch);
	    return $handles;
	}
	
	
		
}
	