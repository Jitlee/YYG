<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class ProblemController extends Controller {
	public function index(){
		$map['ptype']=3;
		$list=M('problem')->where($map)->order('pid')->select();
		$this->list=$list;
		$this->assign('title', '了解壹易购物');		
		
		/****分享与定位***/
		$wxm= new WxUserInfo();
		$signPackage=$wxm->getSignPackage();			 
		$this->assign('signPackage', $signPackage);
		
		$this->display();
	}
	
	public function problemdetails(){
		$t=I("t",0);
		$map['pid']=$t;
		$obj=M('problem')->where($map)->order('pid')->find();
		$this->obj=$obj;
		 
		$this->assign('title', '了解壹易购物');		
		
		$this->display();
	}

}