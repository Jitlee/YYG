<?php
namespace P\Controller;
use Think\Controller;
use P\Model;

class BaseController extends Controller {

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