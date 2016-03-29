<?php
namespace P\Controller;
class LotteryController extends CommonController {
		
	public function index($sort = 0, $pageNo = 1){
		run_task();
		$this->assign('title', '壹圆购物');
		$num = 0;
		$total = 0;
		$pageSize = 10;
		
		// 最新揭晓
		$hdb = M('MiaoshaHistory');
//		$filter = 'prizeuid is not null and exists(select 0 from yyg_miaosha b where yyg_miaosha_history.gid = b.gid and (yyg_miaosha_history.qishu = b.qishu or yyg_miaosha_history.qishu = b.qishu - 1))';
		$list = $hdb->join('yyg_member on yyg_member.uid = yyg_miaosha_history.prizeuid')
			->where($filter)->order('end_time desc')
			->field(array('yyg_miaosha_history.gid','yyg_miaosha_history.title','yyg_miaosha_history.thumb',
				'yyg_miaosha_history.money','yyg_miaosha_history.danjia','yyg_miaosha_history.xiangou',
				'yyg_miaosha_history.status','yyg_miaosha_history.qishu','yyg_miaosha_history.canyurenshu',
				'yyg_miaosha_history.zongrenshu','yyg_miaosha_history.type','yyg_miaosha_history.prizeuid',
				'yyg_miaosha_history.prizecode','yyg_miaosha_history.end_time',
				'(select sum(count) from yyg_member_miaosha ms where ms.uid=yyg_miaosha_history.prizeuid and ms.qishu=yyg_miaosha_history.qishu and ms.gid=yyg_miaosha_history.gid) count',
				'IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
			->page($pageNo, $pageSize)->select();
		$this->assign('list', $list);
		
//		echo $hdb->getLastSql();
		
		$num = count($list);
		$total = $hdb->join('yyg_member on yyg_member.uid = yyg_miaosha_history.prizeuid')
			->where($filter)->count();
		
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
}
	