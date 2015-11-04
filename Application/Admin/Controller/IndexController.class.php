<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }
	
	public function category() {
		$db = M('category');
		$data = $db->select();
		if($data) {
			$this->assign('data',$data);// 模板变量赋值
		} else {
			$this->error('数据错误');
		}
		$this->assign('title', '栏目管理');
		$this->display();
	}
}