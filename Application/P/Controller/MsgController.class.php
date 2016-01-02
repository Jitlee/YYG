<?php
namespace P\Controller;
use Think\Controller;
use P\Model;

class MsgController extends Controller {
	public function UserReg()
	{
		$result["status"]=0;
		$result["msg"]="登录成功。";
		
		$checkmobile=$_POST['mobile'];
		if($checkmobile != session('registerMobile'))
		{
			$result["msg"]='非法操作,请刷新重试。';
		}
		else
		{
			$result["status"]=1;
			session("UserRegMobileCode","1234");
		}	
	}

}