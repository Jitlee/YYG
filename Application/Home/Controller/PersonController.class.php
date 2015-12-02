<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends CommonController {
		 		
	protected function _initialize() {
		if(!is_login()) {
			$this->redirect('Public/login');
			return;
		}
	}
	
    public function index(){
    	$this->assign('title', '一元购');
		$this->assign('pid', 'index');
        $this->display();
    }
	
	public function loginexit(){
    	$this->assign('title', '一元购');
		$this->assign('pid', 'me');
		
		session("_uid", null); // 替换session			
		session('wxUserinfo', null);
		$this->redirect('Public/login');
    }
	
	public function me(){
    	$this->assign('title', '一元购');  
		$userinfo=session('wxUserinfo');
		$this->assign('data', $userinfo);
		
		$this->display();
    }
	
	public function userinfoitem()
	{
		$this->assign('title', '用户信息');
		$this->display();
	}
	
	public function recharge()
	{
		$this->assign('title', '充值');
		$this->display();
	}
	
	public function miaoshaRecord()
	{
		$this->assign('title', '秒杀记录');
		$this->display();
	}
	
		
	public function userimg(){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
			$db = M('member');
			$data['uid'] = session("_uid");
			$user = $db->where($data)->find();
			if(!$user) {
				$result["msg"]='用户不存在。';
			}
			$user["img"]=$_POST['membimg'];
			$db->save($user);
			$result["status"]=1;
			session('wxUserinfo', $user);
			$this->ajaxReturn($result, "JSON");
		}
		else
		{
			layout(true);
			$data=session('wxUserinfo');
			$this->assign("data", $data);
			$this->display();
		}
	}
	public function useraddress(){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
		}
		else
		{
			layout(true);
			$this->display();
		}
	}
	public function userpwd(){
		if(IS_POST) {
			$result["status"]=0;
			$result["msg"]="成功。";
			$db = M('member');
			$data['uid'] = session("_uid");
			$user = $db->where($data)->find();
			if(!$user) {
				$result["msg"]='用户不存在。';
			}
			else
			{
				$password= md5($_POST['txtoldpwd']);
				if(  $user['password'] != $password) {
					$result["msg"]='原密码错误。';
				}
				else
				{
					$passwordNew= md5($_POST['txtconfimpwd']);
					$user['password']=$passwordNew;
					$db->save($user);
					$result["status"]=1;
					session('wxUserinfo', null);
				}
			}
			$this->ajaxReturn($result, "JSON");
		}
		else
		{
			layout(true);
			$this->display();
		}
	}
	
	public function userinfo(){
		if(IS_POST) {
			$db = M('member');
			$data['uid'] = session("_uid");
			$user = $db->where($data)->find();
			$result["status"]=0;
			$result["msg"]="操作成功。";
			if($user)
			{						 					
				$records["mobile"]	=$_POST['mobile'];
				$records["username"]	=$_POST['username'];
				session('wxUserinfo', $records);							
				$db->save($records);						
				$result["status"]=1;
			}
			else
			{
				$result["msg"]="用户不存在。";
			}
			$this->ajaxReturn($result);		
		}
		else
		{
			layout(true);
			$data=session('wxUserinfo');
			$this->assign("data", $data);
			$this->display();
		}
	}
	
	
	public function pageAllMR($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha');
		$filter['yyg_member_miaosha.uid'] = session("_uid");
		
		
		$list =$Model
		->join(" yyg_member_miaosha ON yyg_member_miaosha.gid=yyg_miaosha.gid")			
		->where($filter)
		->page($pageNum, $pageSize)
		->group('title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid')
		->field("title,thumb,danjia,status,yyg_miaosha.gid, yyg_member_miaosha.qishu, canyurenshu, zongrenshu,shengyurenshu,type,jishijiexiao,yyg_miaosha.time,yyg_member_miaosha.uid")
		->select();
			
		$this->ajaxReturn($list, "JSON");
	}
	
	public function miaoshazj()
	{
		$this->assign('title', '中奖记录');
		$this->display();
	}
	
	public function pageAllzj($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		
		
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		$this->ajaxReturn($list, "JSON");
	}

	public function miaoshasdno()
	{
		$this->assign('title', '未晒单');
		$this->display();
	}
	
	public function pageAllsdno($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		
		
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function miaoshasdfinish()
	{
		$this->assign('title', '已晒单');
		$this->display();
	}
	
	public function pageAllsdfinish($pageSize, $pageNum) {
		// 分页
		$Model = M('miaosha_history');
		$filter['yyg_miaosha_history.prizeuid'] = session("_uid");
		
		
		$list =$Model
		->join("yyg_member ON yyg_member.uid=yyg_miaosha_history.prizeuid")			
		->where($filter)
		->page($pageNum, $pageSize)		
		->field("mobile,title,thumb,danjia,status,yyg_miaosha_history.gid, yyg_miaosha_history.qishu, canyurenshu, zongrenshu,type,jishijiexiao,yyg_miaosha_history.time,yyg_member.uid")
		->select();
		$this->ajaxReturn($list, "JSON");
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