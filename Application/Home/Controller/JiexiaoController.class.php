<?php
namespace Home\Controller;
use Think\Controller;
class JiexiaoController extends Controller {
	
	public function index(){
//		run_task();
    		$this->assign('title', '即将揭晓');
		$this->assign('pid', 'jiexiao');
		$this->assign('tabId', 1);
		$this->display();
    }
	
	public function history() {
//		run_task();
    		$this->assign('title', '最新揭晓');
		$this->assign('pid', 'jiexiao');
		$this->assign('tabId', 2);
		$this->display();
	}
	
	public function pageAll($pageSize, $pageNum) {
		// 分页		
//		$filter['type'] = 1;
		$tabId = intval(I('tabId', 1)); // 1:即将揭晓，2最新揭晓
		$db = $tabId == 1 ? M("Miaosha") : M("MiaoshaHistory");
		
		$filter = $tabId == 1 ? array("m.jishijiexiao"=>array('gt', 0)) : array();
		
		$cid = intval(I('get.cid'));
		if($cid > 0) {
			$filter['m..cid'] = $cid;
		}
		$type = I("get.type");
		$order = 'm.gid desc';
		
		switch($type) {
			case 2:
				$order = "m.time desc,".$order;
				break;
			case 3:
				$order = "m.shengyurenshu asc,".$order;
				break;
			case 4: // 总需人数
				$order = "m.zongrenshu desc,".$order;
				break;
			default: // 人气
				$order = "m.canyurenshu desc,".$order;
				break;
		}
		
//		$filter['status'] = array('elt', 2);
		
		if($tabId == 1) {
			$list = $db->where($filter)
				->order('status asc,'. $order)
				->page($pageNum, $pageSize)
				->field('m.gid,m.title,m.qishu,m.thumb,m.money,m.danjia, m.shengyurenshu, m.canyurenshu, m.jishijiexiao,mh.end_time
					, if(m.status < 2 and m.shengyurenshu = 0, 2, m.status) status, unix_timestamp() *1000 now
					, unix_timestamp(date_add(m.time, interval m.jishijiexiao hour))*1000 end
					,unix_timestamp(date_add(m.lastTime, interval 3 minute))*1000 lasttime
					, prizeid, prizeuid, prizecode, prizecount,
					INSERT(u.username,ROUND(CHAR_LENGTH(u.username) / 2),ROUND(CHAR_LENGTH(u.username) / 4),\'****\') username, u.img userimg')
				->join('m left join __MIAOSHA_HISTORY__ mh on m.qishu=mh.qishu and m.gid=mh.gid')
				->join("left join __MEMBER__ u on u.uid = mh.prizeuid")
				->where($filter)
				->select();
		} else {
			$list = $db
				->field('gid,title,qishu,thumb,m.money,danjia,status, canyurenshu, shengyurenshu, end_time, goumaicishu, prizeid, prizeuid, prizecode, prizecount,
					INSERT(u.username,ROUND(CHAR_LENGTH(u.username) / 2),ROUND(CHAR_LENGTH(u.username) / 4),\'****\') username, u.img userimg')
				->join("m left join __MEMBER__ u on u.uid = m.prizeuid")
				->where($filter)
				->order('end_time desc, gid desc, qishu desc')
				->page($pageNum, $pageSize)->select();
//			echo $db->getLastSql();
		}
		$this->ajaxReturn($list, "JSON");
	}
	
	public function _empty($gid) {
		$this->view($gid);
	}
	
	protected function view($gid) {
		$this->assign('title', '商品详情');
		layout('sublayout');
		$this->display('view');
	}
	
	public function category() {
		$db = M('category');
		$list = $db->field('cid, name')->select();
		
		$db = M('miaosha');
		$filter["jishijiexiao"] = 0;
		$count = $db->where($filter)->count();
		$all['count'] = $count;
		$all['name'] = '全部';
		$all['cid'] = 0;
		array_unshift($list, $all);
		
		$this->ajaxReturn($list, "JSON");
	}
	
	public function brands($cid) {
		$db = D('category');
		$category = $db->relation(true)->find($cid);
		$brands = array();
		if($category) {
			$brands = $category['brands'];
		}
		$gdb = M('miaosha');
		$map['cid'] = $cid;
		$map["jishijiexiao"] = 0;
		$total = 0;
		foreach($brands as $key => $brand){
			$map['bid'] = $brand['bid'];
			$count = $brands[$key]['count'] = $gdb->where($map)->count();
			$total += $count;
		}
		$all['count'] = $total;
		$all['name'] = '全部';
		$all['bid'] = 0;
		array_unshift($brands, $all);
		$this->ajaxReturn($brands,'JSON');
	}
	
	public function record($gid, $qishu) {
		$mdb = M('MiaoshaHistory');
		$filter = array(
			'm.gid'		=> $gid,
			'm.qishu'		=> $qishu
		);
		$data = $mdb->field("gid,qishu,title,end_time,prizecode,prizeuid,prizeid,prizecount,prizeno,canyurenshu
			,INSERT(u.username,ROUND(CHAR_LENGTH(u.username) / 2),ROUND(CHAR_LENGTH(u.username) / 4),'****') username, u.img userimg")
			->join("m left join __MEMBER__ u on u.uid = m.prizeuid")
			->where($filter)->find();
		$this->assign('data', $data);
		$title = $data['title'];
		$this->assign('title', "(第$qishu)期 $title 结算结果");
		$this->display();
	}
	
	public function r($gid, $qishu) {
		$mdb = M('MiaoshaRecord');
		$filter = array(
			'r.prize_gid'		=> $gid,
			'r.prize_qishu'		=> $qishu
		);
		$list = $mdb->field("r.gid,r.qishu,r.mid,ms.time,ms.count,m.title,ms.ms,
			(HOUR(ms.time)*10000000+MINUTE(ms.time)*100000+SECOND(ms.time)*1000 + ms.ms) prizeno
			,INSERT(u.username,ROUND(CHAR_LENGTH(u.username) / 2),ROUND(CHAR_LENGTH(u.username) / 4),'****') username, u.img userimg")
			->join("r inner join __MEMBER_MIAOSHA__ ms on ms.id = r.mid")
			->join("inner join __MIAOSHA__ m on m.gid = ms.gid")
			->join("inner join __MEMBER__ u on u.uid = ms.uid")
			->where($filter)->order('ms.time desc')->select();
		$this->ajaxReturn($list, 'JSON');
	}
}