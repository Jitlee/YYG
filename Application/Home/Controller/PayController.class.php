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
	
	public function thridpay() {
		if(IS_POST) {
			$params = json_decode(htmlspecialchars_decode(file_get_contents('php://input')));
			if(!($params->third > 0) || $params->channel) {
				 exit();
			}
			
			$amount = $params->third;
			$channel = $params->channel;
			$orderNo = substr(md5(time()), 0, 12);
			$extra = array();
        		switch ($channel) {
	            	case 'alipay_wap' :
	                $extra['success_url'] = U('success', '', '');
					$extra['cancel_url'] = U('cancel', '', '');
	                break;
			}
			\Pingpp\Pingpp::setApiKey('sk_test_48SSW5e1GqDKv9qnP8vLevLC');
			try {
				$ch = \Pingpp\Charge::create(
					array(
						'subject' 		=> 'Your Subject',
						'body' 			=> 'Your Body',
						'amount' 		=> $amount,
						'order_no' 		=> $orderNo,
						'currency' 		=> 'cny',
						'extra' 			=> $extra,
						'channel' 		=> $channel,
         				'client_ip' 		=> get_client_ip(),
         				'app' => array('id' => 'app_5K8yzLfvnT4Gaj1S')
					)
				);
             	echo $ch;
			 	exit;
			} catch (\Pingpp\Error\Base $e) {
	            header("Content-type:text/html;charset=utf-8");
	            echo($e->getHttpBody());
	        }
		}
	}
	
	public function localpay() {
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
					$account = $db->field('uid, money,score')->find($uid);
					$account['money'] = floatval($account['money']);
					$account['score'] = floatval($account['score']);
					
					$_pay = array(
						'money'		=> floatval($_POST['money']),
						'score'		=> floatval($_POST['score']),
						'third'		=> floatval($_POST['third']),
					);
					$this->doPay($list, $account, $_pay);
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
	
	private function doPay($list, $account, $_pay) {
		$sys = M('cart');
		$sys->startTrans();
		$status = 0;
					
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
				$status = $this->miaosha($cart, $account);
			}
			if($status != 0) {
				break;
			}
		}
		
		if($status == 0) {
			// 清空购物车
			$sys->where('uid='.$account['uid'])->delete();
			// 增加消费记录
			$adb = M('account');
			$adata = array(
				'uid'			=> $account['uid'],
				'type'			=> -1, // 付款
				'money'			=> $_pay['money'],	// 余额
				'score'			=> $_pay['score'],  // 积分
				'third'			=> $_pay['third'],  // 第三方支付
				'third_type'		=> $_pay['thirdType'], // 第三方支付类型
				'content' => '购买商品',
			);
			if($adb->add($adata)) {
				// 扣除个人账户余额
				$account['money'] -= $_pay['money'];
				$account['score'] -= $_pay['score'];
				$udb = M('member');
				if(!$udb->save($account)) {
					$status = 12; // 扣除个人余额失败
				}
			} else {
				$status = 11; // 增加消费记录失败
			}
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
	
	function miaosha($cart, $account) {
		// 更新秒杀主记录
		$mdb = M('Miaosha');
		$good = $mdb->find($cart['good']['gid']);
		$good['zongrenshu'] = intval($good['zongrenshu']);
		$good['canyurenshu'] = min(intval($good['canyurenshu']) + intval($cart['count']), $good['zongrenshu']);
		$good['shengyurenshu'] = $good['zongrenshu'] - $good['canyurenshu'];
		
		if(intval($good['status']) == 2) {
			return 3;  // 商品已经完结
		}
			
		$mmdb = M('MemberMiaosha');
		// 添加用户秒杀记录
		$data['uid'] = $account['uid'];
		$data['gid'] = $cart['good']['gid'];
		$data['count'] = intval($cart['count']);
		$data['qishu'] = $good['qishu'];
		$data['canyu'] = $good['canyurenshu']; // 记录当前参与人数，用于计算中奖结果  （已废弃）
		if($mmdb->add($data)) {
			// 生成购买记录随机码
			$codes = array();
			for($i = 0; $i < $good['zongrenshu']; ++$i) {
				array_push($codes, $i);
			}
			
			$cdb = M('MiaoshaCode');
			$cmap['gid'] = $good['gid'];
			$cmap['qishu'] = $good['qishu'];
			$clist = $cdb->where($cmap)->field('pcode')->select();
			
			// 去掉已使用的
			if(!empty($clist)) {
				foreach($clist as $c) {
					unset($codes[intval($c['pcode'])]);
				}
				$codes = array_values($codes); // 重建索引
			}
			
			for($i = 0; $i < $data['count']; ++$i) {
				$offset = rand(0, count($codes) - 1);
				$code = $codes[$offset];
				array_splice($codes, $offset, 1);
				
				$cdata = array(
					'gid'		=> $good['gid'],
					'qishu'		=> $good['qishu'],
					'uid'		=> $account['uid'],
					'pcode'		=> $code, // 生成随机码
				);
				
				if(!$cdb->add($cdata)) {
					return 13; // 生成客户随即码失败
				}
			}
			
			$good['status'] = 1; // 修改状态为已购买
			// 结果判断
			if($good['shengyurenshu'] == 0) {
				// 计算结果
				// 公式： 中奖号码  = 最后所有商品100条购买时间时分秒之和  % 参与人数 + 原始号
				$sql = 'SELECT SUM(HOUR(TIME)+MINUTE(TIME)+SECOND(TIME)+MICROSECOND(TIME)) FROM yyg_member_miaosha';
//				if(intval($good['jishijiexiao']) == 0) { // 非即时揭晓
//					$sql = $sql . ' WHERE gid = ' . + $good['gid'];
//				}
				$sql = $sql . ' ORDER BY `time` DESC LIMIT 100';
				
				$query = $mdb->query($sql);
				if(empty($query)) {
					return 7; // 计算结果失败
				}
				
				$prize = intval($query[0]) % $good['canyurenshu'];
				// 获取获奖者和号码
//				$sql = printf('SELECT * FROM yyg_miaosha_code WHERE gid = %s  AND qishu = %s ASC LIMIT %s,1;',
//					$good['gid'], $good['qishu'], $prize);
				
				$cmap['gid'] = $good['gid'];
				$cmap['qishu'] = $good['qishu'];
				$presult = $cdb->field('uid, pcode')->where($cmap)->page($prize + 1, 1)->find();
				if(empty($query)) {
					return 8; // 获取中奖用户失败
				}
				
				$good['status'] = 2;
				$good['prizecode'] = 10000001 + intval($presult['pcode']);
				$good['prizeuid'] = $presult['uid'];
				
				// 查询获奖者
				/** 已废弃
//				$sql = 'SELECT `uid` FROM yyg_member_miaosha WHERE `gid` = ' . $good['gid'] . ' AND ' . $prizecode . ' BETWEEN `canyu`-`count` AND `canyu`';
//				$query = $mmdb->query($sql);
				**/
//				
//				
//				
//				if(empty($query)) {
//					return 8; // 计算结果中奖用户失败
//				}
//				
//				$good['prizeuid'] = $query[0]['uid'];
				
				$hdb = M('MiaoshaHistory');
				if(!$hdb->add($good)) {
					return 10; // 保存历史失败
				}
				
				// 更新期数
				$maxqishu = intval($good['maxqishu']);
				$qishu = intval($good['qishu']);
				if($qishu <= $maxqishu) {
					// 重新开始
					$good['qishu'] = $qishu + 1;
					$good['status'] = 0;
					$good['prizeuid'] = null;
					$good['prizecode'] = null;
					$good['canyurenshu'] = 0;
					$good['shengyurenshu'] = $good['zongrenshu'];
				}
			}

			if($mdb->save($good)) {
				return 0;
			}
			
			return 9; // 保存主表失败
		}
		return 5; // 增加秒杀记录失败
	}

	public function success() {
		echo dump($_POST);
		echo '-----';
		$params = json_decode(htmlspecialchars_decode(file_get_contents('php://input')));
		echo dump($params);
		
		layout(false);
		$this->display();
	}
	
	public function cancel() {
		layout(false);
		$this->display();
	}
}