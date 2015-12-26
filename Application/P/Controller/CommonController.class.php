<?php
namespace P\Controller;
use Think\Controller;
class CommonController extends Controller {
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
	}
}
	