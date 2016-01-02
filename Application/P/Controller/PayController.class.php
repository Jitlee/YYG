<?php
namespace P\Controller;
/**
 * 支付界面控制器
 */
class PayController extends \Home\Controller\PayController {

	protected function _initialize() {
		$path = $_SERVER['DOCUMENT_ROOT'] . '/Application/Runtime/Data/renci.xml';
		// check task
		if(file_exists($path)) {
			$file = fopen($path, 'r');
			$renci = fgets($file);
			fclose($file);
			$len = strlen($renci);
			for($i = 0; $i < $len; $i++) {
				$this->assign('goCountRenci'.($len - $i), $renci[$i]);
			}
		}
		
		$this->assign('serverTime', time());
		$this->assign('title', '一元购');		
		count_cart(0);
	}
	
	public function index(){
		if(is_login()) {
			parent::index();
		} else {
			$this->redirect('P/Main/login/'.encode('Pay/index', '', ''));
		}
    }
	
	public function baozhengjin($gid) {
		if(is_login()) {
			parent::baozhengjin($gid);
		} else {
			$this->redirect('P/Main/login/'.encode('Pay/baozhengjin/'.$gid, '', ''));
		}
	}
}