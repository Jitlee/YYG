<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 支付界面控制器
 */
class PayController extends Controller {
	
	public function index(){
		if(is_login()) {
			$db = D('cart');
			$list = $db->relation(true)->select();
			if(!empty($list)) {
				$this->assign('list', $list);
				$total = 0;
				foreach($list as $cart) {
					if(intval($cart['type']) == 3) {
						$total += intval($cart['paimai']['lijijia']);
					} else {
						$total += intval($cart['good']['danjia']) * intval($cart['count']) ;
					}
				}
				$this->assign('total', $total);
			}
			
			$user = session('user');
			$uid = $user['uid'];
			$db = M('member');
			$user = $db->field('money,score')->find($uid);
			$this->assign('account', $user);
	    		$this->assign('title', '结算支付');
			layout(false);
			$this->display();
		} else {
			$this->redirect('Home/Person/login/'.encode('Pay/index'));
		}
    }
	
	public function baozhengjin($gid) {
		$db = M('paimai');
		$data = $db->field('gid, title, baozhengjin, thumb')->find($gid);
		$this->assign("data", $data);
    		$this->assign('title', '保证金');
		layout(false);
		$this->display();
	}
	
	public function zhifu() {
		if(IS_POST) {
			$result = array();
			if(is_login()) {
				$db = D('cart');
				$list = $db->relation(true)->select();
				if(!empty($list)) {
					$this->assign('list', $list);
					$total = 0;
					foreach($list as $cart) {
						if($cart['type'] == 3) {
							$total += intval($cart['paimai']['lijijia']);
						} else {
							$total += intval($cart['good']['danjia']) * intval($cart['count']) ;
						}
					}
					
					$user = session('user');
					$uid = $user['uid'];
					$db = M('member');
					$user = $db->field('money,score')->find($uid);
					$userMoney = floatval($user['money']);
					$userScore = floatval($user['score']);
					
					$money = floatval($_POST['money']);
					if($money == $total) { // 全部余额付款
						if($money <= $userMoney) {
							// 余额充足
							$this->doPay($list);
						} else {
							$result['status'] = 3;
							$this->ajaxReturn($result, "JSON");
						}
					}
				} else {
					$result['status'] = 2;
					$this->ajaxReturn($result, "JSON");
				}
			} else {
				$result['status'] = 1;
				$this->ajaxReturn($result, "JSON");
			}
		}
	}
	
	private function doPay($list) {
		$sys = M('cart');
		$sys->startTrans();
		$success = true;
		
		$user = session('user');
		$uid = $user['uid'];
					
		$mdb = M('MemberMiaosha');
		$pdb = M('MemberPaimai');
		foreach($list as $cart) {
			$data = array();
			if(intval($cart['type']) == 3) {
				// 拍卖
				$data['uid'] = $uid;
				$data['gid'] = $cart['paimai']['gid'];
				$data['flag'] = 3;
				$data['money'] = $cart['paimai']['lijijia'];
				if(!$pdb->add($data)) {
					$success = false;
				}
			} else {
				// 秒杀
				$data['uid'] = $uid;
				$data['gid'] = $cart['good']['gid'];
				$data['count'] = $cart['count'];
				if(!$mdb->add($data)) {
					$success = false;
				}
			}
			unset($data);
			if(!$success) {
				break;
			}
		}
		if($success) {
			$sys->commit();
			$result['status'] = 0;
			$this->ajaxReturn($result, "JSON");
		} else {
			$sys->rollback();
			$result['status'] = 4;
			$this->ajaxReturn($result, "JSON");
		}
	}
}