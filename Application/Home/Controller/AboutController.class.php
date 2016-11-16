<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class AboutController extends Controller {
	public function about(){
		/****分享与定位***/
		$wxm= new WxUserInfo();
		$signPackage=$wxm->getSignPackage();			 
		$this->assign('signPackage', $signPackage);
		
		$this->display();
	}

}