<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    		$this->assign('title', '一元购');
		$this->assign('pid', 'home');
		
		$cdb = M('category');
		$allCategories = $cdb->limit(8)->select();
		$this->assign('allCategories', $allCategories);
		
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
		
        $this->display();
    }
}