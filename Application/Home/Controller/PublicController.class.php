<?php
namespace Home\Controller;
use Think\Controller;

 
class PublicController extends Controller {
	
public function login($mobile = null, $password = null) {
		if(IS_POST) {
			$db = M('member');
			$data['mobile'] = $mobile;
			$user = $db->where($data)->find();
			if(!$user || $user['password'] != md5($password)) {
				$this->error('用户名或密码不正确');
			}
			
			$data = array(
				'uid'			=> $user['uid'],
				'login'			=> array('exp', '`login` + 1'),
				'login_time'		=> date('y-m-d-h-i-s'),
				'login_ip'		=> get_client_ip(),
			);
			$db->save($data);
			
			$auth = array(
				'uid'			=> $data['uid'],
				'login_time'		=> $data['login_time'],
				'username'			=> $user['username'],
				'email'			=> $user['email'],
				'mobile'			=> $user['mobile'],
			);
			
			// 将临时购物车的记录替换成真的
			
			$cdb = M();
			$_uid = get_temp_uid();
			
			$sql = 'update `yyg_cart` SET `flag` = 1 ,`uid` = ' . $data['uid'] .' WHERE `uid` = ' . $_uid;
			
			$row = $cdb->execute($sql);
			session("_uid", $data['uid']); // 替换session
			
			session('wxUserinfo', $auth);
			
			$url = decode(I('post.redirect'));
//			if(!$url)
//			{
//				$this->success('登陆成功', U($url, '', ''));
//			}
//			else
//			{
				$this->success('登录成功',U('Person/me', '',''));
			//}
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
				if(!$records)
				{
					$db->create();
					if($db->add() != false) {
						$this->success('操作成功', U('Person/me', '', ''));
					} else {
						$this->error('数据错误');
					}
				}
				else
				{					
					//$db->create();
					$records["password"]= $_POST['password'];
					$db->save($records);
					
					$this->success('操作成功', U('Person/me', '', ''));
				}
			
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
		//$db->create();
		
		$data['login_time']=time();
		$data['time']=time();
		if($db->add($data) == false) {
//			$this->success('操作成功', U('VerifyCode/', '', ''));
//		} else {
			$this->error('数据错误');
		}
	}
	else
	{		
		//	$records["password"]= $_POST['password'];
		$records['login_time']=time();
		$records['time']=time();
		$db->save($records);
		
		//$this->success('操作成功', U('VerifyCode/', '', ''));
	}
	$userinfo=    array(
		    'openid'    	=>  $openid,    // 验证码字体大小
		    'imgurl'      	=>  $imgurl
	);
	$this->assign('userinfo', $userinfo);
	
	$this->assign('title', '登录授权.');
	//session
	session('wxUserinfo', $userinfo);
	$this->display("Person/me");
}

}