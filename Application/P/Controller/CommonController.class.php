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
		
		$this->assign('serverTime', time());
		
		count_cart(0);
	}
	
	
	public function SetPage($pageSize = 40, $pageNum = 1,$total)
	{
			if(!$pageSize) {
				$pageSize = 20;
			}
			
			//$total=90;
			$pageNum = intval($pageNum);
			$pageCount = ceil($total / $pageSize);
			if($pageNum > $pageCount) {
				$pageNum = $pageCount;
			}
			$this->assign('pageSize', $pageSize);
			$this->assign('pageNum', $pageNum);
			$this->assign('count', $total);
			$this->assign('pageCount', $pageCount);
			$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
			$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
	}
	
}
	