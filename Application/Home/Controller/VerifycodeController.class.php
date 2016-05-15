<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;

class VerifycodeController extends Controller {

	public function Send($mobile)
	{
		$rs= array("status" => -1);
		
		$db = M('member');
		$f['mobile'] = $mobile;
		$records = $db->where($f)->find();
		if($records)
		{
			if($records['mobilecode']!='1111')
			{
				$result["msg"]='手机号已经注册。';
				$rs["msg"]="手机号已注册.";	
	 
				$this->ajaxReturn($rs);
				return;		
			}				 
		}
		
		$mcode = D('Home/Verifycode');
		$rs=$mcode->Send($mobile);	 
		$this->ajaxReturn($rs);
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
		$this->ajaxReturn($rs);
//		echo dump($rs);
//		echo $rs;
	}


}