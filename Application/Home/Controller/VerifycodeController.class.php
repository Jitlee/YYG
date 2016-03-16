<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;

class VerifycodeController extends Controller {

	public function Send($mobile)
	{	
		$mcode = D('Home/Verifycode');
		$rs=$mcode->Send($mobile);
		
		echo  dump($rs);
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