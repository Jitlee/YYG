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
		
		$db = M('cart');
		
		$uid = session("_uid");
		
		if(!($uid > 0)) {
			$uid = 0;
		}
		
		$sql = "select c.gid,c.qishu,c.count,c.id,c.type,c.time
			,title,thumb,shengyurenshu,danjia,xiangou, 0 qipaijia, 0 lijijia, 0 baozhengjin, 0 chujiacishu
			from __CART__ c inner join __MIAOSHA__ m on c.gid=m.gid and c.type < 3
			where uid=$uid and m.status < 2
			union all
			select c.gid,c.qishu,c.count,c.id,c.type,c.time
			,title,thumb,0 shengyurenshu, 0 danjia, 0 xiangou, qipaijia,lijijia,baozhengjin,chujiacishu
			from __CART__ c inner join __PAIMAI__ p on c.gid=p.gid and c.type = 3
			where uid=$uid and p.status < 2
			order by time desc";
		$list = $db->query($sql);
		if(!empty($list)) {
			$this->assign('list', $list);
		}
//		$list = $db->field("c.gid,c.qishu,c.count,c.id,c.type
//			,m.title m_title,m.thumb m_thumb,shengyurenshu,danjia,m.type m_type,xiangou
//			,p.title p_title,p.thumb p_thumb,qipaijia,lijijia,baozhengjin,chujiacishu")
//			->join("c left join __MIAOSHA__ m on c.gid=m.gid and c.qishu=m.qishu and c.type <> 3")
//			->join("left join __PAIMAI__ p on c.gid=p.gid and c.flag=3")
//			->where("c.uid=$uid and flag=1")->order("c.time desc")->select(); 
			
//		echo $db->getLastSql();
//		echo dump($list);
//		if(!empty($list)) {
//			// 检测商品状态
//			foreach($list as $cart) {
//				$count = intval($cart['count']);
//				if($cart['paimai']) {
//					if(intval($cart['paimai']['status']) == 2) {
//						$db->delete($cart['id']);
//						$cart['status'] = 1; // 竞拍已结束
//					}
//				} else if($cart['good']) {
//					if(intval($cart['good']['status']) == 3) {
//						$db->delete($cart['id']);
//						$cart['status'] = 1; // 商品已结束
//					} else {
//						$shengyurenshu = intval($cart['good']['shengyurenshu']);
//						if($shengyurenshu < $count) {
//							$cart['count'] = $shengyurenshu;
//						}
//						
//						if($cart['qishu'] != $cart['good']['qishu']) {
//							$data = array();
//							$data['id'] = $cart['id'];
//							$data['qishu'] = $cart['good']['qishu'];
//							$db->save($data);
//							$cart['qishu'] = $cart['good']['qishu'];
//						}
//					}
//				}
//			}
			
//			$this->assign('list', $list);
//		}
		
		$this->display();
    }
	
	public function add($gid, $type, $qishu=0) {
		$islogin=logincheck();
		if($islogin==0)
		{
			$result['status'] = 1000;
			$result['message'] = '未登录';
			$this->ajaxReturn($result);
			return;
		}
		$db = M('cart');
		$map['gid'] = $gid;
		$map['type'] = $type;
		$map['uid'] = session("_uid");
		$exists = $db->where($map)->find();
		$result = array();
		if(empty($exists)) {
			$data['gid'] = $gid;
			$data['uid'] = get_temp_uid();
			$data['type'] = $type;
			$data['flag'] = home_is_login() ? 1 : 0; // 0 没有登陆， 1登陆
			
			if($db->add($data)) {
				count_cart(1);
				$result['count'] = 1;
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
			count_cart(-1);
			$result['status'] = 0;
			$result['message'] = '删除成功';
		} else {
			echo $db->getLastSql();
			$result['status'] = 1;
			$result['message'] = '删除失败';
		}
		$this->ajaxReturn($result);
	}
}