<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
    		$this->assign('title', '一元购');
		$this->assign('pid', 'home');
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
		$this->display();
    }
	
	public function pageAll($pageSize, $pageNum) {
		// 分页
		$db = M('miaosha');
		$filter['jishijiexiao'] = 0;
		$filter['type'] = 1;
		
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
		
		$list = $db->where($filter)->order($order)->page($pageNum, $pageSize)->field('gid,title,thumb,money,danjia,status,type')->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function _empty($gid) {
		$this->view($gid);
	}
	
	protected function view($gid, $qishu) {
		layout('sublayout');
		$this->assign('title', '商品详情');
		
		$db = M('miaosha');
		$data = $db->field('gid,title,subtitle,thumb,money,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,type')->find($gid);
		$data['percentage'] = min(100, $data['canyurenshu']*100/$data['zongrenshu']);
		$this->assign('data', $data);
		$imgdb = M('GoodsImages');
		$imgmap['gid'] = $gid;
		$imgmap['type'] = $data['type'];
		$images = $imgdb->where($imgmap)->select();
		if(empty($images)) {
			$image['image_url'] = $data['thumb'];
			array_push($images, $image);
		}
		$this->assign('images', $images);
		
		$this->display('view');
	}
	
	public function detail($gid) {
		layout(false);
		$this->assign('title', '商品图文详情');
		
		$db = M('miaosha');
		$data = $db->field('gid,content')->find($gid);
		$data['content'] = htmlspecialchars_decode(html_entity_decode($data['content']));
		$this->assign('data', $data);
		
		$this->display();
	}
	
	public function category() {
		$db = M('category');
		$list = $db->field('cid, name')->select();
		
		$db = M('miaosha');
		$filter["jishijiexiao"] = 0;
		$filter["type"] = 1;
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
		$map["type"] = 1;
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