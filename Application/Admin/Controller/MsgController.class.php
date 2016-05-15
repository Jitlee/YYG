<?php
namespace Admin\Controller;
use Think\Controller;
class MsgController extends CommonController {
    	
    public function indexsend(){
		$msg=D("Admin/Message");
		$model=M("message");
			
		$rd=array("status"=>-1);	
		$isend=0;
		$num=0;
		while($isend=1)
		{
			$res=$msg->getSendmsg();
			$num=$num+1;		
			if($res)	
			{
				$rd["status"]=10;	// 发送中
				$model->save($obj);
				
				$obj=$res[0];
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
				}
				else if($msgtype=='hd')
				{
					$rsmsg=$msgyzx->SendXC($mobile,$par1,$par2);
				}				
				if($rsmsg["status"] !=0)	
				{
					$obj["status"]=1;
					$obj["errormsg"] = $rsmsg["msg"];	
				}
				else
				{
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
		//echo dump($rd);    
//		$this->display();
		$this->ajaxReturn($rd,"JSON");    
    }
	
	public function msgxc(){
		$this->assign('pid', 'sysmgr');
		$this->assign('mid', 'messageindex');
		$this->display();
	}
	
	public function xc(){
		$rd=array("status"=>-1);	
		$msg = M('message');
		
		$mobiles=$_POST["mobiles"];
		$par1=$_POST["par2"];
		$par2=$_POST["par2"];
		
		$allmsg="";
		$snum=0;
		$arr = explode(";",$mobiles);
		foreach($arr as $m){
			$mlen=strlen($m);
			if($mlen==11)
			{
				$datamsg["par1"] = $par1;
				$datamsg["par2"] = $par2;
				$datamsg["mobile"] = $m; 
				$datamsg["msgtype"] = "hd";		
				$datamsg["msgtime"] = date('Y-m-d H:i:s');
				$datamsg["status"] = 0;
				//写入发送短信
				
				$rs =$msg->add($datamsg);
				if($rs != FALSE)
				{
					$snum=$snum+1;
					 //$allmsg=$allmsg.$m ."提交成功.<br/>";
				}
			}
			else
			{
				$allmsg=$allmsg.$m ."提交失败,长度$mlen.<br/>";
			}		
		}		
		
 		$this->assign('pid', 'sysmgr');
		$this->assign('mid', 'messagelist');
		$this->assign('msg', $allmsg);
		$this->assign('datanum', $snum);
		
		 //$this->ajaxReturn($rd,"JSON");
		 $this->display("xc");
	}
	
	public function msglist()
	{
		$Model = M('message');
		$list =$Model
		//->where($filter)
		->page($pageNum, $pageSize)				
		->order(" msgtime  desc")
		->select(); 
		
		$this->assign('data',$list);
		
		 
		$this->assign('title', '短信发送列表');
		$this->assign('pid', 'sysmgr');
		$this->assign('mid', 'messagelist');
		$this->display("list");
	}
	
}