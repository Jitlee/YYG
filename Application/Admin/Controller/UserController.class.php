<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
	protected function _initialize() {
		parent::_initialize();
		if(ROLE != '1') {
			$this->error("当前管理员没有超级管理员角色权限");
		}
	}
	public function index($pageSize = 25, $pageNum = 1) {
		// 分页
		$db = M('admin');
		$count = $db->count();
		if(!is_int($pageSize)) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		
		$list = $db->page($pageNum, $pageSize)->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
		
		$this->assign('title', '管理员列表');
		$this->assign('pid', 'sysmgr');
		$this->assign('mid', 'usrlst');
		$this->display();
	}
	
	public function add() {
		if(IS_POST) {
			$_POST['password'] = md5($_POST['password']);
			$db = M('admin');
			$db->create();
			if($db->add() != false) {
				$this->success('操作成功', U('index', '', ''));
			} else {
				$this->error('数据错误');
			}
		} else {
			$this->assign('action', U('add', '', ''));
			$this->assign('pid', 'sysmgr');
			$this->assign('mid', 'addusr');
			$this->assign('title', '添加管理员');
			$this->display();
		}
	}
	
	public function edit($uid = null) {
		if(IS_POST) {
			if($_POST['password']) {
				$_POST['password'] = md5($_POST['password']);
			} else {
				unset($_POST['password']);
			}
			$db = M('admin');
			$db->create();
			$db->save();
			$this->success('操作成功', U('index', '', ''));
		} else {
			$db = M('admin');
			$data = $db->find($uid);
			$this->assign('data', $data);
			$this->assign('action', U('edit', '', ''));
			$this->assign('title', '修改管理员');
			$this->assign('pid', 'sysmgr');
			$this->assign('mid', 'addusr');
			$this->display('add');
		}
	}
	
	public function remove($uid = 0) {
		$db = M('admin');
		$ret = $db->delete($uid);
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
}