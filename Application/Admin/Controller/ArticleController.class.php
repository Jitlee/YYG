<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
	public function index() {
		$db = M("Article");
        $list = $db->select();
		$this->assign('list',$list);// 模板变量赋值
		$this->assign('title', '文章管理');
		$this->assign('pid', 'uimgr');
		$this->assign('mid', 'aclist');
		$this->display();
	}
	
	public function edit($id = null) {
		if(IS_POST) {
			$db = M('Article');
			$db->create();
			$db->save();
			$this->success('操作成功', U('index'));
		} else {
			// 加载数据
			$db = M('Article');
			$data = $db->find($id);
			$this->assign('data', $data);
			
			$this->assign('action', U('edit', '', ''));
			$this->assign('pid', 'uimgr');
			$this->assign('mid', 'aclist');
			$this->assign('title', '编辑文章');
			$this->display('add');
		}
	}
}