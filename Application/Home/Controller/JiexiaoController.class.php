<?php
namespace Home\Controller;
use Think\Controller;
class JiexiaoController extends Controller {
	
	public function index(){
		run_task();
    		$this->assign('title', '最新揭晓');
		$this->assign('pid', 'jiexiao');
		$this->assign('tabId', 2);
		$this->display();
    }
	
	public function pageAll($pageSize, $pageNum) {
		// 分页
		$db = M('miaosha');
		$filter["jishijiexiao"] = array('gt', 0);
		$filter['type'] = 1;
		
		$cid = intval(I('get.cid'));
		if($cid > 0) {
			$filter['cid'] = $cid;
		}
		$type = I("get.type");
		$order = '';
		
		switch($type) {
			case 2:
				$order = ",time desc";
				break;
			case 3:
				$order = ",shengyurenshu desc";
				break;
			case 4: // 总需人数
				$order = ",zongrenshu desc";
				break;
			default: // 人气
				$order = ",canyurenshu desc";
				break;
		}
		
		$filter['status'] = array('elt', 2);
		
		$list = $db->where($filter)
			->order('status asc'. $order)
			->page($pageNum, $pageSize)
			->field('gid,title,qishu,thumb,money,danjia,status, canyurenshu, end_time,prizeuid,prizecode')->select();
			
		if(!empty($list)) {
			$udb = M('member');
			$mhdb = M('MemberMiaosha');
			foreach($list as $data) {
				if(!empty($data['prizeuid'])) {
					$user = $udb->field('uid, username, email, mobile, img, qianming')->find($data['prizeuid']);
					$data['prizer'] = $user;
					
					if(empty($user['username'])) {
						$user['username'] = substr($user['mobile'], 0, 3).'****'.substr($user['mobile'], 7, 4);
					}
					
					// 获取用户当期购买数量
					$mhmap['uid'] = $data['prizeuid'];
					$mhmap['gid'] = $data['gid'];
					$mhmap['qishu'] = $data['qishu'];
					$count = $mhdb->where($mhmap)->sum('count');
					$data['prizer']['count'] = $count;
				}
			}
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
}