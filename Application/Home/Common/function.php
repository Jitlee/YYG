<?php

function config($key)
{
	$db = M('config');
	$data['name'] = $key;
	$user = $db->where($data)->find();
	if(!$user)
		return '';
	return $user["value"];	
}


function get_user_open_id() {
	$openId=session('openid').'';
			
	if(strlen($openId)>10) {
		return $openId.'';
	} else {
		//1、获取openid
		vendor('Weixinpay.WxPayJsApiPay');
	    $tools = new \JsApiPay();
	    $openId = $tools->GetOpenid().'';
		session('openid',$openId);
		return $openId.'';
	}
}

function home_is_login() {
	$admin = session('wxUserinfo');
	if(empty($admin)) {
		$openid=get_user_open_id();
		if(empty($openid)) {
			return 0;
		}
		$db = M('member');
		$data['openid'] = $openid;
		$admin = $db->where($data)->find();
		if(!$admin)
			return 0;
		
		session("_uid", $admin['uid']);
		session('wxUserinfo',$admin);
	} else {
		define('UID', $admin['uid']);
		define('username', $admin['username']);
		define('reg_key', $admin['reg_key']);
		return 1;
	}
}
