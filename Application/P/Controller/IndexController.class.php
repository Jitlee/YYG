<?php
namespace P\Controller;
class IndexController extends CommonController {
		
	public function index(){
    	$this->assign('title', '一元购');
		$this->assign('pid', 'home');
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
		
		// 商品分类
		$cdb = D('category');
		$categories = $cdb->relation(true)->page(1,6)->select();
		$this->assign('allCategories', $categories);
		
		$data=session('wxUserinfo');
		$this->assign('data', $data);
		
		// 推荐商品
		$gdb = M('miaosha');
		$tuijians = $gdb->where('status <> 2 and tuijian = 1')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,type')->page(1,2)->select();
		$this->assign('tuijians', $tuijians);
		
//		// 最新揭晓count
//		$hdb = M('MiaoshaHistory');
//		$jiexiaocount = $hdb->where('jishijiexiao > 0 and to_days(end_time) = to_days(now())')->count();
//		$this->assign('jiexiaocount', $jiexiaocount);

		$remens = $gdb->where('status <> 2')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,shengyurenshu,type')->page(1,8)->select();
		$this->assign('remens', $remens);
		
		$this->display();
    }
		
		
		
		
		
		
		
}
	