<?php
namespace Admin\Controller;
use Think\Controller;

class MsgSendController extends Controller {
    	
    public function index(){
		$msg=D("Admin/Message");
		$model=M("message");
			
		$rd=array("status"=>-1);	
		$isend=0;
		$num=0;
		$SuNum=0;
		$errmsg="";
		while($isend==0)
		{
			$res=$msg->getSendmsg();
			
			$num=$num+1;
			 
			if($res)	
			{				 
				$obj["status"]=10;	// 发送中
				$obj=$res[0];
				$model->save($obj);
				
				
				$rd["status"]=1;		
				//发送短信，并更新状态			 
				$par1=$obj["par1"];
				$par2=$obj["par2"];
				$mobile=$obj["mobile"];
				$msgtype=$obj["msgtype"];
				
				$msgyzx = D("Home/Verifycode");
				if($msgtype=='zjdx')
				{
					$rsmsg=$msgyzx->SendZJ($mobile,$par1,$par2);
					$errmsg=$errmsg."中奖手机号码：$mobile 参数：$par1 参数2:$par2\n";;
				}
				else if($msgtype=='hd')
				{
					$rsmsg=$msgyzx->SendXC($mobile,$par1,$par2);
					$errmsg=$errmsg."活动手机号码：$mobile 参数：$par1 参数2:$par2\n";
				}
				if($rsmsg["status"] !=0)	
				{
					$obj["status"]=1;
					$obj["errormsg"] = $rsmsg["msg"];	
					$errmsg=$errmsg."【$mobile】".$rsmsg["msg"];
				}
				else
				{
					$SuNum= $SuNum+1;
					$obj["status"]=99;
				}
				$model->save($obj);
			}
			else
			{
				$rd["status"]=0;
				$isend=1;
			}
			if($num >100)
			{
				$isend=1;
			}
		}
 		 
 		$result="发送成功：$SuNum 条。\n错误信息：$errmsg";
 		header('Content-Type:application/json; charset=utf-8');
		$rd["msg"]=$result;
		$this->ajaxReturn($rd,"JSON");    
//		$this->display();
    }
	
 
}