<?php
namespace Home\Controller;
use Think\Controller;
class SaiDanController extends Controller {
		
	public function index(){
    	$this->assign('title', '秒杀');
        $this->display();
    }
	
}