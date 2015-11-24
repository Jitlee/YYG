<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 购物车控制器
 */
class CartController extends Controller {
	
	public function index(){
    		$this->assign('title', '购物车');
		$this->assign('pid', 'cart');
		
		$db = D('cart');
		$list = $db->relation(true)->select();
		if(!empty($list)) {
			$this->assign('list', $list);
		}
		
		$this->display();
    }
	
	public function add($gid, $type) {
		$db = M('cart');
		$map['gid'] = $gid;
		$exists = $db->where($map)->field('id')->find();
		if($exists) {
			// 存在，累加
			$exists['count'] = array('exp', '`count` + 1');
			$result['data'] = $db->save($exists);
		} else {
			$data['gid'] = $gid;
			$data['uid'] = 0;
			$data['type'] = $type;
			$result['data'] = $db->add($data);
		}
		if($result['data']) {
			$result['status'] = 1;
			$result['message'] = '添加成功';
		} else {
			$result['status'] = 0;
			$result['message'] = '添加失败';
		}
		$this->ajaxReturn($result);
	}
	
	public function edit($id, $count) {
		$db = M('cart');
		$data['id'] = $id;
		$data['count'] = $count;
		$row = $db->save($data);
		if($row >= 0) {
			$result['status'] = 1;
			$result['message'] = '修改成功';
		} else {
			$result['status'] = 0;
			$result['message'] = '修改失败';
		}
		$this->ajaxReturn($result);
	}
	
	public function remove($id) {
		$db = M('cart');
		if($db->delete($id)) {
			$result['status'] = 1;
			$result['message'] = '删除购物车成功';
		} else {
			$result['status'] = 0;
			$result['message'] = '添加到购物车失败';
		}
		$this->ajaxReturn($result);
	}
}