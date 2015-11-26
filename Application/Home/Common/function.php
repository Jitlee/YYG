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