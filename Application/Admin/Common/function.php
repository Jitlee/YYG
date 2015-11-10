<?php

function is_login() {
	$admin = session('admin');
	if(empty($admin)) {
		return 0;
	} else {
		define('UID', $admin['uid']);
		define('ROLE', $admin['role']);
		define('EMAIL', $admin['email']);
		return 1;
	}
}