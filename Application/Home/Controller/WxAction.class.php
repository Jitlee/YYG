<?php
namespace Home\Controller;
use Think\Controller;
 
class WxController extends Controller {
	
 	public function getsharekey() {
		$wxm= new WxUserInfo();
		$signPackage=$wxm->getSignPackage();
		$this->ajaxReturn($signPackage, 'JSON');
	}
}
