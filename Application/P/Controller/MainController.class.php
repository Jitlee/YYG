<?php
namespace P\Controller;
use Think\Controller;
class MainController extends Controller {
		
	public function register($yaoqing=NULL){
		if(IS_POST) {
			$_POST['password'] = md5($_POST['password']);
			$db = M('member');
			$data['mobile'] = $_POST['mobile'];			
			$records = $db->where($data)->find();
			
			$result["status"]=0;
			$result["msg"]="操作成功。";
			if(!$records)
			{
				$_POST['img']='tx/211274314672928.jpg';
				$_POST['mobilecode']='1111';
				$_POST['score']=100;
				//$_POST['username']=$_POST['mobile'];
				$_POST['login_time'] =date('y-m-d-H-i-s');
				$_POST['time'] =date('y-m-d-H-i-s');	
				$db->create();
				if($db->add() != false) {
					session('registerMobile', $_POST['mobile']);
					$result["status"]=1;
					
					$msdata = array(
						'uid'			=> $records['uid'],
						'scoresource'	=> '注册',
						'score'			=> 100,
					);
					$msdb = M('MemberScore');
					if($msdb->add($msdata) === FALSE) {
						return 106; // 增加消费纪录流水失败
					}		
				}
				else 
				{
					$result["msg"]='注册出错啦。';
				}
			}
			else
			{
				if($records['mobilecode']=='1111')
				{
					$records['password']=$_POST['password'] ;
					$db->save($records);
					session('registerMobile', $_POST['mobile']);
					$result["status"]=1;
				}
				else
				{
					$result["msg"]='手机号已经注册。';		
				}
			}
			$this->ajaxReturn($result);	
    	} else  {
	    	$this->assign('title', '壹圆购物');
			$this->assign('yaoqing', $yaoqing);
			
			$this->display();
		}
    }
	public function mobilecheck()
	{
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="登录成功。";
			
			$checkmobile=$_POST['mobile'];
			if($checkmobile != session('registerMobile'))
			{
				$result["msg"]='非法操作,请刷新重试。';
			}
			else
			{
				$verycode=$_POST['Code'];
				$mcode = D('P/Verifycode');	
				$rs=$mcode->Check($checkmobile,$verycode);
				$status= (int)$rs["status"];
				if($status != 1)
				{
					 $result["msg"]="验证码无效。";
					 $this->ajaxReturn($result, "JSON");
					 return;
				}
 
				//设置参数
				$result["status"]=1;
				$m = D('P/Member');
				$user=$m->getByMobile($checkmobile);
				if($user)
				{
					//更新用户验证码状态
					$user['mobilecode']=$_POST['Code'];
					$db = M('member');
					$db->save($user);
					session('registerMobile','');
					session('loginstatus', 0);
					session('wxUserinfo', null);
					$yaoqing=floatval($user["yaoqing"]);
					if($yaoqing>0)
					{
						$yaoqinguser=$m->getByYaoqing($yaoqing);
						if($yaoqinguser)
						{
							//添加晒单积分				
							$mscore = D('P/MemberScore');
							$resultr = $mscore->AddScore($yaoqinguser["uid"],'邀请赠送积分。',100);
						}
					}
					$result["status"]=1;
					
					//默认已登录
					session("_uid", $user['uid']); 					
					session('wxUserinfo', $user);
								
					$url = decode(I('post.redirect'));
					$result["status"]=1;
					session('loginstatus', 1);
				}
				else
				{
					$result["msg"]="用户错误。";
				}
 
			}
			$this->ajaxReturn($result);	
    	} else  {
			$this->assign('enname', session('registerMobile'));
			$this->assign('namestr',session('registerMobile'));
			
			$this->assign('time', 60);
			$this->display();
		}
	}
	public function login(){
		//echo $_SESSION["abc"];
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="登录成功。";
				
			$password= md5($_POST['password']);
				  
			$db = M('member');
//			$data['mobile'] = $_POST['username'];
//			$user = $db->where($data)->find();
			$m = D('P/Member');
			$user=$m->getByMobile($_POST['username']);
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
				$_uid = get_temp_uid();	
				
				// 清空之前的商品
				$cmap['uid'] = $_uid;
				$cdb->where($cmap)->delete();
				
				empty_cart();
				
				$cartCount = $cdb->where(array('uid'=>$user['uid']))->count();
				count_cart($cartCount);
				
//				$sql = 'update `yyg_cart` SET `flag` = 1 ,`uid` = ' . $data['uid'] .' WHERE `uid` = ' . $_uid;			
//				$row = M()->execute($sql);
				
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
	    	$this->assign('title', '壹圆购物');
			$this->display();
		}
    }

	
	public function cook_end(){
		session('loginstatus', 0);
		session('wxUserinfo', null);
		$this->redirect('Index/index');
	}
		
		
		
		
		
		
}
	