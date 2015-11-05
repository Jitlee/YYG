<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {
	public function index() {
		$db = M('category');
		$data = $db->select();
		if($data != false) {
			$this->assign('data',$data);// 模板变量赋值
		}
		$this->assign('title', '栏目管理');
		$this->display();
	}
	
	public function remove($cid = 0) {
		$db = M('category');
		$ret = $db->delete($cid);
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
}