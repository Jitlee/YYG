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
		
		$map['uid'] = get_temp_uid();
		$list = $db->where($map)->relation(true)->select();
		if(!empty($list)) {
			// 检测商品状态
			foreach($list as $cart) {
				$count = intval($cart['count']);
				if($cart['paimai']) {
					if(intval($cart['paimai']['status']) == 2) {
						$db->delete($cart['id']);
						$cart['status'] = 1; // 竞拍已结束
					}
				} else if($cart['good']) {
					if(intval($cart['good']['status']) == 2) {
						$db->delete($cart['id']);
						$cart['status'] = 1; // 商品已结束
					} else {
						$shengyurenshu = intval($cart['good']['shengyurenshu']);
						if($shengyurenshu < $count) {
							$cart['count'] = $shengyurenshu;
						}
						
						if($cart['qishu'] != $cart['good']['qishu']) {
							$data = array();
							$data['id'] = $cart['id'];
							$data['qishu'] = $cart['good']['qishu'];
							$db->save($data);
							$cart['qishu'] = $cart['good']['qishu'];
						}
					}
				}
			}
			
			$this->assign('list', $list);
		}
		
		$this->display();
    }
	
	public function add($gid, $type) {
		$db = D('cart');
		$map['gid'] = $gid;
		$map['type'] = $type;
		$map['uid'] = get_temp_uid();
		$exists = $db->where($map)->relation(true)->find();
		$result = array();
		if(empty($exists)) {
			$data['gid'] = $gid;
			$data['uid'] = get_temp_uid();
			$data['type'] = $type;
			$data['flag'] = is_login() ? 1 : 0; // 0 没有登陆， 1登陆
			
			if($db->add($data)) {
				$result['status'] = 0;
				$result['message'] = '添加成功';
			} else {
				$result['status'] = 1;
				$result['message'] = '添加失败';
			}
		} else {
			if($exists['paimai']) {
				$result['status'] = 2;
				$result['message'] = '商品已经添加';
			} else if($exists['good'] && intval($exists['good']['xiangou']) > 0
				&& intval($exists['good']['xiangou']) == intval($exists['count'])) {
				$result['status'] = 3;
				$result['message'] = '该商品限购'.$exists['good']['xiangou'].'人次';
			} else if($exists['good'] && intval($exists['count']) >= intval($exists['good']['shengyurenshu'])) {
				$result['status'] = 4;
				$result['message'] = '该商品剩余'.$exists['good']['shengyurenshu'].'人次';
			} else {
				// 存在，累加
				$data['count'] = intval($exists['count']) + 1;
				$data['id'] = $exists['id'];
				if($db->save($data)) {
					$result['status'] = 0;
					$result['message'] = '添加成功';
				} else {
					$result['status'] = 1;
					$result['message'] = '添加失败';
				}
			}
		}
		$this->ajaxReturn($result);
	}
	
	public function edit($id, $count) {
		$db = D('cart');
		
		$exists = $db->where($map)->relation(true)->find($id);
		if($exists && $exists['good'] && 
			intval($exists['good']['xiangou']) < $count &&
			intval($exists['good']['xiangou']) >0) {
			$count = intval($exists['good']['xiangou']);
		}
		
		if($exists['good'] && $count > intval($exists['good']['shengyurenshu'])) {
			$count = intval($exists['good']['shengyurenshu']);
		}
		
		$data['id'] = $id;
		$data['count'] = $count;
		$row = $db->save($data);
		if($row > 0) {
			$result['count'] = $count;
			$result['status'] = 0;
			$result['message'] = '修改成功';
		} else {
			$result['status'] = 1;
			$result['message'] = '修改失败';
		}
		$this->ajaxReturn($result);
	}
	
	public function remove($id) {
		$db = M('cart');
		if($db->delete($id)) {
			$result['status'] = 1;
			$result['message'] = '删除成功';
		} else {
			$result['status'] = 0;
			$result['message'] = '删除失败';
		}
		$this->ajaxReturn($result);
	}
}