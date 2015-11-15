<?php
namespace Home\Controller;
use Think\Controller;
class MiaoShaController extends Controller {
		
	public function index(){
    	$this->assign('title', '秒杀');
        $this->display();
    }
	//	人气
	public function renqi(){
		$this->assign('title', '秒杀');
	    $this->display("index");
	}
//	最新
	public function zuixin(){
		$this->assign('title', '秒杀');
	    $this->display("index");
	}
//	剩余人次
	public function shenyu(){
		$this->assign('title', '秒杀');
	    $this->display("index");
	}
//总需人次
	public function zrenqi (){
		$this->assign('title', '秒杀');
	    $this->display("index");
	}
	public function WillEnd (){
		$this->assign('title', '秒杀');
	    $this->display();
	}	
	
}
	