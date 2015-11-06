<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends Controller {
	public function index() {
		$db = D("brand");
        $list = $db->relation(true)->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
		$this->assign('title', '品牌管理');
		$this->display();
	}
	
	public function remove($bid = 0) {
		$db = M('brand');
		$ret = $db->delete($bid);
		if($ret != false) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
	
	public function add($name = null, $key = null) {
		if(IS_POST) {
			$db = M('brand');
			$data['name'] = $name;
			$data['key'] = $key;
			if($db->add($data) != false) {
				$this->success('操作成功', U('Category/index'));
			} else {
				$this->error('数据错误');
			}
			
		} else {
			$this->assign('action', U('add'));
			$this->assign('title', '添加品牌');
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
	
	public function upload() {
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
	    $upload->savePath  =     'Brands'; // 设置附件上传（子）目录
//	    import('Org/Util/String');
//	    import('Think.ORG.Util.String');
	    $upload->saveName  =     \Org\Util\String::uuid(); // 
	    // 上传文件 
	    $info   =   $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功
	        $this->success('上传成功！');
	    }
	}
}