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

function footerHelp()
{
	$m = D('P/ArticleCats');
	$mc = D('P/Articles');
	$cats=$m->queryByList(1);
	$html="";
	foreach ($cats as $key =>$v){
		$html=$html.'<dl class="ft-newbie">';
		$html=$html.'<dt><span>'.$v['catname'].'</span></dt>';
		
		$carti=$mc->queryByList($v['catid']);
    	foreach ($carti as $var) {
 			$html=$html."<dd><b></b><a href='".U('Help/index', '', '')."/".$var["articleid"]."' target='_blank'>".$var["articletitle"]."</a></dd>";
		}
		$html=$html.'</dl>';
	}
	return $html; 
}
	
	 

	