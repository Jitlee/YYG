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
		layout(true);
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
	
	
}