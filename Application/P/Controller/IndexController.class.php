<?php
namespace P\Controller;
use Think\Controller;
class IndexController extends Controller {
		
	public function index(){
    	$this->assign('title', '一元购');
		$this->assign('pid', 'home');
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
//		
//		// 商品分类
//		$cdb = M('category');
//		$categories = $cdb->page(1,8)->select();
//		$this->assign('allCategories', $categories);
		
		$data=session('wxUserinfo');
		$this->assign("data", $data);
		
		$this->display();
    }
		
		
		
		
		
		
		
}
	