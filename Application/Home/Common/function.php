<?php

function is_login() {
	return session('?user');
}

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
