<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends CommonController {
		 		
	protected function _initialize() {
		if(!home_is_login()) {
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
	
	public function trylogin(){
		$url= I("url");
		$this.redirect($url);
	}
	
	public function me(){
    	$this->assign('title', '壹圆购物'); 
		// echo $_SESSION['logintype'];
		 
		$Model = M('member');
		$filter['uid'] = session("_uid");		
		$userinfo =$Model->where($filter)->find();
		$userinfo['sstatus']=TRUE;
		if (!ereg('^http://', $userinfo['img'])) 
		{
			$userinfo['sstatus']=FALSE;
		}
		
		$this->assign('data', $userinfo);
		$this->assign('pmcount', $this->getPaimaiUnfixedCount());
		$this->assign('pid', 'me');
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
		->order(" time desc")
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
				//$user["mobile"]	=$_POST['mobile'];
				$user["username"]	=$_POST['username'];
//				$user["username"]	=$_POST['username'];
				session('wxUserinfo', $user);//更新缓存					
				$db->save($user);						
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

			$s=$pageSize* ($pageNum-1);
			$e=$pageSize* $pageNum;
			
			$uid=session("_uid");
			$sql="select 
pm.username,mh.qishu >0 as IsEnd,yyg_member_miaosha.count,m.title,m.thumb,m.danjia,m.status,yyg_member_miaosha.gid, yyg_member_miaosha.qishu
, m.canyurenshu, m.zongrenshu,m.shengyurenshu,m.type,m.jishijiexiao,yyg_member_miaosha.time,yyg_member_miaosha.uid,yyg_member_miaosha.count
 from yyg_member_miaosha
inner join yyg_miaosha m ON yyg_member_miaosha.gid=m.gid
LEFT JOIN yyg_miaosha_history mh ON mh.qishu=yyg_member_miaosha.qishu and mh.`gid` =yyg_member_miaosha.gid 
Left join yyg_member pm on pm.uid=mh.prizeuid
where
	yyg_member_miaosha.uid=$uid
order by yyg_member_miaosha.time desc
limit $s,$e";

		//$rd = array('status'=>-1);
//		$list= M()->page($pageNum, $pageSize)->query($sql);
		$list= M()->query($sql);
		
		$this->ajaxReturn($list, "JSON");
	}
	
	public function miaoshazj()
	{
		$this->assign('title', '中奖记录');
		$this->display();
	}
	
	public function pageAllzj($pageSize, $pageNum) {
		// 分页
//		$Model = M('miaosha_history');
		$uid = session("_uid");
		$s=$pageSize* ($pageNum-1);
		$e=$pageSize* $pageNum;
		
			$sql="select 
pm.username,mh.`qishu` <m.qishu as IsEnd, m.title,m.thumb,m.danjia,m.status, mh.gid,  mh.qishu
, m.canyurenshu, m.zongrenshu,m.shengyurenshu,m.type,m.jishijiexiao, mh.end_time as time 
from yyg_miaosha_history mh
inner join yyg_miaosha m ON mh.gid=m.gid
Left join yyg_member pm on pm.uid=mh.prizeuid
where
	mh.prizeuid=$uid
order by  mh.time desc
limit $s,$e";
		$list= M()->query($sql);		
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
		$filter['yyg_miaosha_history.sdstatus'] = 0;
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, 
		canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
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
		$filter['yyg_miaosha_history.sdstatus'] = 1;
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
	
	/**
	 * 个人拍卖纪录
	 */
	public function paimai($type = 0) {
		
		$this->assign('pmcount', $this->getPaimaiUnfixedCount());
		$this->assign('title', '拍卖纪录');
		$this->assign('type', $type); // 0 全部，1.待处理，2.已处理
		$this->display();
	}
	
	// 获取未处理拍卖个数
	function getPaimaiUnfixedCount() {
		$db = M('Paimai');
		$uid = get_temp_uid();
		$map = array(
			'prizeuid'		=> $uid,
			'ispay'			=> 0
		);
		return $db->where($map)->count();
	}
	
	/**
	 * 个人拍卖纪录
	 */
	public function pagepaimai($type = 0, $pageNo = 1) {
		$pageSize = 12;
		$uid = get_temp_uid();
		$map = array('uid'		=> $uid);
		
		switch($type) {
			case 1: //1.待处理
				$map['status'] = 2;
				$map['prizeuid'] = $uid;
				$map['ispay'] = 0;
				$map['flag'] = 1;
				$map['zuigaojia'] = array('exp', ' = money');
				break;
			case 2:
				$map['status'] = 2;
				$map['prizeuid'] = $uid;
				$map['ispay'] = array('neq', 0);
				$map['flag'] = 1;
				$map['zuigaojia'] = array('exp', ' = money');
				break;
		}
		
		$db = M('MemberPaimai');
		$list = $db
			->field('p.gid, p.title, p.zuigaojia, p.status, p.prizeuid, p.ispay, p.postcode, p.postcompany, p.ispost, mp.id, mp.uid, mp.flag, mp.money, mp.time')
			->join('mp inner join __PAIMAI__ p on p.gid=mp.gid')
			->where($map)
			->order('mp.time desc')
			->page($pageNo, $pageSize)->select();
		
//		echo $db->getLastSql();
		
		$this->ajaxReturn($list, 'JSON');
	}
 

}