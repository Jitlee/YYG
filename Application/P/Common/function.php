<?php


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



function empty_cart() {
	session('cartCount', 0);
}

function get_user_img()
{
	$db = M('member');
	$data['uid'] = session("_uid");
	$user = $db->where($data)->find();
	$img=$user['img'];
	if (!ereg('^http://', $user['img'])) 
	{
		$img='/Public/Home/images/'.$user['img'];
	}	 
	return $img;	
}
function get_username()
{
	$db = M('member');
	$data['uid'] = session("_uid");
	$user = $db->where($data)->find();
	 
	if ($user) 
	{
		return $user['username'];
	}	 
	return '';	
}
function config($key)
{
	$db = M('config');
	$data['name'] = $key;
	$user = $db->where($data)->find();
	if(!$user)
		return '';
	return $user["value"];	
}
