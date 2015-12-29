<?php
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller {
	protected $ROOT_PATH = "/Public";
	
	protected function _initialize() {
		if(!a_is_login()) {
			$this->redirect('Public/login');
		}
	}
	
	public function upload() {
		if (!empty($_FILES)) {
			$config = array(
			    'maxSize'    =>    3145728,
			    'rootPath'   =>    '.' . $this->ROOT_PATH,
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
				$returnData["url"] = $this->ROOT_PATH . $info['Filedata']['savepath'] . $info['Filedata']['savename'];
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
		del_dir_or_file('.' . $this->ROOT_PATH . decode($name));
	}

	public function SetPage($pageSize = 10, $pageNum = 1,$total)
	{
			if(!$pageSize) {
				$pageSize = 20;
			}
			
			//$total=90;
			$pageNum = intval($pageNum);
			$pageCount = ceil($total / $pageSize);
			if($pageNum > $pageCount) {
				$pageNum = $pageCount;
			}
			$this->assign('pageSize', $pageSize);
			$this->assign('pageNum', $pageNum);
			$this->assign('count', $total);
			$this->assign('pageCount', $pageCount);
			$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
			$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
	}
}
