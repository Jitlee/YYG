<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller {
	protected function _initialize() {
		if(!is_login()) {
			$this->redirect('Public/login');
		}
	}
}
