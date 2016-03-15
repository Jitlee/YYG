<?php
namespace Home\Model;


class VerifycodeModel extends BaseModel{
   
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
	
   public function Insert($mobile,$code)
	{ 
		$rd = array('status'=>-1);	 			
		$data = array();		 
		$data["mobile"] = $mobile;
		$data["code"] = $code;
		$data["codestatus"] = 0;
		$data["createTime"] = date('Y-m-d H:i:s');	    
	    if($this->checkEmpty($data,true)){
			$m = M('verifycode');
			$rs = $m->add($data);
		    if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	}
	//http://localhost:505/index.php/M/Verifycode/Check/mobile/18617097726/code/7843
	public function Check($mobile,$code)
	{
		$sql="select * from yyg_verifycode
where mobile='$mobile' and createTime > date_add(now(),interval -50 minute) and `code`='$code'  and codestatus=0
order by createTime desc limit 1 ";

		$rd = array('status'=>-1);
		$num= M()->query($sql);
 		if($num) {
 			$id=(int)$num[0]["codeid"];
			if($id>0)
			{
				$m = M('verifycode');
				$data["codestatus"] = 1;
				$m->where("codeid=".$id)->save($data);				 
				$rd['status']= 1;
			}
		}
		return $rd;
	}
	
	public function test()
	{
		echo "test";
		
	}
   
}