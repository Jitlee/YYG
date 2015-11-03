<?php

function is_login() {
	$user = session('user');
	if(empty($user)) {
		return 0;
	} else {
		return $user['uid'];
	}
}

function check_verify($code, $id = '') {
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}
