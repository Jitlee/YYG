<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends CommonController {
	protected $ROOT_PATH = "/Uploads/Members/";
	public function index($pageSize = 25, $pageNum = 1) {
		self::select($pageSize, $pageNum);
	}
	
	public function today($pageSize = 25, $pageNum = 1) {
		$filter = 'date(time) = curdate()';
		self::select($pageSize, $pageNum, $filter);
	}
	
	private function select($pageSize = 25, $pageNum = 1, $filter = null) {
		// 分页
		$db = M('member');
		$count = $db->where($filter)->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageSize = 10;
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
		
		$list = $db->where($filter)->page($pageNum, $pageSize)->order(" time desc ")->select();
		$this->assign('list',$list);// 模板变量赋值
		
		$this->assign('title', '会员列表');
		$this->assign('pid', 'mbmgr');
		$this->assign('mid', 'mblst');
		$this->display("index");
	}
	
	public function add() {
		if(IS_POST) {
			$_POST['password'] = md5($_POST['password']);
			$db = M('member');
			$db->create();
			if($db->add() != false) {
				$this->success('操作成功', U('index', '', ''));
			} else {
				$this->error('数据错误');
			}
		} else {
			$this->assign('action', U('add', '', ''));
			$this->assign('pid', 'mbmgr');
			$this->assign('mid', 'addmb');
			$this->assign('title', '添加会员');
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
			$db = M('member');
			$db->create();
			$db->save();
			$this->success('操作成功', U('index', '', ''));
		} else {
			$db = M('member');
			$data = $db->find($uid);
			$this->assign('data', $data);
			$this->assign('action', U('edit', '', ''));
			$this->assign('title', '修改会员');
			$this->assign('pid', 'mbmgr');
			$this->assign('mid', 'addmb');
			$this->display('add');
		}
	}
	
	public function remove($uid = 0) {
		$db = M('member');
		$ret = $db->delete($uid);
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
	
	public function find() {
		if(IS_POST) {
			$type=I("type");
			$value=I("inputValue");
			switch ($type) {
				case 0:
					$filter['uid'] = $value;
			  		break;  
				case 1:
					$filter['username'] = array('LIKE', '%'.$value.'%');
			 		break;
				case 2:
					$filter['email'] = array('LIKE', '%'.$value.'%');
			 		break;
				case 3:
					$filter['mobile'] = array('LIKE', '%'.$value.'%');
			 		break;
				default:
					$filter = null;
					break;
			}
//			echo $value;
//			echo $type;
			if($filter && $value) {
				$db = M('member');
				$list = $db->where($filter)->order("time desc")->limit(100)->select();
				$this->assign('list',$list);// 模板变量赋值
			}
		}
		
		$this->assign('title', '查找会员');
		$this->assign('pid', 'mbmgr');
		$this->assign('mid', 'fdmb');
		$this->display();
	}
}