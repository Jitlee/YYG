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
				$total = $this->total($list);
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
	
	function total($list) {
		$total = 0;
		foreach($list as $cart) {
			if($cart['type'] == 3) {
				$total += intval($cart['paimai']['lijijia']);
			} else {
				$total += intval($cart['good']['danjia']) * intval($cart['count']) ;
			}
		}
		return $total;
	}
	
	public function baozhengjin($gid) {
		$db = M('paimai');
		$data = $db->field('gid, title, baozhengjin, thumb')->find($gid);
		$this->assign('data', $data);
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
					$total =$total = $this->total($list);
					
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
							$this->ajaxReturn($result, 'JSON');
						}
					}
				} else {
					$result['status'] = 2;
					$this->ajaxReturn($result, 'JSON');
				}
			} else {
				$result['status'] = 1;
				$this->ajaxReturn($result, 'JSON');
			}
		}
	}
	
	private function doPay($list) {
		$sys = M('cart');
		$sys->startTrans();
		$status = 0;
		
		$user = session('user');
		$uid = $user['uid'];
					
		$pdb = M('MemberPaimai');
		foreach($list as $cart) {
			if(intval($cart['type']) == 3) {
//				// 拍卖
//				$data['uid'] = $uid;
//				$data['gid'] = $cart['paimai']['gid'];
//				$data['flag'] = 3; // 立即按揭
//				$data['money'] = $cart['paimai']['lijijia'];
//				if(!$pdb->add($data)) {
//					$success = false;
//				}
			} else {
				$this->miaosha($cart, $uid);
			}
			if($status != 0) {
				break;
			}
		}
		
		if($status == 0) {
			// 清空购物车
			$sys->where('uid='.$uid)->delete();
		}		
		
		$result['status'] = $status;
		if($status == 0) {
			$sys->commit();
			$this->ajaxReturn($result, 'JSON');
		} else {
			$sys->rollback();
			$this->ajaxReturn($result, 'JSON');
		}
	}
	
	function miaosha($cart, $uid) {
		// 更新秒杀主记录
		$mdb = M('Miaosha');
		$good = $mdb->field('gid, canyurenshu, shengyurenshu, zongrenshu, jishijiexiao, status')->find($cart['good']['gid']);
		$good['zongrenshu'] = intval($good['zongrenshu']);
		$good['canyurenshu'] = min(intval($good['canyurenshu']) + intval($cart['count']), $good['zongrenshu']);
		$good['shengyurenshu'] = $good['zongrenshu'] - $good['canyurenshu'];
			
		$mmdb = M('MemberMiaosha');
		// 添加用户秒杀记录
		$data['uid'] = $uid;
		$data['gid'] = $cart['good']['gid'];
		$data['count'] = $cart['count'];
		$data['canyu'] = $good['canyurenshu']; // 记录当前参与人数，用于计算中奖结果
		if($mmdb->add($data)) {
			$good['status'] = 1; // 修改状态为已购买
			// 结果判断
			if($good['shengyurenshu'] == 0) {
				// 计算结果
				// 公式： 中奖号码  = 最后所有商品100条购买时间时分秒之和  % 参与人数 + 原始号
				$sql = 'SELECT SUM(HOUR(TIME)+MINUTE(TIME)+SECOND(TIME)+MICROSECOND(TIME)) FROM yyg_member_miaosha';
				if(intval($good['jishijiexiao']) == 0) { // 非即时揭晓
					$sql = $sql . ' WHERE gid = ' . + $good['gid'];
				}
				$sql = $sql . ' ORDER BY `time` DESC LIMIT 100';
				
				$query = $mdb->query($sql);
				if(empty($query)) {
					return 7; // 计算结果失败
				}
				
				$prizecode = intval($query[0]) % $good['canyurenshu'];
				
				$good['status'] = 2;
				
				$good['prizecode'] = $prizecode + 10000001;
				
				// 查询获奖者
				$sql = 'SELECT `uid` FROM yyg_member_miaosha WHERE `gid` = ' . $good['gid'] . ' AND ' . $prizecode . ' BETWEEN `canyu`-`count` AND `canyu`';
				$query = $mmdb->query($sql);
				
				if(empty($query)) {
					return 8; // 计算结果中奖用户失败
				}
				
				$good['prizeuid'] = $query[0]['uid'];
			}

			if($mdb->save($good)) {
				return 0;
			}
			
			return 9; // 保存主表失败
		}
		return 5; // 增加秒杀记录失败
	}

	public function success() {
		layout(false);
		$this->display();
	}
}