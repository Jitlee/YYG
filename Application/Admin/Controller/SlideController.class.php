<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 幻灯片控制器
 */
class SlideController extends CommonController {
	const ROOT_PATH = '/Uploads/Slides/';
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