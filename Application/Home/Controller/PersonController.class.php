<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends CommonController {
		 		
//	protected function _initialize() {
//		if(!is_login()) {
//			$this->redirect('Person/login');
//			return;
//			//$this->login();
//		}
//	}
	
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