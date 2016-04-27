<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 幻灯片控制器
 */
class ReportController extends CommonController {

	public function buylistadmin($pageSize = 25, $pageNum = 1) {
		 
		 $filter = ' prizeuid > 0 ';
		 // 分页
		$Model = M('miaosha_history');
		$list =$Model
		->join("yyg_member m ON m.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu
		, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,m.uid,prizeuid,m.username,m.mobile,postcode,postcompany ")
		->order(" yyg_miaosha_history.time  desc")
		->select();
		
		
		$count = $Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->field("mobile,title,thumb,danjia,status,yyg_member.uid")
		->count();
		
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		
		 
		$this->assign('list',$list);// 模板变量赋值
		
		
		 
		$this->assign('title', '获奖记录');
		$this->assign('pid', 'report');
		$this->assign('mid', 'buylistadmin');
		$this->display();
	}

	public function buylistadminsend($gid, $qishu) {
		 
		$filter = " yyg_miaosha_history.gid=$gid and  yyg_miaosha_history.qishu=$qishu";
		 // 分页
		$Model = M('miaosha_history');
		$list =$Model
		->join("yyg_member m ON m.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu
		, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,m.uid,prizeuid,m.username,m.mobile,postcode,postcompany")
		->order(" yyg_miaosha_history.time  desc")
		->select(); 
		
		$db=M("member_dizhi");
		$data['uid'] = $list[0]["prizeuid"];
		$add = $db->where($data)->find();
			
		$this->assign('address',$add);
		$this->assign('data',$list[0]);// 模板变量赋值
		
		
		 
		$this->assign('title', '发货');
		$this->assign('pid', 'report');
		$this->assign('mid', 'buylistadmin');
		$this->display();
	}

	public function buylistadminsendsave() 
	{
		$gid=$_POST["gid"];
		 $qishu=$_POST["qishu"];
		 $postcode=$_POST["postcode"];
		 $postcompany=$_POST["postcompany"];
		 $filter = " yyg_miaosha_history.gid=$gid and  yyg_miaosha_history.qishu=$qishu";
		
		$db = M('miaosha_history');
		$data['uid'] = $list[0]["prizeuid"];
		$add = $db->where($filter)->find();
		//echo dump($add);
		//save
		$rd = array('status'=>-1);
		$add["postcode"]=$postcode;
		$add["postcompany"]=$postcompany;
		
		if ($db ->save($add) ) {			
			$rd["status"]=1;
		} 
		$this->ajaxReturn($rd, "JSON");
		//$this->display("buylistadminsend");
		 
	}
	/**
	 * 充值记录
	 * **/
	public function userrecharge($pageSize = 25, $pageNum = 1) {
		
		$db = M('account');		 
		$map = ' (a.type=30 or a.type=31)';
		
		$list = $db
			->field('a.*,m.username,m.mobile')
			->join('a inner join __MEMBER__ m on m.uid=a.uid')
			->where($map)
			->page($pageNum, $pageSize)	
			->order('a.time desc')->select();
			
		$count = $db->join('a inner join __MEMBER__ m on m.uid=a.uid')->where($map)->count();
		
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		
		$this->assign('list',$list);// 模板变量赋值
		$this->assign('title', '充值记录');
		$this->assign('pid', 'mbmgr');
		$this->assign('mid', 'userrecharge');
		$this->display();
	}
	/**
	 * 购买记录
	 * *****/
	public function buylist($pageSize = 25, $pageNum = 1) {
		
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageSize = 15;
		
		$db = M('account');		 
		$map = ' (a.type=11 or a.type=1 or a.type=0) and a.status=1';
		
		$list = $db
			->field('a.*,m.username,m.mobile')
			->join('a inner join __MEMBER__ m on m.uid=a.uid')
			->where($map)
			->page($pageNum, $pageSize)	
			->order('a.time desc')->select();
			
		$count = $db->join('a inner join __MEMBER__ m on m.uid=a.uid')->where($map)->count();
		
		
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		
		$this->assign('list',$list);// 模板变量赋值
		$this->assign('title', '购买记录');
		$this->assign('pid', 'mbmgr');
		$this->assign('mid', 'buylist');
		$this->display();
	}
	
	public function paimaiadmin($pageSize = 25, $pageNum = 1) {
		
		$db = M('Paimai');
		
		$map = array(
			'prizeuid'		=> array('gt', 0),
			'status'			=> 2,
			'ispay'			=> 1,
		);
		
		$list = $db
			->field('p.gid, p.title, p.zuigaojia, p.qipaijia, p.ispost, p.baomingrenshu, p.chujiacishu, p.end_time, postcode, postcompany, m.uid, m.username,m.mobile,m.img')
			->join('p inner join __MEMBER__ m on m.uid=p.prizeuid')
			->where($map)
			->order('p.end_time desc')->select();
			
			
		$count = $db->where($map)->count();
		
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		
		$this->assign('list',$list);// 模板变量赋值
		$this->assign('title', '中标管理');
		$this->assign('pid', 'report');
		$this->assign('mid', 'paimaiadmin');
		$this->display();
	}

	public function paimaiadminsend($gid) {
		$db = M('Paimai');
		$map = array('p.gid'		=> $gid);
		$data =	$db
			->field("p.title,p.gid,p.time,m.uid,prizeuid,m.username,m.mobile
			,postcode,postcompany,
			shouhuoren,md.mobile _mobile, youbian, sheng,shi,xian,jiedao")
			->join("p inner join __MEMBER__ m ON m.uid=p.prizeuid")			
			->join('left join __MEMBER_DIZHI__ md on md.uid=m.uid')
			->where($map)->find(); 
			
		$this->assign('data',$data);// 模板变量赋值
		
		$this->assign('title', '发货');
		$this->assign('pid', 'report');
		$this->assign('mid', 'paimaiadmin');
		$this->display();
	}
	
	public function cancelpaimai($gid) {
		$db = M('Paimai');
		$rst['status'] = -1;
		if($db->where(array('gid'	=> $gid))->save(array('ispay'	=> -1)) !== FALSE) {
			$rst['status'] = 0;
		}
		$this->ajaxReturn($rst['status'], 'JSON');
	}

	public function paimaiadminsendsave() 
	{
		$gid=$_POST["gid"];
		
		$postcode=$_POST["postcode"];
		$postcompany=$_POST["postcompany"];
		
		$db = M('Paimai');
		$rd = array('status'=>-1);
		$add["postcode"]=$postcode;
		$add["postcompany"]=$postcompany;
		$add["ispost"]=1;
		
		$map['gid'] = $gid;
		
		if ($db->where($map)->save($add) !== FALSE) {			
			$rd["status"]=1;
		} 
		$this->ajaxReturn($rd, "JSON");
		 
	}
	
	
	/*
	 * 提现记录
	 * */
	 public function cashoutlist($pageSize = 25, $pageNum = 1) {
		 // 分页
		$Model = M('member_cashout');
		$list =$Model
		->join("yyg_member m ON m.uid=yyg_member_cashout.uid")			
		//->where($filter)
		->page($pageNum, $pageSize)		
		->field("id,m.uid,m.username,m.mobile,yyg_member_cashout.username cashoutusername,bankname,branch,yyg_member_cashout.money cashoutmoney
		,yyg_member_cashout.time cashouttime,banknumber,linkphone,auditstatus,procefees,reviewtime ")
		->order(" yyg_member_cashout.time  desc")
		->select();
		
		
		$count = $Model->count();
		
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		
		 
		$this->assign('list',$list);// 模板变量赋值
		
		
		 
		$this->assign('title', '提现记录');
		$this->assign('pid', 'report');
		$this->assign('mid', 'cashoutlist');
		$this->display();
	}
	
	
	
	
	
	
	
}
	