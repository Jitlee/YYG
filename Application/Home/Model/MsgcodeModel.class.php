<?php
namespace Home\Model;


class MsgcodeModel extends BaseModel{
   
   public function SendVerycode($mobile,$content)
	{
		$data = array(
			"userAccount"=>"10000"
			,"mobile"=>$mobile
			,"content"=>$content
		);
		
		$url='OpenApi/SendSms';		
		return $this->GetData($url, $data);
	}
	
	
	function GetData($url,$data)
	{
		$OpenId  ="5BC3C691C69C43D1BA1C6420C51F60C5";//32位OpenId，大写
        $Secret  ="7G0CL7";                          //6位Secret，大写	 
	    $TimeStamp=time();
		 		 
        $data = json_encode($data);
        $Signature = strtoupper(md5($OpenId.$Secret.$TimeStamp.$data)); //MD5加密后的字符串，大写
        $urlroot="https://openapi.1card1.cn/";
		//https://openapi.1card1.cn/OpenApi/Get_MemberInfo?openId=[OpenId]&signature=[Signature]&timestamp=[TimeStamp]
        $_url = $urlroot.$url."?openId=".$OpenId."&signature=".$Signature."&timestamp=".$TimeStamp;
		//echo $_url; 
        //postData：该参数post到指定Url，注意postData与data 的区别
        $postData = "data=".$data;
        $json_data =$this->postData($_url, $postData);
		$array = json_decode($json_data,true);
		
		return $array;
	}
	
	//lib/api.php 里面的方法是：
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