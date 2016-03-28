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
}
	