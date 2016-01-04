<?php
namespace Home\Controller;
use Think\Controller;

 
class Card1Controller extends Controller {
	
 
 	public function Get_CitiesByProvince(){
 		$provinces=$_POST["provinces"];
		$db = M('add');
		$filter["addparent"] = $provinces;
		$filter["addtype"] = 1;
		$data= $db->where($filter)->select();		
		$this->ajaxReturn($data,'JSON');
    }
	public function Get_CountyByCity(){
 		$cityid=$_POST["city"];
		$db = M('add');
		$filter["addparent"] = $cityid;
		$filter["addtype"] = 2;
		$data= $db->where($filter)->select();		
		$this->ajaxReturn($data,'JSON');
    }
	
	function GetData($url,$data)
	{
		$OpenId  ="5BC3C691C69C43D1BA1C6420C51F60C5";//32位OpenId，大写
        $Secret  ="7G0CL7";                          //6位Secret，大写	 
	    $TimeStamp=time();	
        $data = json_encode($data);
        $Signature = strtoupper(md5($OpenId.$Secret.$TimeStamp.$data)); //MD5加密后的字符串，大写
        $_url = $url."?openId=".$OpenId."&signature=".$Signature."&timestamp=".$TimeStamp;
        $postData = "data=".$data;                         //postData：该参数post到指定Url，注意postData与data 的区别
        $json_data =$this->postData($_url, $postData);
		$array = json_decode($json_data,true);
		
		return $array;
	}
	
	//lib/api.php 里面的方法是：
	function postData($url, $data){
	    $ch = curl_init();
	    $timeout = 300;
	    curl_setopt($ch, CURLOPT_URL, $url);
	    //curl_setopt($ch, CURLOPT_REFERER, "http://www.jb51.net/");   //构造来路
	    //curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	    //下面这句是绕过SSL验证，http://www.jb51.net/article/29282.htm，不然有些机器无法获得返回数据
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	    $handles = curl_exec($ch);
	    curl_close($ch);
	    return $handles;
	}


}