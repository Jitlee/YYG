<?php
namespace Home\Controller;
use Think\Controller;
class MiaoshaController extends Controller {
	public function index(){
    		$this->assign('title', '秒杀');
		$this->assign('pid', 'miaosha');
        $this->display();
    }
	
	public function eee(){
    		$this->assign('title', '秒杀');
		$this->assign('pid', 'miaosha');
        $this->display();
    }
	
	public function pageAll($pageSize, $pageNum) {
		// 分页
		$db = M('miaosha');
		$filter["jishijiexiao"] = 0;
		
		$cid = intval(I('get.cid'));
		$bid = intval(I('get.bid'));
		if($cid > 0) {
			$filter['cid'] = $cid;
			if($bid > 0) {
				$filter['bid'] = $bid;
			}
		}
		
		$type = I("get.type");
		$order = null;
		switch($type) {
			case 2:
				$order = "time desc";
				break;
			case 3:
				$order = "shengyurenshu desc";
				break;
			case 4: // 总需人数
				$order = "zongrenshu desc";
				break;
			default: // 人气
				$order = "canyurenshu desc";
				break;
		}
		
		$list = $db->where($filter)->order($order)->page($pageNum, $pageSize)->field('gid,title,thumb,money,danjia,status')->select();
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
		$brands = $db->relation(true)->find($cid)['brands'];
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
	