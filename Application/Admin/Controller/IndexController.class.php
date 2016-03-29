<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    		if(ROLE != 1) {
    			$this->assign('pid', 'gdmgr');
    		}
		
        $this->display();
    }
}