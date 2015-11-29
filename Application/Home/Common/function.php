<?php

function get_temp_uid() {
	$uid = session("_uid");
	if(empty($uid)) {
		$user = session('user');
		if(empty($user)) {
			$uid = mt_rand(10, 100000);
		} else {
			$uid = $user['uid'];
		}
		session("_uid", $uid);
	}
	return $uid;
}


function is_login() {
	$admin = session('wxUserinfo');
	if(empty($admin)) {
		return 0;
	} else {
		define('UID', $admin['uid']);
		define('username', $admin['username']);
		define('reg_key', $admin['reg_key']);
		return 1;
	}
}

function run_task() {
	$path = $_SERVER['DOCUMENT_ROOT'] . '/task';
	$is_running = false;
	$now = time();
	
	// check task
	if(file_exists($path)) {
		$file = fopen($taskFile, 'r');
		$line = fgets($file);
		$last = intval($line);
		if($now - $last < 300) { // 超时时间5分钟
			$is_running = true;
		}
		fclose($file);
	}
	
	if($is_running) {
		return;
	}
	
	//========================
	// 启动后台任务
	ignore_user_abort(true);
	set_time_limit(0);
	
	// mark task
	$file= fopen($path,'w');
	fwrite($file,$now);
	fclose($f);
	
	// run task;
	
	// 步骤 1：终结未结束的即将揭晓商品
	finish_jiexiao();
	
	// 步骤 2: 终结拍卖结果
	finish_paimai();
}

function finish_jiexiao() {
	$mdb = M('Miaosha');
	$list = $mdb->where('status < 2 and jishijiexiao > 0 and end_time < current_timestamp()')->select();
	if(!empty($list)) {
		foreach($list as $good) {
			$status = 0;
			$mdb->startTrans();
			$good['qishu'] = intval($good['qishu']);
			$good['maxqishu'] = intval($good['maxqishu']);
			$good['canyurenshu'] = intval($good['canyurenshu']);
			$endTime = $good['end_time'];
			
			// 计算中奖结果
			$sql = 'SELECT SUM(HOUR(TIME)+MINUTE(TIME)+SECOND(TIME)+MICROSECOND(TIME)) FROM yyg_member_miaosha where `time` < \'％s\'  ORDER BY `time` DESC LIMIT 100';
			$query = $mdb->query($sql);
			$prize = 0;
			$prizeuid = 0;
			if(!empty($query)) {
				$prize = intval($query[0]) % $good['canyurenshu'];
				
				// 查找中奖用户
				$cdb = M('MiaoshaCode');
				$cmap['gid'] = $good['gid'];
				$cmap['qishu'] = $good['qishu'];
				$presult = $cdb->field('uid, pcode')->where($cmap)->page($prize + 1, 1)->find();
				if($presult) {
					$prizeuid = $presult['uid'];
				}
			}
			
			$good['status'] = 2;
			$good['prizecode'] = 10000001 + $prize;
			$good['prizeuid'] = $presult['uid'];
			
			$hdb = M('MiaoshaHistory');
			$hresult = $hdb->add($good);
			
			if($good['qishu'] < $good['maxqishu']) {
				// 重新开始
				$good['qishu'] = $good['qishu'] + 1;
				$good['status'] = 0;
				$good['prizeuid'] = null;
				$good['prizecode'] = null;
				$good['canyurenshu'] = 0;
				$good['shengyurenshu'] = $good['zongrenshu'];
				
				$jishi = intval($good['jishijiexiao']);
				$now = time();
				$end_time = $now + $jishi * 3600;
				$good['end_time'] =  date('y-m-d-H-i-s', $end_time);
			}
			$mresult = $mdb->save($good);
			if($hresult && $mresult) {
				$mdb->commit();	
			} else {
				$mdb->rollback();	
			}
		}
	}
}

function finish_paimai() {
	$pdb = M('paimai');
	$mpdb = M('MemberPaimai');
	$adb = M('account');
	$mdb = M('member');
	$list = $pdb->field('gid,chujiazhe, baoliujia,zuigaojia, chujiazhe,status')->where('status < 2 and end_time < current_timestamp()')->select();
	if(!empty($list)) {
		foreach($list as $good) {
			$pdb->startTrans();
			$success = true;
			
			// 计算中奖者
			if(floatval($good['zuigaojia']) >= floatval($good['baoliujia'])) {
				$good['prizeuid'] = $good['chujiazhe'];
			}
			
			// 归还保证金
			$mpfilter['gid'] = $good['gid'];
			$mpfilter['flag'] = 0; // 保证金
			$mpfilter['uid'] = array('neq', $good['prizeuid']); // 过滤拍得者
			$records = $mpdb->where($mpfilter)->select();
			if(!empty($records)) {
				foreach($records as $record) {
					// 将保证金退还给个人余额
					$member = $mdb->field('uid, money')->find($record['uid']);
					if($member) {
						$member['money'] = floatval($member['money']) + floatval($record['money']);
						if(!$mdb->save($member)) {
							$success = false;
						}
					}
					
					if($success) {
						// 记录资金流水
						$adata = array(
							'uid'			=> $record['uid'],
							'type'			=> 1, // 退款
							'money'			=> $record['money'],	// 余额
							'content' 		=> '退还保证金',
						);
						
						if(!$adb->add($adata)) {
							$success = false;
						}
					}
					
					if(!$success) {
						break;
					}
				}
			}
			
			// 保存状态
			$good['status'] = 2;
			if(!$pdb->save($good)) {
				$success = false;
			}
			
			if($success) {
				$pdb->commit();
			} else {
				$pdb->rollback();
			}
		}
	}
}
