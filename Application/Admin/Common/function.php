<?php

function is_login() {
	$admin = session('admin');
	if(empty($admin)) {
		return 0;
	} else {
		return $admin['uid'];
	}
}