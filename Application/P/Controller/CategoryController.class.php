<?php
namespace P\Controller;
class CategoryController extends CommonController {
	public function index($keywords = '', $type = 0, $cid = 0, $bid = 0, $sort = 0, $pageNo = 1){
		$this->assign('cid', $cid);
		$this->assign('bid', $bid);
		$this->assign('sort', $sort);
		$this->assign('type', $type);
		$this->assign('now', time());
		$title = '全部商品';
		
		// 所有分类
		$cdb = D('category');
		$categories = $cdb->relation(true)->select();
		$brands = null;
		if($cid > 0) {
			foreach($categories as $c) {
				if(intval($c['cid']) == $cid) {
					$brands = $c['brands'];
					break;
				}
			}
		} else if(count($categories) > 0) {
			$brands = $categories[0]['brands'];
		}
		
		if($brands) {
			$this->assign('brandsCount', count($brands));
			$this->assign('brands', $brands);
		}
		$this->assign('allCategories', $categories);
		
		$mdb = M('Miaosha');
		$mmap = array(
			'status'		=> array('neq', 2)
		);
		if($cid > 0) {
			$mmap['cid'] = $cid;
		}
		if($bid > 0) {
			$mmap['bid'] = $bid;
		}
		if($type == 1) {
			$mmap['jishijiexiao'] = array('eq', 0);
			$title = "热门商品";
		} else if($type == 2) {
			$mmap['jishijiexiao'] = array('lt', 0);
			$title = "即将揭晓";
		}
		
		if(!empty($keywords)) {
			$mmap['title'] = array('LIKE', '%'.$keywords.'%');
		}
		
		$order = 'time desc';
		switch($sort) {
			case 1:
				$order = 'end_time desc';
				break;
			case 2:
				$order = 'canyurenshu desc';
				break;
			case 3:
				$order = 'shengyurenshu asc';
				break;
			case 4:
				$order = 'money asc';
				break;
			case 5:
				$order = 'money desc';
				break;
			default:
				break;
		}
		
		$num = 0;
		$total = 0;
		
		$list = $mdb->where($mmap)->field(array('gid','title','thumb','money',
				'danjia','xiangou','status','qishu','canyurenshu','zongrenshu','shengyurenshu',
				'type','renqi','tuijian','time', 'now() - time' => '_time'))
			->order($order)->page($pageNo, 20)->select();
		if($list) {
			$this->assign('list', $list);
			$num = count($list);
			
			$total = $mdb->where($mmap)->count();
			
			$pageCount = ceil($total / 20);
			$this->assign('pageSize', 20);
			$this->assign('pageNo', $pageNo);
			$this->assign('pageCount', $pageCount);
			$this->assign('minPageNo', floor(($pageNo-1)/10.0) * 10 + 1);
			$this->assign('maxPageNo', min(ceil(($pageNo)/10.0) * 10 + 1, $pageCount));
		}
			
		$this->assign('num', $num);
		$this->assign('total', $total);
    		$this->assign('title', $title);
    		$this->assign('keywords', $keywords);
		$this->display();
    }
}
	