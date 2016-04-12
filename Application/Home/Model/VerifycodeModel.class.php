<?php
namespace Home\Model;


class VerifycodeModel extends BaseModel{
	
	public function Send($mobile)
	{
//		echo 'ttt';
//		echo $mobile;  
		$code=rand(1010,9797);
		$rs=$this->Insert($mobile,$code);
		$status= (int)$rs["status"];
		//echo dump($rs);
		if($status == 1)
		{
			$rs=$this->SendMsg($mobile,$code);
			$status= (int)$rs["status"];
			if($status == 0)
			{
				$rs['status']= 1;				
			}
		}
		return $rs;
	}
	
	 
	public function SendMsg($mobile,$code)
	{
		$rs= array("status" => -1);
		
		$options['accountsid']=C('MSG.accountsid');		
		$options['token']=C('MSG.token');		
		//初始化 $options必填
		$ucpass = new Ucpaas($options);
		$appId = C('MSG.appId');		
		$to = $mobile;
		$templateId = C('MSG.templateId');
		$param=$code;

	 	$result=$ucpass->templateSMS($appId,$to,$templateId,$param);
		//echo dump($result);
		$r=json_decode($result,TRUE);
		if($r)
		{
			$code=$r["resp"]["respCode"];
			if($code=='000000')
			{
				$rs["status"]=0;
			}
			else
			{
				//echo dump($r);
				$rs["msg"]="发送失败.".$code;
			}
		}
		return $rs;
	}

	 
	public function Insert($mobile,$code)
	{ 
		$rd = array('status'=>-1);	 			
		$data = array();		 
		$data["mobile"] = $mobile;
		$data["code"] = $code;
		$data["codestatus"] = 0;
		$data["createTime"] = date('Y-m-d H:i:s');	    
	    //if($this->checkEmpty($data,true)){
			$m = M('verifycode');
			$rs = $m->add($data);
		    if(false !== $rs){
				$rd['status']= 1;
			}
			else
			{
				$rd['msg']= "发送失败Er:001";
			}
		//}
		return $rd;
	}
	
	 
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
	
   
}