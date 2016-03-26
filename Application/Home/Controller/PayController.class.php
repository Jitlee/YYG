<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 支付界面控制器
 */
class PayController extends Controller {

// 101: 余额不足
// 102: 积分不足
// 103: 支付金额不对
// 104: 修改预支付订单失败
// 105: 扣除余额失败
// 106: 增加消费积分失败
// 107: 修改预付订单状态为已支付－修改失败
// 201: 秒杀商品已经完结
// 202: 生成秒杀客户随即码失败
// 203: 计算秒杀结果失败
// 204: 获取中奖用户失败
// 205: 保存秒杀历史失败
// 206: 保存秒杀主表失败
// 207: 增加秒杀记录失败
// 301: 拍卖商品不允许立即价
// 302: 拍卖商品已结束
// 303: 增加出价纪录失败
// 304: 立即拍下商品失败
// 305: 归还拍卖保证金到个人余额失败
// 306：归还拍卖保证金到个人余额纪录资金流水失败
// 401: 增加保证金报名人数失败
// 402: 增加保证金纪录失败
// 403: 退还保证金记录失败
// 404: 扣除保证金个人余额失败

	public function index($payid){
		if(is_login()) {
			if(empty($payid)) {
				$payid = I('payid');
			}
			$db = D('Home/AccountGoods');
			$map['payid'] = $payid;
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
				if($cart['isbz'] == 1) { // 保证金
					$total += intval($cart['paimai']['baozhengjin']);
				} else {
					$total += intval($cart['paimai']['lijijia']);
				}
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
	 * 创建预支付订单
	 */
	public function createPrePay() {
		if(is_login()) {
			$adb = M('account');
			$cdb = D('cart');
			$agdb = M('AccountGoods');
			$result['status'] = -1;
			$adb->startTrans();
			$uid = get_temp_uid();
			$payid = \Org\Util\String::keyGen();
			$accountData = array(
				'payid'			=> $payid,
				'uid'			=> $uid,
				'type'			=> -1,
				'status'			=> 0
			);
			if($adb->add($accountData) !== FALSE) {
				$map['uid'] = $uid;
				$list = $cdb->where($map)->select();
				$result['status'] = 0;
				$result['message'] = '创建$accountData成功';
				// 复制购物车
				foreach($list as $cart) {
					$cart['payid'] = $payid;
					if($agdb->add($cart) === FALSE) {
						$result['status'] = -1;
						$result['message'] = '复制cart成功';
						break;
					}
				}
				
				// 清空购物车
				if($result['status'] == 0 && $cdb->where($map)->delete() === FALSE) {
					$result['status'] = -1; // 失败
					$result['message'] = $cdb->getLastSql();
				}
			}
			
			if($result['status'] == 0) {
				$adb->commit();
				$result['rst'] = $payid;
				empty_cart();
			} else {
				$adb->rollback();
			}
		} else { // 未登录
			$result['status'] = -2;
		}
		$this->ajaxReturn($result, 'JSON');
	}

	// 修改预支付订单的金额、积分、第三方金额
	function updatePrePay($payid, $money, $score, $thrid) {
		$status = $this->checkPrePay($payid, $money, $score, $thrid);
		if($status == 0) {
			$agdb = M('Account');
			$map['uid'] = get_temp_uid();
			$map['payid'] = $payid;
			$money = (float)$money;
			$score = (int)$score;
			$thrid = (float)$thrid;
			$data = array(
				'money'			=> $money, // 预使用余额
				'score'			=> $score, // 预使用积分
				'thrid'			=> $thrid  // 预第三方支付金额
			);
			if($agdb->where($map)->save($data) === FALSE) {
				$status = 104; // 修改预支付订单失败
			}
		}
		return $status;
	}
	
	// 检查支付是否合法
	function checkPrePay($payid, $money, $score, $thrid, $list = null) {
		$uid = get_temp_uid();
		$udb = M('member');
		
		$account = $udb->field('uid, money,score')->find($uid);
		$account['money'] = intval($account['money']);
		$account['score'] = intval($account['score']);
		
		if(empty($list)) {
			$agdb = D('Home/AccountGoods');
			$map['uid'] = $uid;
			$map['payid'] = $payid;
			$list = $cdb->where($map)->relation(true)->select();
		}
		$total = $this->total($list);
		if($account['money'] < $money) {
			return 101;  // 余额不足
		} if($account['score'] < $score) {
			return 102;  // 积分不足
		} else if($money + $thrid + ($score / 100) < $total) {
			return 103;  // 付款金额不对
		}
		return 0;
	}
	
	// 支付订单
	function pay($payid) {
		$adb = M('Account');
		$adb->startTrans();
		$status = $this->doPay($payid);
		if($status == 0) {
			$adb->commit();
		} else {
			$adb->rollback();
		}
		return $status;
	}

	// 支付订单
	function doPay($payid) {
		$udb = M('Member');
		$adb = M('Account');
		$msdb = M('MemberScore');
		$agdb = D('Home/AccountGoods');
		
		$status = 0;
		$uid = get_temp_uid();
		$amap['uid'] = $uid;
		$amap['payid'] = $payid;
		
		// 第一步 查询所购商品
		$list = $agdb->where($amap)->relation(true)->select();
		
		// 第二步 检测余额是否足够 
		$adata = $adb->where($amap)->find();
		$money = (float)$adata['money'];  // 余额
		$score = (int)$adata['score'];    // 积分
		$third = (float)$adata['third'];  // 第三方支付金额
		$status = $this->checkPrePay($payid, $money, $score, $thrid, $list);
		if($status != 0) {
			return $status;
		}
		
		// 第三步 结算商品
		for($list as $cart) {
			$goodsType = intval($cart['type']);
			if($goodsType == 3) { // 拍卖
				if(intval($cart['isbz'] == 1)) { // 保证金
					$status = $this->doPayBaozhengjin($cart['paimai']['gid'], $third);
				} else {
					// 立即拍卖出价购买
					$status = $this->paimai($cart);
				}
<<<<<<< HEAD
			} else { // 秒杀
				$status = $this->miaosha($cart);
			}
			if($status != 0) {
				return $status;
=======
				if($status == 0) {
					// 清空购物车
					$cdb->where('uid='.$account['uid'])->delete();
					empty_cart();
				}
			} else {
				$status = 2; // 查询购物车失败
>>>>>>> origin/master
			}
		}
		
		// 第四步 扣除个人余额
		$member = array(
			'money'				=> array('exp', '`money` - '.$money),
			'score'				=> array('exp', '`score` + '.$third),// 第三方支付增加消费积分(1:1)
		);
		if($udb->where(array('uid' => $uid))->save($account) === FALSE) {
			return 105; // 扣除个人余额失败
		}
		
		// 第五步 增加消费纪录流水
		$msdata = array(
			'uid'			=> $uid,
			'scoresource'	=> '购买商品',
			'score'			=> $third,
		);
		if($msdb->add($msdata) === FALSE) {
			return 106; // 增加消费纪录流水失败
		}
		
		// 第六步 修改account状态为1
		if($adb->where($amap)->save(array('status'	=> 1)) === FALSE) {
			return 107; // 修改预付订单状态为已支付－修改失败
		}
		
		return 0;
		
	}
	
	/**
	 * 结算保证金
	 */
	private function doPayBaozhengjin($gid, $third, $money) {
		$uid = get_temp_uid();
		$pdb = M('paimai');
		$adb = M('account');
		$udb = M('member');
		$pmap['gid'] = $gid;
		$pmap['status'] = array('lt', 2);
		$good = $pdb->where($pmap)->field('gid,baozhengjin, baomingrenshu')->find();
		if($good) {
			// 商品还存在，还没结束			
			// 保存商品状态
			$data['gid'] = $gid;
			$data['status'] = 1;
			// 增加报名人数
			$data['baomingrenshu'] = intval($good['baomingrenshu']) + 1;
			if($pdb->save($data) === FALSE) {
				return 401; // 增加报名人数失败
			}
			
			// 增加缴纳保证金记录
			$mpdb = M('MemberPaimai');
			$mpdata['uid'] = $uid;
			$mpdata['gid'] = $good['gid'];
			$mpdata['flag'] = 0;
			$mpdata['money'] = $good['baozhengjin'];
			if($mpdb->add($mpdata) === FALSE) {
				return 402; // 增加保证金纪录失败
			}
		} else if($third > 0) {
			// 商品已结束
			// 第三方支付的钱转到余额
			// 增加消费记录
			$adata = array(
				'uid'			=> $uid,
				'type'			=> 1, // 充值
				'third'			=> $third, // 第三方支付类型
				'content' 		=> '退还商品保证金到余额，商品id['.$gid.']',
			);
			if($adb->add($adata) == FALSE) {
				return 403; // 增加消费记录失败
			}
		
			// 退还个人账户余额
			$member = array('money'		=> array('exp', '`money` + '.$third));
			if($udb->where(array('uid'	=> $uid))->save($member) == FALSE) {
				return 404; // 扣除个人余额失败
			}
		}
		add_renci(1);
		return 0;
	}
	
	function miaosha($cart) {
		// 更新秒杀主记录
		$mdb = M('Miaosha');
		$good = $mdb->find($cart['good']['gid']);
		$good['zongrenshu'] = intval($good['zongrenshu']);
		$good['canyurenshu'] = min(intval($good['canyurenshu']) + intval($cart['count']), $good['zongrenshu']);
		$good['shengyurenshu'] = $good['zongrenshu'] - $good['canyurenshu'];
		
		if(intval($good['status']) == 2) {
			return 201;  // 商品已经完结
		}
			
		$mmdb = M('MemberMiaosha');
		// 添加用户秒杀记录
		$data['uid'] = $cart['uid'];
		$data['gid'] = $cart['good']['gid'];
		$data['count'] = intval($cart['count']);
		$data['qishu'] = $good['qishu'];
		$data['canyu'] = $good['canyurenshu']; // 记录当前参与人数，用于计算中奖结果  （已废弃）
		$mid = $mmdb->add($data); // 增加秒杀纪录
		if($mid !== FALSE) {
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
					'uid'		=> $cart['uid'],
					'pcode'		=> $code, // 生成随机码
				);
				
				if($cdb->add($cdata) == FALSE) {
					return 202; // 生成客户随即码失败
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
					return 203; // 计算结果失败
				}
				
				$prize = intval($query[0]) % $good['canyurenshu'];
				$cmap['gid'] = $good['gid'];
				$cmap['qishu'] = $good['qishu'];
				$presult = $cdb->field('uid, pcode')->where($cmap)->page($prize + 1, 1)->find();
				if(!$presult) {
					return 204; // 获取中奖用户失败
				}
				
				$good['status'] = 2;
				$good['prizecode'] = $prize;
				$good['prizeuid'] = $presult['uid'];
				$good['end_time'] = date('y-m-d-H-i-s');
				
				$hdb = M('MiaoshaHistory');
				if(!$hdb->add($good)) {
					return 205; // 保存历史失败
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
			
			return 206; // 保存主表失败
		}
		return 207; // 增加秒杀记录失败
	}

	function paimai($cart) {
		$adb = M('account');
		$mpdb = M('MemberPaimai');
		$mdb = M('member');
		$pdb = M('paimai');
		
		$good = $cart['paimai'];
		$lijijia = intval($good['lijijia']);
		$good['chujiacishu'] = intval($good['chujiacishu']);
		$status = intval($good['status']);
		if($lijijia == 0) {
			return 301; // 商品不允许立即价
		}
		if($status >= 2) {
			return 302; // 商品已结束
		}
		
		// 增加出价记录
		$mpdata['uid'] = $cart['uid'];
		$mpdata['gid'] = $good['gid'];
		$mpdata['flag'] = 2; // 立即揭标
		$mpdata['money'] = $lijijia;
		if($mpdb->add($mpdata) === FALSE) {
			return 303; // 增加出价纪录失败
		}
		
		$good['chujiacishu']++;
		$good['zuigaojia'] = $lijijia;
		$good['chujiazhe'] = $cart['uid'];
		$good['status'] = 2; // 商品已结束
		$good['liji'] = 1; // 立即拍下的商品
		$good['prizeuid'] = $cart['uid']; // 中奖者
		if($pdb->where(array('gid' => $good['gid']))->save($good) === FALSE) {
			return 304; // 立即拍下商品失败
		}
		
		// 归还保证金
		$mpfilter['gid'] = $good['gid'];
		$mpfilter['flag'] = 0; // 保证金
		// 立即拍，本人须退还保证金
		// $mpfilter['uid'] = array('neq', $good['prizeuid']); // 过滤拍得者
		$records = $mpdb->where($mpfilter)->select();
		if(!empty($records)) {
			foreach($records as $record) {
				// 将保证金退还给个人余额
				if($mdb->where(array('uid' => $record['uid']))->save(array('money'	=> array('exp', '`money` + '.$record['money']))) === FALSE) {
					return 305; // 归还拍卖保证金到个人余额失败
				}
				
				// 记录资金流水
				$adata = array(
					'uid'			=> $record['uid'],
					'type'			=> 1, // 退款
					'money'			=> $record['money'],	// 余额
					'content' 		=> '退还保证金,商品id['.$good['gid'].']',
				);
				
				if($adb->add($adata) !== FALSE) {
					return 306;  // 归还拍卖保证金到个人余额纪录资金流水失败
				}
			}
		}
		return 0;
	}

	public function topay($payid) {
		$third = (float)$_POST["third"];  // 第三方付款
		$money = (float)$_POST["money"]; // 余额支付
		$score = (int)$_POST["score"]; // 积分支付
		
		$result['status'] = $this->updatePrePay($payid, $money, $score, $thrid);
		if($status != 0) { // 计算余额失败
			$this->ajaxReturn($result, 'JSON');
			return;
		}
		
		if($thrid > 0) { // 需要第三方支付
			// TODO: 第三方支付接口
		} else { // 本地直接支付
			$result['status'] = $this->pay($payid);
			if($result['status'] == 0) {
				$this->redirect('支付成功', 'success');
			}
		}
		$this->ajaxReturn($result, 'JSON');
	}
}