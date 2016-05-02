<?php
namespace Home\Controller;
use Think\Controller;

 
class WxUserInfo
{

	public function callback($openId) { 	
		//根据openid和access_token查询用户信息
		$access_token =$this->accessToken();// ;$json_obj['access_token'];		 
		$get_user_info_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openId.'&lang=zh_CN';
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$get_user_info_url);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		$res = curl_exec($ch);
		curl_close($ch);
		//解析json
		$user_obj = json_decode($res,true);		
		//echo dump($user_obj);		
		return $user_obj['headimgurl'];
	}

	function accessToken(){
		$tokenFile = "./access_tokenkey.txt";//缓存文件名 
		$data = json_decode(file_get_contents($tokenFile)); 
		 
		if (!$data or $data->expire_time < time()) {
			vendor('Weixinpay.WxPayJsApiPay');
			$appid =  \WxPayConfig::APPID;
			$secret = \WxPayConfig::APPSECRET;
			
			$get_token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$get_token_url);
			curl_setopt($ch,CURLOPT_HEADER,0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			$res = curl_exec($ch);
			curl_close($ch); 			
			$json_obj = json_decode($res,true);
				
			$access_token = $json_obj['access_token'];			
			if($access_token) 
			{
		        $data2['expire_time'] = time() + 7000; 
		        $data2['access_token'] = $access_token; 				 
		        $fp = fopen($tokenFile, "w+");
		        fwrite($fp, json_encode($data2));
		        fclose($fp);  
	      	}
			return $access_token;
	    }
	    else
	    {	       
	      $access_token = $data->access_token; 
	    }
	    return $access_token;
	} 
	
	
	
	/******
	 * 下面用于，微信分享
	 * ******/
 private function getJsApiTicket() {
	$ticket=S("jsapiticket");
    if (!$ticket) {
      $accessToken = $this->accessToken();
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
	  S("jsapiticket",$ticket,3600);
    } 
    return $ticket;
  }

	 
	public function getSignPackage() {
	    $jsapiTicket = $this->getJsApiTicket();
	    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    $timestamp = time();
	    $nonceStr = $this->createNonceStr();
	
	    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
	    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
	
	    $signature = sha1($string);
			
		vendor('Weixinpay.WxPayJsApiPay');
		$appid =  \WxPayConfig::APPID;
		 
	    $signPackage = array(
	      "appId"     => $appid,
	      "nonceStr"  => $nonceStr,
	      "timestamp" => $timestamp,
	      "url"       => $url,
	      "signature" => $signature,
	      "rawString" => $string
	    );
	    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }
	 
	 
	 
	 
	 
	 
	 
	 
	 
} 