<?php
namespace Home\Controller;
use Think\Controller;

 
class PublicController extends Controller {
	
public function login() {
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="登录成功。";
				
			$password= md5($_POST['password']);
				 
				
			$db = M('member');
			$data['mobile'] = $_POST['mobile'];
			$user = $db->where($data)->find();
			if(!$user || $user['password'] != $password) {
				$result["msg"]='用户名或密码不正确';
			}
			else{
				$data = array(
					'uid'			=> $user['uid'],
					'login'			=> array('exp', '`login` + 1'),
					'login_time'	=> date('y-m-d-h-i-s'),
					'login_ip'		=> get_client_ip(),
				);
				$db->save($data);
				// 将临时购物车的记录替换成真的			
				$cdb = M();
				$_uid = get_temp_uid();			
				$sql = 'update `yyg_cart` SET `flag` = 1 ,`uid` = ' . $data['uid'] .' WHERE `uid` = ' . $_uid;			
				$row = $cdb->execute($sql);			
				
				session("_uid", $user['uid']); 					
				session('wxUserinfo', $user);
							
				$url = decode(I('post.redirect'));
				$result["status"]=1;
				//$this->success('登录成功',U('Person/me', '',''));
			}
			$this->ajaxReturn($result);
		} else  {
			layout(false);
			$this->assign('redirect', $mobile);
			$this->display();
		}
	}


	public function forgetPassword(){
			$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
			$login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
			.$app_id. "&redirect_uri=" . urlencode($callback)
			. "&state=" . $_SESSION['state']
			. "&scope=".urlencode($scope);
			
		layout(true);
		$this->assign('title', $login_url);
		$this->display();
	}
	
	public function reg(){
		if(IS_POST) {
				$_POST['password'] = md5($_POST['password']);
				$db = M('member');
				$data['mobile'] = $_POST['mobile'];
				$records = $db->where($data)->find();
				
				$result["status"]=0;
				$result["msg"]="操作成功。";
				if(!$records)
				{
					$db->create();
					if($db->add() != false) {
						$records = $db->where($data)->find();
						$result["status"]=1;
						session("_uid", $records['uid']);
						session('wxUserinfo', $records);
					} 
					else 
					{
						$result["msg"]='数据错误';
					}
				}
				else
				{
					$result["msg"]='手机号已经注册。';
				}
				$this->ajaxReturn($result);
		} else {
			$this->assign('title', '新用户注册');
			$this->display();
		}
	}
	
	
/*******QQ登录*******/
public function qq()
{
    $appkey = C('OAUTH.QQ_APPKEY');
    $scope = C('OAUTH.QQ_SCOPE');
    $callback = C('OAUTH.QQ_CALLBACK');

    $qqobj=new \Lib\Login\QQConnect();
    $qqobj->login($appkey, $callback, $scope);
}

public function weibo()
{
	$appkey = C('OAUTH.WEIBO_APPKEY');
    $scope = C('OAUTH.WEIBO_SCOPE');
    $callback = C('OAUTH.WEIBO_CALLBACK');
    $weibo =new \Lib\Login\WeiboConnect();
    $weibo->login($appkey, $callback, $scope);
}
public function auth() {        
        $appkey = C('OAUTH.QQ_APPKEY');
        $appsecretkey = C('OAUTH.QQ_APPSECRETKEY');
        $callback = C('OAUTH.QQ_CALLBACK');
    	$qqobj=new \Lib\Login\QQConnect();
        $info = $qqobj->callback($appkey, $appsecretkey, $callback);
//		print_r("openid=".$info['openid']);
        $user = $qqobj->get_user_info($info['token'], $info['openid'], $appkey);
		
//		print_r("USER=");
//		print_r("figureurl_2=".$user['figureurl_2']);
		        
        $openid =$info['openid'];
        $img=$user['figureurl_2'];
		$this->LoginAuth($openid, $img);
}
public function weiboauth() {
        $appkey = C('OAUTH.WEIBO_APPKEY');
        $appsecretkey = C('OAUTH.WEIBO_APPSECRETKEY');
        $callback = C('OAUTH.WEIBO_CALLBACK');
          
		$weibo=new \Lib\Login\WeiboConnect();
        $info = $weibo->callback($appkey, $appsecretkey, $callback);
		
        $user = $weibo->get_user_info($info['token'], $info['openid']);
        //print_r($user);
        //print_r($info);
        $openid =$info['openid'];
        $img=$user['profile_image_url'];
		$this->LoginAuth($openid, $img);
}

public function LoginAuth($openid,$imgurl)
{
	$db = M('member');
	$data['reg_key'] = $openid;
	$records = $db->where($data)->find();
	if(!$records)
	{
		$data['login_time']=time();
		$data['time']=time();
		$data['img']=$imgurl;
		if($db->add($data) == false) {
			$this->error('数据错误');
		}
		else
		{
			$records = $db->where($data)->find();
		}
	}
	else
	{
		$records['login_time']=time();
		$records['time']=time();
		$db->save($records);
	}
//	$userinfo=array(
//		    'openid'    	=>  $openid,    // 验证码字体大小
//		    'imgurl'      	=>  $imgurl
//	);
//	$this->assign('userinfo', $records);	
	$this->assign('title', '登录授权.');
	
	session("_uid", $records['uid']); 
	session('wxUserinfo', $records);
	if(empty($records["mobile"]) || empty($records["username"]))	
	{	
		$this->display("Public/setmobile");
	}
	else
	{
		$this->redirect("Person/me");		
	}	
}

	public function setmobile(){
			if(IS_POST) {
					$db = M('member');
					$data['mobile'] = $_POST['mobile'];
					$records = $db->where($data)->find();
					$result["status"]=0;
					$result["msg"]="操作成功。";
					if(!$records)
					{
						$userinfo=session('wxUserinfo');
						
						$filter['reg_key'] = $userinfo["openid"];
						$records = $db->where($filter)->find();
						if($records)
						{
							//$records["img"]	=$userinfo["imgurl"];							
							$records["mobile"]	=$_POST['mobile'];
							$records["username"]	=$_POST['username'];
							session('wxUserinfo', $records);							
							$db->save($records);						
							$result["status"]=1;
						}
						else {
							$this->error('数据错误'.$userinfo["openid"]);
						}
					}
					else
					{
						$result["msg"]="手机号已经注册。";
					}
					$this->ajaxReturn($result);				
			} else {
				$this->assign('title', '用户手机设置');
//				$userinfo=session('wxUserinfo');
//				$userinfo["openid"]="71EEF3B6651960EA5129E7C14B0EA51C";
//				session('wxUserinfo',$userinfo);
				$this->display();
			}
	}

}