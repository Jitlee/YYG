<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends CommonController {
		 		
	protected function _initialize() {
		if(!is_login()) {
			$this->redirect('Public/login');
			return;
		}
	}
	
    public function index(){
    	$this->assign('title', '壹圆购物');
		$this->assign('pid', 'index');
        $this->display();
    }
	
	public function loginexit(){
    	$this->assign('title', '壹圆购物');
		$this->assign('pid', 'me');
		
		session("_uid", null); // 替换session			
		session('wxUserinfo', null);
		$this->redirect('Public/login');
    }
	
	public function me(){
    	$this->assign('title', '壹圆购物'); 
		 
		$Model = M('member');
		$filter['uid'] = session("_uid");		
		$userinfo =$Model->where($filter)->find();
		$userinfo['sstatus']=TRUE;
		if (!ereg('^http://', $userinfo['img'])) 
		{
			$userinfo['sstatus']=FALSE;
		}
		
		$this->assign('data', $userinfo);
		
		$this->display();
    }
	
	public function userinfoitem()
	{
		$this->assign('title', '用户信息');
		$this->display();
	}
	
	public function recharge()
	{
		$this->assign('title', '充值');
		$this->display();
	}
	public function rechargerecord()
	{
		$this->assign('title', '充值记录');
		$list=$this->GetRecord(20,0);
		$this->assign('data', $list);
		$this->display();
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
	//充值记录分页
	public function pageAllRechargerecord($pageSize, $pageNum) {
		// 分页
		$list=$this->GetRecord($pageSize,$pageNum);
		$this->ajaxReturn($list, "JSON");
	}
	
	public function wallet()
	{
		$Model = M('member');
		$filter['uid'] = session("_uid");		
		$userinfo =$Model->where($filter)->find();
		$this->assign('data', $userinfo);		
		
		$this->assign('title', '我的钱包');
		$this->display();
	}
	
		
	public function miaoshaRecord()
	{
		$this->assign('title', '秒杀记录');
		$this->display();
	}
	
	public function userscore()
	{
		$this->assign('title', '积分记录');
		$list=$this->Getscorelist(20,0);
		$this->assign('data', $list);
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
	
	
	public function yaoqing()
	{
		$this->assign('title', '邀请好友');
		$this->display();
	}
	
	public function yaoqingma()
	{
		$this->assign('title', '填写邀请码');
		$this->display();
	}
	
	public function yaoqingmain()
	{
		$this->assign('title', '邀请好友');
		$this->display();
	}
	
	
	public function yaoqinglist()
	{
		$this->assign('title', '邀请记录');
		$this->assign("list", $this->yaoqinglistRecord(20,1,1));
		$this->display();
	}
	
	public function yaoqinglistRecord($pageSize,$pageNum,$post=0)
	{
		$db = M('member');
		$filter['yaoqing'] = session("_uid");
		
		//$total =$db->where($filter)->count();
		//$this->SetPage($pageSize,$pageNum,$total);
		
		$list =$db					
		->where($filter)
		->page($pageNum, $pageSize)
		->select();
		if($post==0)
		{
			$this->ajaxReturn($list, "JSON");
		}
		else
		{
			return $list;
		}
	}
	public function cashout()
	{
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
//					$result["msg"]='用户不存在。'.$money.'  '.$addMoney;
//					$this->ajaxReturn($result, "JSON");
//					return;
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
			$this->assign('title', '提现');
			$this->display();
		}
	}
	
	public function cashoutlist()
	{
		$this->assign('title', '提现记录');		
		$list=$this->GetCashoutlist(20,0);
		$this->assign('data', $list);
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
	
	public function userimg(){
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
	public function useraddressview()
	{
		$db=M("member_dizhi");
		$data['uid'] = session("_uid");
		$add = $db->where($data)->find();
		$this->assign('title', '收货地址');
		layout(true);
		if($add) {
			$this->assign("data", $add);
			$this->display();
		}
		else
		{			
			$this->display("useraddress");
		}				
	}
	public function useraddress(){
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
			
			
			if($add)
			{
				$dbadd=M("add");
				$data['addname'] = $add["sheng"];
				$shengid= $dbadd->where($data)->find();				
				$add["shengid"]=$shengid["addid"];		
						
				$data['addname'] = $add["shi"];				
				$shiid=$dbadd->where($data)->find();				
				$add["shiid"]=$shiid["addid"];		
						
				$data['addname'] = $add["xian"];
				$xianid=$dbadd->where($data)->find();
				$add["xianid"]=$xianid["addid"];
	
				$dbp = M('add');
				$filter["addparent"] = $add["shengid"];
				$filter["addtype"] = 1;
				$cityarr= $dbp->where($filter)->select();	
					
				
				$dbc = M('add');
				$filter["addparent"] = $add["shiid"];
				$filter["addtype"] = 2;
				$xianarr= $dbc->where($filter)->select();
				
				$this->assign("cityarr", $cityarr);
				$this->assign("xianarr", $xianarr);	
			}
			$this->assign("data", $add);
			$this->display();
		}
	}
	public function userpwd(){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
			$db = M('member');
			$data['uid'] = session("_uid");
			$user = $db->where($data)->find();
			if(!$user) {
				$result["msg"]='用户不存在。';
			}
			else
			{
				$password= md5($_POST['txtoldpwd']);
				if(  $user['password'] != $password) {
					$result["msg"]='原密码错误。';
				}
				else
				{
					$passwordNew= md5($_POST['txtconfimpwd']);
					$user['password']=$passwordNew;
					$db->save($user);
					$result["status"]=1;
					session('wxUserinfo', null);
				}
			}
			$this->ajaxReturn($result, "JSON");
		}
		else
		{
			layout(true);
			$this->display();
		}
	}
	
	public function userinfo(){
		if(IS_POST) {
			$db = M('member');
			$data['uid'] = session("_uid");
			$user = $db->where($data)->find();
			$result["status"]=0;
			$result["msg"]="操作成功。";
			if($user)
			{						 					
				$records["mobile"]	=$_POST['mobile'];
				$records["username"]	=$_POST['username'];
				session('wxUserinfo', $records);							
				$db->save($records);						
				$result["status"]=1;
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
	
	public function pageAllMR($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha');
		$filter['yyg_member_miaosha.uid'] = session("_uid");
				
		$list =$Model
		->join(" yyg_member_miaosha ON yyg_member_miaosha.gid=yyg_miaosha.gid and yyg_member_miaosha.qishu=yyg_miaosha.qishu")	
		->where($filter)
		->page($pageNum, $pageSize)
		->group('title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid')
		->field("title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid")
		->select();
		
//		$list2 =$Model
//		->join(" yyg_miaosha_history ON yyg_miaosha_history.gid=yyg_miaosha.gid")			
//		->where($filter)
//		->page($pageNum, $pageSize)
//		->group('title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid')
//		->field("title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid")
//		->select();
		
			
		$this->ajaxReturn($list, "JSON");
	}
	
	public function miaoshazj()
	{
		$this->assign('title', '中奖记录');
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

	public function miaoshasdno()
	{
		$this->assign('title', '未晒单');
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
	
	public function miaoshasdfinish()
	{
		$this->assign('title', '已晒单');
		$this->display();
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
	
	public function VerifyCode()
	{
		$this->assign('title', '新用户注册');
		$this->display();
	}
	
	public function verify() {
		ob_end_clean();
		$config =    array(
		    'fontSize'    	=>  30,    // 验证码字体大小
		    'length'      	=>  4,     // 验证码位数
		    'useCurve'	  	=>	false, // 关闭混淆曲线
		    'useNoise'		=>  false, // 关闭验证码杂点
		    'codeSet'		=>	'0123456789',		// 除数字验证
		);
        $verify = new \Think\Verify($config);
        $verify->entry();
	}
 

}