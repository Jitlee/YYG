<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 支付界面控制器
 */
class PayController extends Controller {
	
//	1; // 没有登陆
//	2; // 查询购物车失败
//	3  // 商品已经完结
//	5; // 增加秒杀记录失败
//	7; // 计算结果失败
//	8; // 获取中奖用户失败
//	9; // 保存主表失败
//	10; // 保存历史失败
//	11; // 增加消费记录失败
//	12; // 扣除个人余额失败
//	13; // 生成客户随即码失败
//	14;  // 余额不足
//	15;  // 需要第三方支付
//	16;  // 付款金额不对
//	17;  // 保存保证金失败
//	18;  // 支付失败
//	19;  // session数据丢失
//	20;  // 商品不允许立即价
//	21;  // 保存出价记录失败
//  22;  // 保存最高价失败
//  23;  // 增加消费积分失败
//  24;  // 积分不足
//  25;  // 修改拍卖商品状态、报名人数失败
	
	public function index(){
		if(is_login()) {
			$db = D('cart');
			$map['uid'] = get_temp_uid();
			$list = $db->where($map)->relation(true)->select();
			if(!empty($list)) {
				$this->assign('list', $list);
				$total = $this->total($list);
				$this->assign('total', $total);
			}
			
			$uid = get_temp_uid();
			$db = M('member');
			$user = $db->field('money,score')->find($uid);
			$score = intval($user['score']);
			$user['_score'] = $score;
			$score = floor($score / 100) * 100;
			$user['score'] = $score;
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
		$this->assign('total', $data['baozhengjin']);
		
		$user = session('user');
		$uid = $user['uid'];
		$db = M('member');
		$user = $db->field('money,score')->find($uid);
		$this->assign('account', $user);
		
    		$this->assign('title', '保证金');
		layout(false);
		$this->display();
	}
	
	/**
	 * 第三方支付
	 */
//	public function thirdpay() {
//		if(IS_POST) {
//			vendor( "PingppSDK.init");
//			
//			$params = json_decode(file_get_contents('php://input'));
//			if(!($params->third > 0) || empty($params->channel)) {
//				echo $params->third;
//				exit();
//			}
//			
//			$amount = $params->third;
//			$channel = $params->channel;
//			$orderNo = md5(time());
//			session('_trade_no_', $orderNo);
//			
//			session($orderNo, array(
//				'money'			=> $params->money,
//				'third'			=> $params->third,
//				'score'			=> $params->score,
//				'bgid'			=> $params->bgid,
//			));
//			
//			$extra = array();
//      		switch ($channel) {
//	            	case 'alipay_wap' :
//	                $extra['success_url'] = 'http://' . $_SERVER['HTTP_HOST'] . U('thirdpaysuccess', '', '');
//					$extra['cancel_url'] = 'http://' . $_SERVER['HTTP_HOST'] . U('cancel', '', '');
//	                break;
//			}
//			\Pingpp\Pingpp::setApiKey('sk_test_48SSW5e1GqDKv9qnP8vLevLC');
//			try {
//				$ch = \Pingpp\Charge::create(
//					array(
//						'subject' 		=> 'Your Subject',
//						'body' 			=> 'Your Body',
//						'amount' 		=> $amount,
//						'order_no' 		=> $orderNo,
//						'currency' 		=> 'cny',
//						'extra' 		=> $extra,
//						'channel' 		=> $channel,
//       				'client_ip' 		=> get_client_ip(),
//       				'app' => array('id' => 'app_5K8yzLfvnT4Gaj1S')
//					)
//				);
//           	echo $ch;
//			 	exit;
//			} catch (\Pingpp\Error\Base $e) {
//	            header("Content-type:text/html;charset=utf-8");
//	            echo($e->getHttpBody());
//	        }
//		}
//	}

	// 第三方支付成功页面
	public function thirdpaysuccess() {
		layout(false);
		$tradeNo = I('request.out_trade_no');
		$result = I('request.result');
		if($result != 'success') {
			$this->assign('status', 18);
			$this->display('error');	
		} else if($tradeNo == session('_trade_no_') && session("?" . $tradeNo)) {
			session('_trade_no_', null);
			$_pay = session($tradeNo);
			$status = $this->pay(false, $_pay);
			if($status == 0) {
				$this->display('success');	
			} else { // TODO: 失败了没有机制
				$this->assign('status', $status);
				$this->display('error');	
			}
			session($tradeNo, null);
		} else {
			$this->assign('status', 19);
			$this->display('error');	
		}
	}
	
	/**
	 * 本地支付入口
	 */
	public function localpay() {
		if(IS_POST) {
			if(is_login()) {
				$_pay = array(
					'money'				=> intval($_POST['money']),
					'score'				=> intval($_POST['score']),
					'third'				=> intval($_POST['third']),
					'bgid'				=> $_POST['bgid'],
				);
				$status = $this->pay(true, $_pay);
				$this->ajaxReturn($status);
			} else {
				$this->ajaxReturn(1);
			}
		}
	}
	
	/**
	 * 普通商品和立即揭榜商品结算
	 */
	private function pay($needCheckThirdPay, $_pay) {
		$status = 0;
		$uid = get_temp_uid();
		$udb = M('member');
		$udb->startTrans();
		$account = $udb->field('uid, money,score')->find($uid);
		$account['money'] = intval($account['money']);
		$account['score'] = intval($account['score']);
		if($_pay['bgid']) { // 缴纳保证金
			$status = $this->doPayBaozhengjin($needCheckThirdPay, $account, $_pay);
		} else { // 购买商品
			$cdb = D('cart');
			$map['uid'] = get_temp_uid();
			$list = $cdb->where($map)->relation(true)->select();
			if(!empty($list)) {
				$total = $this->total($list);
				if($_pay['money'] + $_pay['third'] + ($_pay['score'] / 100) < $total) {
					$status = 16;  // 付款金额不对
				} else if($account['score'] < $_pay['score']) {
					$status = 24;  // 积分不足
				} else if($account['money'] < $_pay['money']) {
					$status = 14;  // 余额不足
				} else if($needCheckThirdPay && $_pay['third'] > 0) {
					$status = 15;  // 需要第三方支付
				}
				if($status == 0) {
					$status = $this->doPay($list, $account, $_pay);
				}
				if($status == 0) {
					// 清空购物车
					$cdb->where('uid='.$account['uid'])->delete();
					empty_cart();
				}				
			} else {
				$status = 2; // 查询购物车失败
			}
		}
		
		if($status == 0) {
			$udb->commit();
		} else {
			$udb->rollback();
		}
		
		return $status;
	}
	
	/**
	 * 结算保证金
	 */
	private function doPayBaozhengjin($needCheckThirdPay, $account, $_pay) {
		$pdb = M('paimai');
		$adb = M('account');
		$udb = M('member');
		$pmap['gid'] = $_pay['bgid'];
		$pmap['status'] = array('lt', 2);
		$good = $pdb->where($pmap)->field('gid,baozhengjin, baomingrenshu')->find();
		if($good) {
			// 商品还存在，还没结束			
			// 保存商品状态
			$data['gid'] = $_pay['bgid'];
			$data['status'] = 1;
			// 增加报名人数
			$data['baomingrenshu'] = intval($good['baomingrenshu']) + 1;
			if($pdb->save($data)) {
				echo $pdb->getLastSql();
				return 25;
			}
			
			// 验证
			$total = intval($good['baozhengjin']);
			if($_pay['money'] + $_pay['third'] < $total) {
				return 16;  // 付款金额不对
			} else if($account['money'] < $_pay['money']) {
				return 14;  // 余额不足
			} else if($needCheckThirdPay && $_pay['third'] > 0) {
				return 15;  // 需要第三方支付
			}
				
			// 增加消费记录
			$adata = array(
				'uid'			=> $account['uid'],
				'type'			=> -1, // 付款
				'money'			=> $_pay['money'], // 余额
				'third'			=> $_pay['third'], // 第三方支付类型
				'content' 		=> '缴纳保证金',
			);
			if($adb->add($adata)) {
				// 扣除个人账户余额
				$account['money'] -= $_pay['money'];
				$account['score'] += $_pay['third']; // 增加消费积分
				if(!$udb->save($account)) {
					return 12; // 扣除个人余额失败
				}
				
				if($_pay['third'] > 0) {
					// 增加消费积分记录
					$msdb = M('MemberScore');
					$msdata = array(
						'uid'			=> $account['uid'],
						'scoresource'	=> '缴纳拍卖保证金',
						'score'			=> $_pay['third'],
					);
					if(!$msdb->add($msdata)) {
						return 23; // 增加消费积分失败
					}
				}
			} else {
				return 11; // 增加消费记录失败
			}
			
			// 增加缴纳保证金记录
			$mpdb = M('MemberPaimai');
			$mpdata['uid'] = $account['uid'];
			$mpdata['gid'] = $good['gid'];
			$mpdata['flag'] = 0;
			$mpdata['money'] = $total;
			if(!$mpdb->add($mpdata)) {
				return 17; // 保存保证金记录失败
			}
		} else if($_pay['third'] > 0) {
			// 商品已结束
			// 第三方支付的钱转到余额
			// 增加消费记录
			$adata = array(
				'uid'			=> $account['uid'],
				'type'			=> 1, // 付款
				'third'			=> $_pay['third'], // 第三方支付类型
				'content' 		=> '退还商品保证金到余额',
			);
			if($adb->add($adata)) {
				// 扣除个人账户余额
				$account['money'] += $_pay['money'];
				if(!$udb->save($account)) {
					return 12; // 扣除个人余额失败
				}
			} else {
				return 11; // 增加消费记录失败
			}
		}
		add_renci(1);
		return 0;
	}
	
	/**
	 * 执行结算操作
	 */
	private function doPay($list, $account, $_pay) {
		$adb = M('account');
		$pdb = M('MemberPaimai');
					
		foreach($list as $cart) {
			if(intval($cart['type']) == 3) {
				// 拍卖-立即
				$status = $this->paimai($cart, $account);
			} else {
				// 秒杀
				$status = $this->miaosha($cart, $account);
			}
			
			if($status != 0) {
				return $status;
			}
		}
		
		// 增加消费记录
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
			$udb = M('member');
			// 扣除个人账户余额
			$account['money'] -= $_pay['money'];
			// 第三方支付增加消费积分(1:1)
			$account['score'] += $_pay['third'] - $_pay['score'];
			if(!$udb->save($account)) {
				return 12; // 扣除个人余额失败
			}
			
			if($_pay['third'] > 0) {
				// 增加消费积分记录(1:1)
				$msdb = M('MemberScore');
				$msdata = array(
					'uid'			=> $account['uid'],
					'scoresource'	=> '购买商品',
					'score'			=> $_pay['third'],
				);
				if(!$msdb->add($msdata)) {
					return 23; // 增加消费积分失败
				}
			}
		} else {
			return 11; // 增加消费记录失败
		}
		return 0;
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
		$mid = $mmdb->add($data);
		if($mid) {
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
				$codes = array_values($codes); // 重建索引
				
				$cdata = array(
					'mid'		=> $mid, // 购买记录主表ID
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
				$cmap['gid'] = $good['gid'];
				$cmap['qishu'] = $good['qishu'];
				$presult = $cdb->field('uid, pcode')->where($cmap)->page($prize + 1, 1)->find();
				if(!$presult) {
					return 8; // 获取中奖用户失败
				}
				
				$good['status'] = 2;
				$good['prizecode'] = $prize;
				$good['prizeuid'] = $presult['uid'];
				$good['end_time'] = date('y-m-d-H-i-s');
				
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
					$good['time'] = date('y-m-d-H-i-s');
					$jishi = intval($good['jishijiexiao']);
					if($jishi > 0) {
						$now = time();
						$end_time = $now + $jishi * 3600;
						$good['end_time'] =  date('y-m-d-H-i-s', $end_time);
					} else {
						$good['end_time'] = null;
					}
				}
			}

			if($mdb->save($good)) {
				add_renci($data['count']);
				return 0;
			}
			
			return 9; // 保存主表失败
		}
		return 5; // 增加秒杀记录失败
	}

	function paimai($cart, $account) {
		$good = $cart['paimai'];
		$lijijia = intval($good['lijijia']);
		$good['chujiacishu'] = intval($good['chujiacishu']);
		$status = intval($good['status']);
		$mpdb = M('MemberPaimai');
		if($lijijia > 0) {
			if($status < 2) {
				// 增加出价记录
				$mpdb = M('MemberPaimai');
				$mpdata['uid'] = $account['uid'];
				$mpdata['gid'] = $good['gid'];
				$mpdata['flag'] = 2; // 立即揭标
				$mpdata['money'] = $lijijia;
				if($mpdb->add($mpdata)) {
					$pdb = M('paimai');
					$good['chujiacishu']++;
					$good['zuigaojia'] = $lijijia;
					$good['chujiazhe'] = $account['uid'];
					$good['status'] = 2; // 商品已结束
					$good['liji'] = 1; // 立即拍下的商品
					$good['prizeuid'] = $account['uid']; // 中奖者
					if($pdb->save($good)) {
						// 归还保证金
						$mpdb = M('MemberPaimai');
						$adb = M('account');
						$mdb = M('member');
						$mpfilter['gid'] = $good['gid'];
						$mpfilter['flag'] = 0; // 保证金
						// 立即拍，本人须退还保证金
//						$mpfilter['uid'] = array('neq', $good['prizeuid']); // 过滤拍得者
						$records = $mpdb->where($mpfilter)->select();
						if(!empty($records)) {
							foreach($records as $record) {
								// 将保证金退还给个人余额
								$member = $mdb->field('uid, money')->find($record['uid']);
								if($member) {
									$member['money'] = intval($member['money']) + intval($record['money']);
									if(!$mdb->save($member)) {
										return 23;
									}
								}
								
								// 记录资金流水
								$adata = array(
									'uid'			=> $record['uid'],
									'type'			=> 1, // 退款
									'money'			=> $record['money'],	// 余额
									'content' 		=> '退还保证金',
								);
								
								if(!$adb->add($adata)) {
									return 24;
								}
							}
						}
						return 0;
					} else {
						return 22; // 保存最高价失败
					}
				} else {
					return 21; // 保存出价记录失败
				}
			} else {
				return 3; // 商品已结束
			}
		} else {
			return 20; // 商品不允许立即价
		}
	}

	public function success() {
		layout(false);
		$this->display();
	}
	
	public function cancel() {
		layout(false);
		$this->display();
	}
	
	public function error() {
		layout(false);
		$this->display();
	}
}