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
	/*		中奖记录	*/
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
	
	public function singlelist(){		
    	$this->assign('title', '一元购');
		$this->display();
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
    	$this->assign('title', '一元购');
		$this->display();
    }
	
	public function record(){		
    	$this->assign('title', '一元购');
		$this->display();
    }
	/*******end邀请管理********/
	
	/*******账户管理********/
	public function userbalance(){		
    	$this->assign('title', '一元购');
    	$data=session('wxUserinfo');
		$this->assign("data", $data);
		$this->display();
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
	public function address(){		
    	$this->assign('title', '一元购');
		$this->display();
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
	