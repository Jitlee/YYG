<?php
namespace P\Controller;
class LotteryController extends CommonController {
		
	public function index($sort = 0, $pageNo = 1){
//		run_task();
		$this->assign('title', '壹圆购物');
		$num = 0;
		$total = 0;
		$pageSize = 14;
		
		// 最新揭晓
		$hdb = M('MiaoshaHistory');
//		$filter = 'prizeuid is not null and exists(select 0 from yyg_miaosha b where yyg_miaosha_history.gid = b.gid and (yyg_miaosha_history.qishu = b.qishu or yyg_miaosha_history.qishu = b.qishu - 1))';
		$list = $hdb->field('gid,title,qishu,thumb,m.money,danjia,status, canyurenshu, end_time, goumaicishu, prizeid, prizeuid, prizecode, prizecount,
					INSERT(u.username,ROUND(CHAR_LENGTH(u.username) / 2),ROUND(CHAR_LENGTH(u.username) / 4),\'****\') username, u.img userimg')
				->join("m left join __MEMBER__ u on u.uid = m.prizeuid")
				->order('end_time desc, gid desc, qishu desc')
			->page($pageNo, $pageSize)->select();
		$this->assign('list', $list);
		
//		echo $hdb->getLastSql();
		
		$num = count($list);
		$total = $hdb->where($filter)->count();
		
		$pageCount = ceil($total / $pageSize);
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNo', $pageNo);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNo', floor(($pageNo-1)/10.0) * 10 + 1);
		$this->assign('maxPageNo', min(ceil(($pageNo)/10.0) * 10 + 1, $pageCount));
		
		$this->assign('num', $num);
		$this->assign('total', $total);
		$this->assign('sort', $sort);
		
		// 他们购买记录
		$mmdb = M('MemberMiaosha');
		$records = $mmdb->join('yyg_member on yyg_member.uid = yyg_member_miaosha.uid')
			->join('yyg_miaosha on yyg_miaosha.gid = yyg_member_miaosha.gid and yyg_miaosha.qishu = yyg_member_miaosha.qishu')
			->field(array('yyg_member_miaosha.id'=>'mid','yyg_member_miaosha.uid', 
				'yyg_member.img', 'yyg_member_miaosha.count','yyg_member_miaosha.time',
				'IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username',
				'yyg_miaosha.gid', 'yyg_miaosha.thumb','yyg_miaosha.title','yyg_miaosha.qishu'))
			->where($mmmap)->order('yyg_member_miaosha.time desc')->page(1, 6)->select();
		if(!empty($records)) {
			$this->assign('records', $records);
		}
		
		// 人气排行榜
		$mdb = M('Miaosha');
		$renqi = $mdb->where('status <> 2')
			->order('canyurenshu desc')
			->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,shengyurenshu,type')
			->page(1,12)->select();
		if(!empty($renqi)) {
			$this->assign('renqi', $renqi);
		}
		
		$this->display();
    }

	public function view($gid, $qishu = null) {
	}
	
	
	// 前一百个购买纪录
	public function r($gid, $qishu, $pageNo = 1) {
		$mdb = M('MiaoshaRecord');
		$pageSize = 10;
		$filter = array(
			'r.gid'		=> $gid,
			'r.qishu'		=> $qishu
		);
		$list = $mdb->field("r.gid,r.mid,ms.time,ms.count
			,INSERT(u.username,ROUND(CHAR_LENGTH(u.username) / 2),ROUND(CHAR_LENGTH(u.username) / 4),'****') username, u.img userimg")
			->join("r inner join __MEMBER_MIAOSHA__ ms on ms.id = r.mid")
			->join("inner join __MEMBER__ u on u.uid = ms.uid")
			->where($filter)->order('ms.time desc')->page($pageNo, $pageSize)->select();
		$num = 0;
		
//		echo $mdb->getLastSql();
		$total = 0;
		if($list) {
			$this->assign('list', $list);
			$num = count($list);
			
			$total = $mdb->join("r inner join __MEMBER_MIAOSHA__ ms on ms.id = r.mid")->where($filter)->count();
			
			$pageCount = ceil($total / $pageSize);
			$this->assign('pageSize', $pageSize);
			$this->assign('pageNo', $pageNo);
			$this->assign('pageCount', $pageCount);
			$this->assign('minPageNo', floor(($pageNo-1)/10.0) * 10 + 1);
			$this->assign('maxPageNo', min(ceil(($pageNo)/10.0) * 10 + 1, $pageCount));
		}
		$this->assign('gid', $gid);
		$this->assign('qishu', $qishu);
		$this->assign('num', $num);
		$this->assign('total', $total);
		layout(false);
		$this->display('record');
	}
}
	