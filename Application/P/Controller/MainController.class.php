<?php
namespace P\Controller;
use Think\Controller;
class MainController extends Controller {
		
	public function register(){    	
    	$this->assign('title', '一元购');
		$this->display();
    }
	
	public function login(){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="登录成功。";
				
			$password= md5($_POST['password']);
				  
			$db = M('member');
			$data['mobile'] = $_POST['username'];
			$user = $db->where($data)->find();
			if(!$user || $user['password'] != $password) {
				$result["msg"]='用户名或密码不正确';
			}
			else{
				$data = array(
					'uid'			=> $user['uid'],
					'login'			=> array('exp', '`login` + 1'),
					'login_time'	=> date('y-m-d-H-i-s'),
					'login_ip'		=> get_client_ip(),
				);
				$db->save($data);
				// 将临时购物车的记录替换成真的			
				$cdb = M('cart');
				$_uid = $user['uid'];		
				
				// 清空之前的商品
				$cmap['uid'] = $data['uid'];
				$cdb->where($cmap)->delete();
				
				$sql = 'update `yyg_cart` SET `flag` = 1 ,`uid` = ' . $data['uid'] .' WHERE `uid` = ' . $_uid;			
				$row = M()->execute($sql);
				
				session("_uid", $user['uid']); 					
				session('wxUserinfo', $user);
							
				$url = decode(I('post.redirect'));
				$result["status"]=1;
				session('loginstatus', 1);
				//$this->success('登录成功',U('Person/me', '',''));
			}
			$this->ajaxReturn($result);
		} else  {
	    	layout(false);
	    	$this->assign('title', '一元购');
			$this->display();
		}
    }

	public function cook_end(){
		session('loginstatus', 0);
		$this->redirect('Index/index');
	}
		
		
		
		
		
		
}
	