<?php
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller {
	protected $ROOT_PATH = "/Public";
	
	protected function _initialize() {
		if(!is_login()) {
			$this->redirect('Public/login');
		}
	}
	
}