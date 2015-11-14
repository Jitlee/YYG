<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends CommonController {
	protected $ROOT_PATH = '/Uploads/brands/';
	
	public function index() {
		$db = D("brand");
        $list = $db->relation(true)->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
		$this->assign('title', '品牌管理');
		$this->assign('pid', 'gdmgr');
		$this->assign('mid', 'blist');
		$this->display();
	}
	
	public function remove($bid = 0) {
		$db = M('brand');
		$ret = $db->delete($bid);
		$this->deleteRelations($bid);
		if($ret != false) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
	
	public function add() {
		if(IS_POST) {
			$db = M('brand');
			$db->create();
			$result = $db->add();
			if($result != false) {
				$bid = $result;
				$this->deleteRelations($bid);
				$this->success('操作成功', U('index'));
			} else {
				$this->error('数据错误');
			}
			
		} else {
			$cdb = M('category');
			$categories = $cdb->select();
			$this->assign('allCategories', $categories);
			$this->assign('action', U('add', '', ''));
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', 'addb');
			$this->assign('title', '添加品牌');
			$this->display();
		}
	}
	
	public function edit($bid = null) {
		if(IS_POST) {
			$db = M('brand');
			$db->create();
			$db->save();
			$this->deleteRelations($_POST['bid']);
			$this->success('操作成功', U('index'));
		} else {
			$cdb = M('category');
			$categories = $cdb->select();
			$this->assign('allCategories', $categories);
			
			// 加载数据
			$db = D('brand');
			$data = $db->relation(true)->find($bid);
			$this->assign('data', $data);
			
			$this->assign('isAllCategories', count($categories) == count($data["categories"]));
			
			$this->assign('action', U('edit', '', ''));
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', 'addb');
			$this->assign('title', '编辑品牌');
			$this->display('add');
		}
	}
	
	private function deleteRelations($bid = null) {
		$hasdb = M('categoryHasBrand');
		$deleteData["bid"] = $bid;
		$categories = $_POST['categories'];
		$hasdb->where($deleteData)->delete();
		foreach($categories as $cid) {
			$hasdb = M('categoryHasBrand');
			$hasData["bid"] = $bid;
			$hasData["cid"] = $cid;
			$hasdb->add($hasData);
		}
	}
}