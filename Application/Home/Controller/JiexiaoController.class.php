<?php
namespace Home\Controller;
use Think\Controller;
class JiexiaoController extends Controller {
	
	public function index(){
    		$this->assign('title', '最新揭晓');
		$this->assign('pid', 'jiexiao');
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
		
		$list = $db->where($filter)->order("status asc, end_time desc")->page($pageNum, $pageSize)->field('gid,title,thumb,money,danjia,status, canyurenshu, end_time')->select();
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