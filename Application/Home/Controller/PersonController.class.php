<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends Controller {
    public function index(){
    	$this->assign('title', '一元购');
		$this->assign('pid', 'index');
		
		$cdb = M('category');
		$allCategories = $cdb->limit(8)->select();
		$this->assign('allCategories', $allCategories);
		
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
		
        $this->display();
    }
	
	public function me(){
    	$this->assign('title', '一元购');
        $this->display();
    }
	
	public function login($username = null, $password = null, $verify = null) {
		if(IS_POST) {
//			if(!check_verify($verify)) {
//				 $this->error('3验证码输入错误！');
//			}
			$db = M('member');
			$data['mobile'] = $username;
			$admin = $db->where($data)->find();
			if(!$admin) {
				$this->error('1帐号不存在或被禁用');
			}
			
			if($admin['password'] != md5($password)) {
				$this->error('2密码不正确');
			}
			
			$data = array(
				'uid'			=> $admin['uid'],
				'login'			=> array('exp', '`login` + 1'),
				'login_time'		=> date('y-m-d-h-i-s'),
				'login_ip'		=> get_client_ip(),
			);
			$db->save($data);
			
			$auth = array(
				'uid'			=> $data['uid'],
				'login_time'		=> $data['login_time'],
				'role'			=> $admin['role'],
				'email'			=> $admin['email'],
			);
			session('admin', $auth);
//			echo dump(session('admin'));
			$this->success('登陆成功', U('Index/index', '', ''));
		}
//		else if(is_login()) {
//			$this->redirect("Index/index");
//		} 
		else 
		{
			layout(true);
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
			if($_POST['password'] != $_POST['passwordconfim'])
			{
				$this->error('输入两次密码不一');
			}
			else
			{
				$_POST['password'] = md5($_POST['password']);
	
				$db = M('member');
				
				$data['mobile'] = $_POST['mobile'];
				$records = $db->where($data)->find();
				if(!$records)
				{
					$db->create();
					if($db->add() != false) {
						$this->success('操作成功', U('VerifyCode/', '', ''));
					} else {
						$this->error('数据错误');
					}
				}
				else
				{					
					//$db->create();
					$records["password"]= $_POST['password'];
					$db->save($records);
					
					$this->success('操作成功', U('VerifyCode/', '', ''));
				}
			}
		} else {
			//$this->assign('action', U('add', '', ''));
//			$this->assign('pid', 'sysmgr');
//			$this->assign('mid', 'addusr');
			$this->assign('title', '新用户注册');
			$this->display();
		}
//		layout(true);
//		$this->display();
	}
	
	public function VerifyCode()
	{
		$this->assign('title', '新用户注册');
		$this->display();
	}
	
	
	public function verify() {
		ob_end_clean();
		$config =    array(
		    'fontSize'    	=>  30,    // 验证码字体大小
		    'length'      	=>  4,     // 验证码位数
		    'useCurve'	  	=>	false, // 关闭混淆曲线
		    'useNoise'		=>  false, // 关闭验证码杂点
		    'codeSet'		=>	'0123456789',		// 除数字验证
		);
        $verify = new \Think\Verify($config);
        $verify->entry();
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
	$this->display("me");
}

}