<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 支付界面控制器
 */
class PayController extends Controller {
	
	public function index(){
    		$this->assign('title', '结算支付');
		layout(false);
		$this->display();
    }
	
	public function baozhengjin($gid) {
		$db = M('paimai');
		$data = $db->field('gid, title, baozhengjin, thumb')->find($gid);
		$this->assign("data", $data);
    		$this->assign('title', '保证金');
		layout(false);
		$this->display();
	}
}