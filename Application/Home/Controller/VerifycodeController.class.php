<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;

class VerifycodeController extends Controller {

	public function Send($mobile)
	{
		//$appId = "xxxx";
//$to = "18612345678";
//$templateId = "1";
//$param="test,1256,3";

//echo $ucpass->templateSMS($appId,$to,$templateId,$param);
	
//		$mcode = D('Home/Verifycode');
//		$rs=$mcode->Send($mobile);
//		
//		echo  dump($rs);






		$options['accountsid']='518e36828e6e1f087b8ffe24f1b03f43';
		$options['token']='xxxx';
		//初始化 $options必填
		$ucpass = new Ucpaas($options);


		$appId = "683db6ebec8247d18897833d97cfce07";
		$to = "18612345678";
		$templateId = "21529";
		$param="1234";

		cho $ucpass->templateSMS($appId,$to,$templateId,$param);




		$this->display();
	}
	
	
	public function Check($mobile,$code)
	{
		$rs = array('status'=>-1); 
		$mcode = D('Home/Verifycode');
		$rs=$mcode->Check($mobile,$code);
		$status= (int)$rs["status"];
		if($status == 1)
		{
			$rs['status']= 1;
		}	 
		//$this->ajaxReturn($rs);
		echo dump($rs);
		echo $rs;
	}


}