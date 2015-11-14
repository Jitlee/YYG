<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 幻灯片控制器
 */
class SlideController extends CommonController {
	protected $ROOT_PATH = '/Uploads/Slides/';
	public function index() {
		$db = M('slide');
		$list = $db->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
		$this->assign('title', '微信幻灯管理');
		$this->assign('pid', 'uimgr');
		$this->assign('mid', 'wxshdlist');
		$this->display();
	}
	
	public function add() {
		if(IS_POST) {
			$db = M('slide');
			$db->create();
			if($db->add() != false) {
				$this->success('操作成功', U('index', '', ''));
			} else {
				$this->error('数据错误');
			}
		} else {
			$this->assign('action', U('add', '', ''));
			$this->assign('pid', 'uimgr');
			$this->assign('mid', 'wxshdlist');
			$this->assign('title', '添加微信幻灯片');
			$this->display();
		}
	}
	
	public function edit($id = null) {
		if(IS_POST) {
			$db = M('slide');
			$db->create();
			$db->save();
			$this->success('操作成功', U('index', '', ''));
		} else {
			$db = M('slide');
			$data = $db->find($id);
			$this->assign('data', $data);
			$this->assign('action', U('edit', '', ''));
			$this->assign('title', '修改手机幻灯片');
			$this->assign('pid', 'uimgr');
			$this->assign('mid', 'wxshdlist');
			$this->display('add');
		}
	}
	
	public function remove($id = null) {
		$db = M('slide');
		$ret = $db->delete($id);
		
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
}