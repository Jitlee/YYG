<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends Controller {
	public function index() {
		$db = M('category');
		$list = $db->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
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
	
	public function add($name = null, $key = null) {
		if(IS_POST) {
			$db = M('category');
			$data['name'] = $name;
			$data['key'] = $key;
			if($db->add($data) != false) {
				$this->success('操作成功', U('Category/index'));
			} else {
				$this->error('数据错误');
			}
			
		} else {
			$this->assign('action', U('add'));
			$this->assign('title', '添加栏目');
			$this->display();
		}
	}
	
	public function edit($cid = null, $name = null, $key = null) {
		if(IS_POST) {
			$db = M('category');
			$data['cid'] = $cid;
			$data['name'] = $name;
			$data['key'] = $key;
			if($db->save($data) != false) {
				$this->success('操作成功', U('Category/index'));
			} else {
				$this->error('数据错误');
			}
		} else {
			$db = M('category');
			$data = $db->find($id);
			if($data != false) {
				$this->assign('data', $data);
			}
			$this->assign('action', U('edit'));
			$this->assign('title', '修改栏目');
			$this->display('add');
		}
	}
}