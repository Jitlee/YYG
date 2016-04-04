<?php
namespace P\Controller;
use Think\Controller;
class HomeController extends CommonController {
	protected function _initialize() {
		parent::_initialize();
		
		if($_SESSION["loginuid"])
		{
			session("_uid",$_SESSION["loginuid"]);
			session('wxUserinfo',$_SESSION["loginitem"]);
			session('loginstatus', 1);
		}	
		
		if(!is_login()) {
			$this->redirect('Main/login');
			return;
		}		
		$this->assign('pmcount', $this->getPaimaiUnfixedCount());
	}
		
	public function index(){
		echo $_SESSION['logintype'];
		
		if($_SESSION["loginuid"])
		{
			session("_uid",$_SESSION["loginuid"]);
			session('wxUserinfo',$_SESSION["loginitem"]);
			session('loginstatus', 1);
		}
		
    	$this->assign('title', '壹圆购物');
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
	/*******我的购物********/
	public function userbuylist(){		
    	$this->assign('title', '壹圆购物');
		$this->display();
    }
	public function pageAllMR($pageSize, $pageNum) {
		// 分页
		$Model = M('member_miaosha');
		$filter['yyg_member_miaosha.uid'] = session("_uid");  
		
		$list =$Model
		->join("yyg_miaosha m ON yyg_member_miaosha.gid=m.gid ")			
		->where($filter)
		->page($pageNum, $pageSize)
		->field("yyg_member_miaosha.`qishu` <m.qishu as IsEnd,title,thumb,danjia,status,yyg_member_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu
		,type,jishijiexiao,m.time,yyg_member_miaosha.uid,yyg_member_miaosha.count")
		->order('yyg_member_miaosha.time desc')
		->select();
		 
		$this->ajaxReturn($list, "JSON");
	}
	/*	中奖记录	*/
	public function orderlist(){		
    	$this->assign('title', '壹圆购物');
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
	
	
	public function singlelist(){		
    	$this->assign('title', '晒单列表');
		$this->display();
    }
	public function pageAllsdno($pageSize, $pageNum) {//未晒单
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		$filter['yyg_miaosha_history.sdstatus'] = 0;
		 
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,sdstatus,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		 $this->ajaxReturn($list, "JSON");
	}
	
	public function pageAllsdfinish($pageSize, $pageNum) {//已晒单
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		$filter['yyg_miaosha_history.sdstatus'] = 1;
		
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,sdstatus,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function singleinsert($gid=null,$qishu=null){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
			$db=M("shaidan");
			$data['uid'] = session("_uid");
			$add = $db->where($data)->find();
			
			$_POST['uid']=  session("_uid");
			$_POST['time'] = date('y-m-d-h-i-s');
			$_POST['ip'] = get_client_ip(1);
								
			$db->create();
			if($db->add() != false) {
				//修改状态
				$fit['gid'] = $_POST['gid'];
				$fit['qishu'] = $_POST['qishu'];
				$fit['zan'] = 0;
				$fit['ping'] = 0;
				
				$dbzt=M("miaosha_history");					
				$addzt = $dbzt->where($fit)->find();
				if($addzt)
				{
					$addzt["sdstatus"]=1;
					$dbzt->save($addzt);	
				}
				//添加晒单积分				
				$m = D('P/MemberScore');
				$resultr = $m->AddLessScore('晒单赠送积分。',100);
				if($resultr && $resultr["status"]=1)
				{
					$result["status"]=1;					
				}					
				else
				{
					$result["msg"]=$resultr["msg"];
				}
			} 
			else 
			{
				$result["msg"]='数据错误';
			}
			 
			$this->ajaxReturn($result, "JSON");
		}
		else
		{
	    	$this->assign('title', '晒单');
			$data=session('wxUserinfo');
			$this->assign("data", $data);
			$this->assign("gid", $gid);
			$this->assign("qishu", $qishu);
			
			$this->display();
		}
    }
	/*******end我的购物********/
	/*******邀请管理********/
	public function invitefriends($pageSize=10, $pageNum=1){		
    	$this->assign('title', '壹圆购物');		
		$db = M('member');
		$filter['yaoqing'] = session("_uid");
		
		$total =$db->where($filter)->count();
		$this->SetPage($pageSize,$pageNum,$total);
		
		$list =$db					
		->where($filter)
		->page($pageNum, $pageSize)
		->select();
		
		$this->assign("list", $list);
		$this->display();
    }
	
	public function commissions(){		
    	$this->assign('title', '壹圆购物');
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
	    	$this->assign('title', '壹圆购物');
	    	$data=session('wxUserinfo');
			$this->assign("data", $data);
			$this->display();
		}
    }
	
	public function record($pageSize=10, $pageNum=1){		
    	$this->assign('title', '提现记录');
		$this->assign("list", $this->GetCashoutlist($pageSize,$pageNum));
		$this->display();
    }
	public function GetCashoutlist($pageSize, $pageNum)
	{
		$Model = M('member_cashout');
		$filter['uid'] = session("_uid");
		
		$total =$Model->where($filter)->count();
		$this->SetPage($pageSize,$pageNum,$total);
				
		$list =$Model					
			->where($filter)
			->page($pageNum, $pageSize)
			->select();
		return $list;
	}
//	public function pagecashoutlist()
//	{
//		$list=$this->GetCashoutlist($pageSize,$pageNum);
//		$this->ajaxReturn($list, "JSON");
//	}
	/*******end邀请管理********/
	
	/*******账户管理********/
	public function userbalance($pageSize=20, $pageNum=1){		
    	$this->assign('title', '壹圆购物');
    	$data=session('wxUserinfo');
		$this->assign("data", $data);
		$this->assign("list", $this->GetRecord($pageSize,$pageNum));
		$this->display();
    }
    //充值记录分页
//	public function pageAllRechargerecord($pageSize, $pageNum) {
//		// 分页
//		$list=$this->GetRecord($pageSize,$pageNum);
//		$this->ajaxReturn($list, "JSON");
//	}
    public function GetRecord($pageSize, $pageNum)
	{
		$Model = M('member_addmoney_record');
		$filter['uid'] = session("_uid");
		$total =$Model->where($filter)->count();
		$this->SetPage($pageSize,$pageNum,$total);
		$list =$Model->where($filter)->page($pageNum, $pageSize)->select();
		return $list;
	}
	
	public function userrecharge(){		
    	$this->assign('title', '壹圆购物');
		$this->display();
    }
	/*******end账户管理********/
	public function userscore($pageSize=20, $pageNum=1){		
    	$this->assign('title', '壹圆购物');
		$data=session('wxUserinfo');
		$this->assign("data", $data);
		
		$list=$this->Getscorelist($pageSize,$pageNum);
		$this->assign("list", $list);
		
		$scoremoney=$data.score/100;
		$this->assign("scoremoney", $scoremoney);
		$this->display();
    }
		
	public function Getscorelist($pageSize, $pageNum)
	{
		$Model = M('member_score');
		$filter['uid'] = session("_uid");	
		
		$total =$Model->where($filter)->count();
		$this->SetPage($pageSize,$pageNum,$total);
			
		$list =$Model					
		->where($filter)
		->page($pageNum, $pageSize)
		->select();
		return $list;
	}
//	public function pagescore()
//	{
//		$list=$this->Getscorelist($pageSize,$pageNum);
//		$this->ajaxReturn($list, "JSON");
//	}
	
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
    	$this->assign('title', '壹圆购物');
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
    	$this->assign('title', '壹圆购物');
		$this->display();
    }	
	
 
	public function goodcodelist($gid,$qishu,$pageSize=100, $pageNum=1){		
    	$this->assign('title', '购物码');
		$this->assign("list", $this->GetGoodcodelist($gid,$qishu,$pageSize,$pageNum));
		$this->display();
    }
	public function GetGoodcodelist($gid,$qishu,$pageSize, $pageNum)
	{
		$Model = M('miaosha_code');
		$filter['uid'] = session("_uid");
		$filter['gid'] = $gid;
		$filter['qishu'] = $qishu;
		
		$total =$Model->where($filter)->count();
		$this->SetPage($pageSize,$pageNum,$total);
				
		$list =$Model					
			->where($filter)
			->field("pcode+10000001 as pcode,time")
			->page($pageNum, $pageSize)
			->select();
		return $list;
 	}
 	
	public function upload() {
		$rootPath = '/Uploads/Shaidan/';
		if (!empty($_FILES)) {
			$config = array(
			    'maxSize'    =>    3145728,
			    'rootPath'   =>    '.' . $rootPath,
			    'savePath'   =>    '',
			    'saveName'   =>    array('uniqid',''),
			    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
			    'autoSub'    =>    true,
			    'subName'    =>    array('date','Ymd'),
			);
	
			$upload = new \Think\Upload($config);// 实例化上传类
			
		    // 上传文件 
		    $info   =   $upload->upload();
		    if($info != false) {// 上传成功
		    		$returnData["status"] = 0;
				$returnData["url"] = $rootPath . $info['Filedata']['savepath'] . $info['Filedata']['savename'];
				$returnData["key"] = encode($info['Filedata']['savepath'] . $info['Filedata']['savename']);
		        $this->ajaxReturn($returnData, "JSON");
		    }else{// 上传错误提示错误信息
		    		$returnData["status"] = -1;
		    		$returnData["info"] = $upload->getError();
		        $this->ajaxReturn($returnData, "JSON");
		    }
		}
 
	}	
		
	/**
	 * 个人拍卖纪录（缴纳保证金，）
	 * $type - 0:显示全部，未付款，已付款
	 */
	public function paimai($type = 0, $pageNo = 1) {
		$pageSize = 20;
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
		$num = count($list);
		$total = $db->join('mp inner join __PAIMAI__ p on p.gid=mp.gid')->where($map)->count();
		$pageCount = ceil($total / $pageSize);
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNo', $pageNo);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNo', floor(($pageNo-1)/10.0) * 10 + 1);
		$this->assign('maxPageNo', min(ceil(($pageNo)/10.0) * 10 + 1, $pageCount));
			
		$this->assign('num', $num);
		$this->assign('total', $total);
		$this->assign('type', $type);
		$this->assign('list', $list);
//		$this->assign('pmcount', $this->getPaimaiUnfixedCount());
		$this->assign('title', '拍卖纪录');
		
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
}
	