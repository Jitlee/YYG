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
//		$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
//		$login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
//			.$app_id. "&redirect_uri=" . urlencode($callback)
//			. "&state=" . $_SESSION['state']
//			. "&scope=".urlencode($scope);
//
//		//显示出登录地址
//       header('Location:'.$login_url);
		 
//		layout(true);
//		$this->display();
	//	http://www.thinkphp.cn/code/1127.html
	$qqobj=new \Org\Util\Qqconnect();
 	$qqobj->getAuthCode();

}

public function Webibo()
{
	
}
	/**
     * 获取access_token值
     * @return array 返回包含access_token,过期时间的数组
     * */
private function get_token($app_id,$app_key,$code,$callback,$state){
        if($state !== $_SESSION['state']){
			return false;
			exit();
        }

           $url = "https://graph.qq.com/oauth2.0/token";
            $param = array(
                "grant_type"    =>    "authorization_code",
                "client_id"     =>    $app_id,
                "client_secret" =>    $app_key,
                "code"          =>    $code,
                "state"         =>    $state,
                "redirect_uri"  =>    $callback
            );
            $response = $this->get_url($url, $param);
            if($response == false) {
                return false;
            }
            $params = array();
            parse_str($response, $params);
            return $params["access_token"];
}
	
	
	
}