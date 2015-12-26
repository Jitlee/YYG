<?php

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
