<?php

function check_verify($code, $id = '') {
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}

/**
 * 删除目录或者文件
 * @param  string  $path
 * @param  boolean $is_del_dir
 * @return fixed
 */
function del_dir_or_file($path, $is_del_dir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        // $path为目录路径
        while (false !== ($item = readdir($handle))) {
            // 除去..目录和.目录
            if ($item != '.' && $item != '..') {
                if (is_dir("$path/$item")) {
                    // 递归删除目录
                    del_dir_or_file("$path/$item", $is_del_dir);
                } else {
                    // 删除文件
                    unlink("$path/$item");
                }
            }
        }
        closedir($handle);
        if ($is_del_dir) {
            // 删除目录
            return rmdir($path);
        }
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }
}

/**
 * 简单对称加密算法之加密
 * @param String $string 需要加密的字串
 * @param String $skey 加密EKY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
 function encode($string = '', $skey = 'cxphp') {
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
 }
 /**
 * 简单对称加密算法之解密
 * @param String $string 需要解密的字串
 * @param String $skey 解密KEY
 * @author Anyon Zou <zoujingli@qq.com>
 * @date 2013-08-13 19:30
 * @update 2014-10-10 10:10
 * @return String
 */
 function decode($string = '', $skey = 'cxphp') {
    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
 }
 
 
 /*
 * HTTP GET Request
*/
function get($url, $param = null) {
    if($param != null) {
        $query = http_build_query($param);
        $url = $url . '?' . $query;
    }   
    $ch = curl_init();
    if(stripos($url, "https://") !== false){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }   

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    $content = curl_exec($ch);
    $status = curl_getinfo($ch);
    curl_close($ch);
    if(intval($status["http_code"]) == 200) {
        return $content;
    }else{
        echo $status["http_code"];
        return false;
    }   
}

/*
 * HTTP POST Request
*/
function post($url, $params) {
    $ch = curl_init();
    if(stripos($url, "https://") !== false) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    $content = curl_exec($ch);
    $status = curl_getinfo($ch);
    curl_close($ch);
    if(intval($status["http_code"]) == 200) {
        return $content;
    } else {
        echo $status["http_code"];
        return false;
    }
}

function http_build_query_multi($params, $boundary) {
    if (!$params) return '';

    uksort($params, 'strcmp');

    $MPboundary = '--'.$boundary;
    $endMPboundary = $MPboundary. '--';
    $multipartbody = '';

    foreach ($params as $parameter => $value) {

        if( in_array($parameter, array('pic', 'image')) ) {
            $content = file_get_contents( $value );
            $filename = 'upload.jpg';

            $multipartbody .= $MPboundary . "\r\n";
            $multipartbody .= 'Content-Disposition: form-data; name="' . $parameter . '"; filename="' . $filename . '"'. "\r\n";
            $multipartbody .= "Content-Type: image/unknown\r\n\r\n";
            $multipartbody .= $content. "\r\n";
        } else {
            $multipartbody .= $MPboundary . "\r\n";
            $multipartbody .= 'content-disposition: form-data; name="' . $parameter . "\"\r\n\r\n";
            $multipartbody .= $value."\r\n";
        }

    }

    $multipartbody .= $endMPboundary;
    return $multipartbody;
}

function add_renci($count = 1) {
	try {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/Application/Runtime/Data/renci.xml';
		// check task
		if(file_exists($path)) {
			$file = fopen($path, 'r');
			$renci = intval(fgets($file));
			fclose($file);
			$file = fopen($path, 'w');
			fwrite($file, $renci + $count);
			fclose($file);
		}
	} catch(Exception $e) {
//		echo dump($e);
	}
}


function get_temp_uid() {
	$uid = session("_uid");
	if(empty($uid)) {
		$user = session('wxUserinfo');
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

function count_cart($count = 0) {
	if(!session('?cartCount')) {
		session('cartCount', 0);
	}
	if($count != 0) {
		session('cartCount', session('cartCount') + $count);
	}
}

function empty_cart() {
	session('cartCount', 0);
}
function get_user_img($id=null)
{
	$db = M('member');
	if($id)
	{
		$data['uid'] =$id;
	}
	else
	{
		$data['uid'] = session("_uid");
	}
	$user = $db->where($data)->find();
	$img=$user['img'];
	if (!ereg('^http://', $user['img'])) 
	{
		$img='/Public/Home/images/'.$user['img'];
	}	 
	return $img;	
}

function run_task() {
	$path = $_SERVER['DOCUMENT_ROOT'] . '/Application/Runtime/Data/task.xml';
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
	$list = $mdb->where('status < 2 and jishijiexiao > 0 and end_time <= current_timestamp()')->select();
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
				$prizeindex = intval($query[0]) % $good['canyurenshu'];
				
				// 查找中奖用户
				$cdb = M('MiaoshaCode');
				$cmap['gid'] = $good['gid'];
				$cmap['qishu'] = $good['qishu'];
				$presult = $cdb->field('uid, pcode')->where($cmap)->page($prizeindex + 1, 1)->find();
				if($presult) {
					$prizeuid = $presult['uid'];
					$prize = $presult['pcode'];
				}
			}
			
			$good['status'] = 2;
			$good['prizecode'] = $prize;
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
	$list = $pdb->field('gid,chujiazhe, baoliujia,zuigaojia, chujiazhe,status')->where('status < 2 and end_time <= current_timestamp()')->select();
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

function saveImage($folder, $content) {
	$tmpId = \Org\Util\String::keyGen();
	$fileName = '/Uploads/'.$folder.'/'.array('date','Ymd').'/'.$tmpId.'.jpg';
	list($type, $data) = explode(';', $content);
	list(, $data)      = explode(',', $content);
	file_put_contents($fileName, base64_decode($content));
	return;
}
