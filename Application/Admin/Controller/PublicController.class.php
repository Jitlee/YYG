<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 后台控制公共类
 */
class PublicController extends Controller {
	/**
	 * 后台用户登陆
	 */
	public function login($username = null, $password = null, $verify = null) {
		if(IS_POST) {
			if(!check_verify($verify)) {
				 $this->error('3验证码输入错误！');
			}
			
			$db = M('admin');
			$data['username'] = $username;
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
				'login_time'		=> NOW_TIME,
				'login_ip'		=> get_client_ip(),
			);
			$db->save($data);
			
			$auth = array(
				'uid'			=> $user['uid'],
				'login_time'		=> $user['login_time'],
			);
			session('admin', $auth);
			$this->success('登陆成功', U('Index/index'));
		} else if(is_login()) {
			$this->redirect("Index/index");
		} else {
			layout(false);
			$this->display();
		}
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
}
