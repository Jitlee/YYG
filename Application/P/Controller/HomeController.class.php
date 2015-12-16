<?php
namespace P\Controller;
use Think\Controller;
class HomeController extends Controller {
	protected function _initialize() {
		if(!is_login()) {
			$this->redirect('Main/login');
			return;
		}
	}
		
	public function index(){		
    	$this->assign('title', '一元购');
		$Model = M('member');
		$filter['uid'] = session("_uid");		
		$userinfo =$Model->where($filter)->find();
		$userinfo['sstatus']=0;
		if (!ereg('^http://', $userinfo['img'])) 
		{
			$userinfo['sstatus']=1;
		}
		$this->assign('data', $userinfo);
		$this->display();
    }
	/*******我的云购********/
	public function userbuylist(){		
    	$this->assign('title', '一元购');
		$this->display();
    }
	public function pageAllMR($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha');
		$filter['yyg_member_miaosha.uid'] = session("_uid");
		
		
		$list =$Model
		->join(" yyg_member_miaosha ON yyg_member_miaosha.gid=yyg_miaosha.gid")			
		->where($filter)
		->page($pageNum, $pageSize)
		->group('title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid')
		->field("title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid")
		->select();
			
		$this->ajaxReturn($list, "JSON");
	}
	/*	中奖记录	*/
	public function orderlist(){		
    	$this->assign('title', '一元购');
		$this->display();
    }
	public function pageAllzj($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		
		
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function singleinsert(){		
    	$this->assign('title', '晒单');
		$this->display();
    }
	public function singlelist(){		
    	$this->assign('title', '晒单列表');
		$this->display();
    }
	public function pageAllsdno($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		 
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function pageAllsdfinish($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		
		
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	
	/*******end我的云购********/
	/*******邀请管理********/
	public function invitefriends(){		
    	$this->assign('title', '一元购');
		$this->display();
    }
	
	public function commissions(){		
    	$this->assign('title', '一元购');
		$this->display();
    }
	
	public function cashout(){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
			
			$udb = M('member');
			$menberfilter["uid"]=session("_uid");
			$dbmember = $udb->where($menberfilter)->find();
			if(!$dbmember) {
				$result["msg"]='用户不存在。';
			}
			else
			{
				//1. 扣减member数据  2. 写入钱包记录  3  写入提现记录	手费费				
				$outMoney= floatval($_POST["money"]);			
				$UserMoney=floatval($dbmember['money']);
				//验证余额	
				if($outMoney > $UserMoney)
				{
					$result["msg"]="余额不足。".$dbmember['money'];				
				}
				else
				{
					//1. 扣减member数据 					
					if($dbmember)
					{
						$eMoney=$UserMoney-$outMoney;
						$dbmember['money'] = $eMoney;
						//$dbmember['money']=60;//$dbmember['money']-$addMoney;
						$udb->save($dbmember);					
					}
					
					//3  写入提现记录
					$dbcash = M('member_cashout');
					$_POST['uid']=  session("_uid");
					$_POST['time']= date('y-m-d-h-i-s');
					$dbcash->create();
					if($dbcash->add() != false) {
						$result["status"]=1;
					} 
					else 
					{
						$result["msg"]='数据错误';
					} 
				}
			} 
		
			$this->ajaxReturn($result, "JSON");
		}
		else
		{		
	    	$this->assign('title', '一元购');
	    	$data=session('wxUserinfo');
			$this->assign("data", $data);
			$this->display();
		}
    }
	
	public function record(){		
    	$this->assign('title', '提现记录');
		$this->display();
    }
	public function GetCashoutlist($pageSize, $pageNum)
	{
		$Model = M('member_cashout');
		$filter['uid'] = session("_uid");		
		$list =$Model					
			->where($filter)
			->page($pageNum, $pageSize)
			->select();
		return $list;
	}
	public function pagecashoutlist()
	{
		$list=$this->GetCashoutlist($pageSize,$pageNum);
		$this->ajaxReturn($list, "JSON");
	}
	/*******end邀请管理********/
	
	/*******账户管理********/
	public function userbalance(){		
    	$this->assign('title', '一元购');
    	$data=session('wxUserinfo');
		$this->assign("data", $data);
		$this->display();
    }
    //充值记录分页
	public function pageAllRechargerecord($pageSize, $pageNum) {
		// 分页
		$list=$this->GetRecord($pageSize,$pageNum);
		$this->ajaxReturn($list, "JSON");
	}
    public function GetRecord($pageSize, $pageNum)
	{
		$Model = M('member_addmoney_record');
		$filter['uid'] = session("_uid");
		
		$list =$Model					
		->where($filter)
		->page($pageNum, $pageSize)
		->select();
		return $list;
	}
	
	public function userrecharge(){		
    	$this->assign('title', '一元购');
		$this->display();
    }
	/*******end账户管理********/
	public function userscore(){		
    	$this->assign('title', '一元购');
		$data=session('wxUserinfo');
		$this->assign("data", $data);
		$scoremoney=$data.score/100;
		$this->assign("scoremoney", $scoremoney);
		$this->display();
    }
		
	public function Getscorelist($pageSize, $pageNum)
	{
		$Model = M('member_score');
		$filter['uid'] = session("_uid");		
		$list =$Model					
		->where($filter)
		->page($pageNum, $pageSize)
		->select();
		return $list;
	}
	public function pagescore()
	{
		$list=$this->Getscorelist($pageSize,$pageNum);
		$this->ajaxReturn($list, "JSON");
	}
	
	public function address(){		
    	if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
			$db=M("member_dizhi");
			$data['uid'] = session("_uid");
			$add = $db->where($data)->find();
			if(!$add) {				
				$_POST['uid']=  session("_uid");
				$db->create();
				if($db->add() != false) {
					$result["status"]=1;
				} 
				else 
				{
					$result["msg"]='数据错误';
				}
			}
			else
			{
				//$db->save($_POST);
				$add["sheng"]=$_POST['sheng'];
				$add["shi"]=$_POST['shi'];
				$add["xian"]=$_POST['xian'];
				$add["jiedao"]=$_POST['jiedao'];
				$add["youbian"]=$_POST['youbian'];
				$add["shouhuoren"]=$_POST['shouhuoren'];
				$add["mobile"]=$_POST['mobile'];
				$add["time"]=time();
								 
				$db->save($add);
				$result["status"]=1;
			}
			$this->ajaxReturn($result, "JSON");
		}
		else
		{
			$data['uid'] = session("_uid");
			$db=M("member_dizhi");
			$add = $db->where($data)->find();			 
			$this->assign("data", $add);
			$this->display();
		}
    }	
	
	public function modify(){		
    	if(IS_POST) {
			$db = M('member');
			$data['uid'] = session("_uid");
			$user = $db->where($data)->find();
			$result["status"]=0;
			$result["msg"]="操作成功。";
			if($user)
			{
				$user["username"]	=$_POST['username'];
				$user["qianming"]	=$_POST['qianming'];
				if($db->save($user) != false) {					
					$result["status"]=1;
					session('wxUserinfo', $user);
				} 
				else 
				{
					$result["msg"]='保存失败。';
				}
			}
			else
			{
				$result["msg"]="用户不存在。";
			}
			$this->ajaxReturn($result);		
		}
		else
		{
			layout(true);
			$data=session('wxUserinfo');
			$this->assign("data", $data);
			$this->display();
		}
    }
		
	public function mypage(){		
    	$this->assign('title', '一元购');
		$this->display();
    }	
	public function userphoto(){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
			$db = M('member');
			$data['uid'] = session("_uid");
			$user = $db->where($data)->find();
			if(!$user) {
				$result["msg"]='用户不存在。';
			}
			$user["img"]=$_POST['membimg'];
			$db->save($user);
			$result["status"]=1;
			session('wxUserinfo', $user);
			$this->ajaxReturn($result, "JSON");
		}
		else
		{
			layout(true);
			$data=session('wxUserinfo');
			$this->assign("data", $data);
			$this->display();
		}
	}
	public function mobilechecking(){		
    	$this->assign('title', '一元购');
		$this->display();
    }	
	
		
		
		
}
	