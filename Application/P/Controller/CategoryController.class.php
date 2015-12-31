<?php
namespace P\Controller;
class CategoryController extends CommonController {
	public function index($cid = 0, $bid = 0, $sort = 0, $pageNo = 1){
		$this->assign('cid', $cid);
		$this->assign('bid', $bid);
		$this->assign('sort', $sort);
		
		$this->assign('now', time());
		
		// 所有分类
		$cdb = D('category');
		$categories = $cdb->relation(true)->select();
		
		$brands = null;
		if($cid > 0) {
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
			$mmap['bid'] = $cid;
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
		
    	$this->assign('title', '全部商品');
		$this->display();
    }	
}
	