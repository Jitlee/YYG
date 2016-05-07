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

function GetBuyNum()
{
	$buynum =S("web_buynum");
	if(!$buynum)
	{
		$key="buynum";
		$db = M('config');
		$data['name'] = $key;
		$user = $db->where($data)->find();
		if($user)
		{
			S("web_buynum",$user["value"],360000);
			S("web_buynum_old",$user["value"],360000);
			return $user["value"];
		}
	}
	
	return $buynum;	
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
	
	
function logger($log_content)
{
    if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
        sae_set_display_errors(false);
        sae_debug($log_content);
        sae_set_display_errors(true);
    }else{ //LOCAL
        $max_size = 500000;
        $log_filename = date('Y-m-d').'log.xml';
        if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
        file_put_contents($log_filename, date('Y-m-d H:i:s').$log_content.'
        ', FILE_APPEND);
    }
}


	 

	