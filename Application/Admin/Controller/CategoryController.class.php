<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends CommonController {
	const ROOT_PATH = '/Uploads/categories/';
	public function index() {
		$db = M('category');
		$list = $db->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
		$this->assign('title', '商品分类');
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', 'clist');
		$this->display();
	}
	
	public function brands($cid) {
		$db = D('category');
		$data = $db->where($cid)->relation(true)->find();
		$this->ajaxReturn($data["brands"],'JSON');
	}
	
	public function add() {
		if(IS_POST) {
			$db = M('category');
			$db->create();
			if($db->add() != false) {
				$this->success('操作成功', U('Category/index'));
			} else {
				$this->error('数据错误');
			}
		} else {
			$this->assign('action', U('add', '', ''));
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', 'addc');
			$this->assign('title', '添加商品分类');
			$this->display();
		}
	}
	
	public function edit($cid = null) {
		if(IS_POST) {
			$db = M('category');
			$db->create();
			$db->save();
			$this->success('操作成功', U('Category/index'));
		} else {
			$db = M('category');
			$data = $db->find($cid);
			$this->assign('data', $data);
			$this->assign('action', U('edit', '', ''));
			$this->assign('title', '修改商品分类');
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', 'addc');
			$this->display('add');
		}
	}
	
	public function remove($cid = null) {
		$db = M('category');
		$ret = $db->delete($cid);
		
		$hasdb = M('categoryHasBrand');
		$deleteData["cid"] = $cid;
		$hasdb->delete($deleteData);
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
	
	public function upload() {
		if (!empty($_FILES)) {
			$config = array(
			    'maxSize'    =>    3145728,
			    'rootPath'   =>    '.' . self::ROOT_PATH,
			    'savePath'   =>    '',
			    'saveName'   =>    array('uniqid',''),
			    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
			    'autoSub'    =>    true,
			    'subName'    =>    array('date','Ymd'),
			);
	
			$upload = new \Think\Upload($config);// 实例化上传类
			
		    // 上传文件 
		    $info   =   $upload->upload();
		    if($info != false) {// 上传成功
		    		$returnData["status"] = 0;
				$returnData["url"] = self::ROOT_PATH . $info['Filedata']['savepath'] . $info['Filedata']['savename'];
				$returnData["key"] = encode($info['Filedata']['savepath'] . $info['Filedata']['savename']);
		        $this->ajaxReturn($returnData, "JSON");
		    }else{// 上传错误提示错误信息
		    		$returnData["status"] = -1;
		    		$returnData["info"] = $upload->getError();
		        $this->ajaxReturn($returnData, "JSON");
		    }
		}
	}
	
	public function removefile($name) {
		del_dir_or_file('.' . self::ROOT_PATH . decode($name));
	}
}