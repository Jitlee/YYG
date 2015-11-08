<?php
namespace Admin\Controller;
class MiaoshaController extends GoodsBaseController {
	
	protected function onadd($data) {
		$db = M('Miaosha');
		$db->add($data);
	}
	
	protected function onedit($data) {
		$db = M('Miaosha');
		$map['gid']=$data['gid'];
		$map['qishu']=$data['qishu'];
		$db->where($map)->save($data);
	}
	
	public function history($gid) {
		$db = D('Goods');
		$goods = $db->relation(true)->find($gid);
		$this->assign('goods', $goods);
		
		$mdb = M('Miaosha');
		$mmap['$gid'] = $gid;
		$list = $mdb->where($mmap)->order('qishu desc')->select();
		$this->assign('list', $list);
		
		$this->assign("title", "往期");
		$this->display();
	}
}