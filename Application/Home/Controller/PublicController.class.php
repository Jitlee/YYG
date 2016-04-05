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
					'login_time'	=> date('y-m-d-H-i-s'),
					'login_ip'		=> get_client_ip(),
				);
				$db->save($data);
				// 将临时购物车的记录替换成真的			
				$cdb = M('cart');
				$_uid = get_temp_uid();		
				
				// 清空之前的商品
				$cmap['uid'] = $data['uid'];
				$cdb->where($cmap)->delete();
				
				$sql = 'update `yyg_cart` SET `flag` = 1 ,`uid` = ' . $data['uid'] .' WHERE `uid` = ' . $_uid;			
				$row = M()->execute($sql);
				
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
	layout(true);
	$this->display();
}
	
public function Reg($yaoqing=null){
		if(IS_POST) {
				$_POST['password'] = md5($_POST['password']);				
				$Mobile=$_POST['mobile'];	
				$verycode=I("verycode");				
				//验证验证码.
				
				$mcode = D('Home/Verifycode');	
				$rs=$mcode->Check($Mobile,$verycode);
				$status= (int)$rs["status"];
				if($status != 1)
				{
					 $result["msg"]="验证码无效。";
					 $this->ajaxReturn($result, "JSON");
					 return;
				}
				
				$db = M('member');
				$data['mobile'] = $Mobile;
				$records = $db->where($data)->find();
				
				$result["status"]=0;
				$result["msg"]="操作成功。";
				if(!$records)
				{
					$_POST['img']='tx/211274314672928.jpg';
					$_POST['score']=100;
					
					$db->create();
					if($db->add() != false) {
						$records = $db->where($data)->find();
						$result["status"]=1;
						session("_uid", $records['uid']);
						session('wxUserinfo', $records);
						//如果有邀请添加积分		
						
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
			$this->assign('yaoqing', $yaoqing);
			$this->display();
		}
	}
	
	
/*******QQ登录*******/
public function qq($t)
{
	//session("logintype",$t);
 	$_SESSION['logintype']=$t;
 
    $appkey = C('OAUTH.QQ_APPKEY');
    $scope = C('OAUTH.QQ_SCOPE');
    $callback = C('OAUTH.QQ_CALLBACK');

    $qqobj=new \Lib\Login\QQConnect();
    $qqobj->login($appkey, $callback, $scope);
}

public function weibo($t)
{
	$_SESSION['logintype']=$t;
	
	
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
		$username=$user['nickname'];
		$this->LoginAuth($openid, $img,$username);
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
		$username=$user['screen_name'];
		$this->LoginAuth($openid, $img,$username);
}

public function LoginAuth($openid,$imgurl,$username)
{
	$db = M('member');
	$where['reg_key'] = $openid;
	$records = $db->where($where)->find();
	if(!$records)
	{
		$data['login_time']=time();
		$data['time']=time();
		$data['img']=$imgurl;
		$data['username']=$username;
		$data['reg_key'] = $openid;
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
	$this->assign('username', $username);
	
	 
	$_SESSION["loginitem"]=$records;
	$_SESSION["loginuid"]=$records['uid'];
	$logintype=$_SESSION['logintype'];
	
	if(empty($records["mobile"]) || empty($records["username"]))	
	{
		$this->assign('title', '用户手机设置');
		
		$this->assign('reg_key', $openid);
		$this->assign('logintype', $logintype);
		$this->display("Public/setmobile");
	}
	else
	{
//		$this->redirect("/P/Home/index");	
		session("_uid", $records['uid']); 					
		session('wxUserinfo', $records);
					
		$url = decode(I('post.redirect'));
		$result["status"]=1;
		session('loginstatus', 1);
		if($logintype=="p")
		{
			$this->redirect("/P/Home/index");	
		}
		else
		{
			$this->redirect("Person/me");
		}		
	}	
}

public function setmobile(){
			$result["status"]=0;
			$result["msg"]="操作成功。";
			if(IS_POST) {
					$db = M('member');
					$data['mobile'] = $_POST['mobile'];
					$reg_key=$_POST['reg_key'];
					$records = $db->where($data)->find();					
					if(!$records)
					{
						$userinfo=session('wxUserinfo');
						
						$filter['reg_key'] = $reg_key;
						$records = $db->where($filter)->find();
						if($records)
						{
							$records["mobile"]		=$_POST['mobile'];
							$records["username"]	=$_POST['username'];
							$records["score"]		=(int)$records["score"]+100;
							
							session('wxUserinfo', $records);
							$_SESSION["loginitem"]=$records;
							$_SESSION["loginuid"]=$records['uid'];
	
							$db->save($records);						
							$result["status"]=1;
							
							$msdata = array(
								'uid'			=> $records["uid"],
								'scoresource'	=> '完善手机号',
								'score'			=> 100,
							);
							$msdb = M('MemberScore');
							if($msdb->add($msdata) === FALSE) {
								//return 106; // 增加消费纪录流水失败
								$result["msg"]="增加积分流水失败。";
							}
						}
						else {
							$result["msg"]="异常数据请重试。";
							$this->error('数据错误'.$userinfo["openid"]);
						}
					}
					else
					{
						$result["msg"]="手机号已经注册。";
					}
					$this->ajaxReturn($result);				
			}
			else 
			{
				$this->assign('title', '用户手机设置');
				$this->display();
			}
	}

 
	
	 


}