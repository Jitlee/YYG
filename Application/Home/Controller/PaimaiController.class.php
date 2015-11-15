<?php
namespace Home\Controller;
use Think\Controller;
class PaimaiController extends Controller {
    public function index(){
    		$this->assign('title', '拍卖专区');
		$this->assign('pid', 'paimai');
		
		$db = M('paimai');
		$tuijian = $db->where('tuijian=1 AND (status=0 OR status=1)')->order('time desc')->find();
		if(!$tuijian) {
			$tuijian = $db->where('renqi=1 AND (status=0 OR status=1)')->order('time desc')->find();
			if(!$tuijian) {
				$tuijian = $db->where('status=0 OR status=1')->order('time desc')->find();
			}
		}
		$this->assign('tuijian', $tuijian);
		
        $this->display();
    }
}