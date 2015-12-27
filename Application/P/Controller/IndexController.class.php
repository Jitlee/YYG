<?php
namespace P\Controller;
class IndexController extends CommonController {
		
	public function index(){
    		$this->assign('title', '一元购');
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
		
		// 商品分类
		$cdb = D('category');
		$categories = $cdb->relation(true)->page(1,6)->select();
		$this->assign('allCategories', $categories);
		
		$data=session('wxUserinfo');
		$this->assign('data', $data);
		
		// 最新揭晓
		$hdb = M('MiaoshaHistory');
		$filter = 'prizeuid is not null and exists(select 0 from yyg_miaosha b where yyg_miaosha_history.gid = b.gid and (yyg_miaosha_history.qishu = b.qishu or yyg_miaosha_history.qishu = b.qishu - 1))';
		$zuixins = $hdb->join('yyg_member on yyg_member.uid = yyg_miaosha_history.prizeuid')
			->where($filter)->order('end_time desc')
			->field(array('yyg_miaosha_history.gid','yyg_miaosha_history.title','yyg_miaosha_history.thumb',
				'yyg_miaosha_history.money','yyg_miaosha_history.danjia','yyg_miaosha_history.xiangou',
				'yyg_miaosha_history.status','yyg_miaosha_history.qishu','yyg_miaosha_history.canyurenshu',
				'yyg_miaosha_history.zongrenshu','yyg_miaosha_history.type','yyg_miaosha_history.prizeuid',
				'IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
			->page(1,2)->select();
		$this->assign('zuixins', $zuixins);
		
		// 推荐商品
		$gdb = M('miaosha');
		$tuijians = $gdb->where('status <> 2 and tuijian = 1')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,type')->page(1,2)->select();
		$this->assign('tuijians', $tuijians);
		
//		// 最新揭晓count
//		$hdb = M('MiaoshaHistory');
//		$jiexiaocount = $hdb->where('jishijiexiao > 0 and to_days(end_time) = to_days(now())')->count();
//		$this->assign('jiexiaocount', $jiexiaocount);

		$remens = $gdb->where('status <> 2 and jishijiexiao=0')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,shengyurenshu,type')->page(1,8)->select();
		$this->assign('remens', $remens);
		
		$jijiagns = $gdb->where('status <> 2 and jishijiexiao>0')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,shengyurenshu,type')->page(1,8)->select();
		$this->assign('jijiagns', $jijiagns);
		$this->display();
    }
		
		
		
		
		
		
		
}
	