<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller {
	public function _initialize() {
		define('UID', is_login());
		
		if(!UID) {
			$this->redirect('Public/login');
		}
	}
}
