<?php
namespace Home\Controller;
use Think\Controller;
class MiaoShaController extends Controller {
		
	public function index(){
    		$this->assign('title', '秒杀');
		$this->assign('pid', 'miaosha');
        $this->display();
    }
	
	public function eee(){
    		$this->assign('title', '秒杀');
		$this->assign('pid', 'miaosha');
        $this->display();
    }
	
	public function pageAll($pageSize, $pageNum) {
		// 分页
		$db = M('miaosha');
		$filter["jishijiexiao"] = 0;
		$list = $db->where($filter)->order('time desc')->page($pageNum, $pageSize)->field('gid,title,thumb,money,danjia,status')->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function _empty($gid) {
		$this->view($gid);
	}
	
	protected function view($gid) {
		$this->assign('title', '拍卖详情');
		layout('sublayout');
		$this->display('view');
	}
}
	