<?php
namespace Home\Controller;
use Think\Controller;
class PaimaiController extends Controller {
    public function index(){
    		$this->assign('title', '拍卖专区');
		$this->assign('pid', 'paimai');
		
		// 推荐
		$db = M('paimai');
		$tuijian = $db->where('tuijian=1 AND (status=0 OR status=1)')->order('time desc')->find();
		if(!$tuijian) {
			$tuijian = $db->where('renqi=1 AND (status=0 OR status=1)')->order('time desc')->find();
			if(!$tuijian) {
				$tuijian = $db->where('status=0 OR status=1')->order('time desc')->find();
			}
		}
		
		if($tuijian) {
			session('tuijian_first_id', $tuijian['gid']);
			$filter['gid'] = array("neq", $tuijian['gid']);
			$this->assign('tuijian', $tuijian);
		}
		
		$list = $db->where($filter)
			->order('tuijian desc, time desc')
			->page($pageNum, $pageSize)
			->field('gid,title,thumb,zuigaojia,status,end_time')
			->select();
		$this->assign('list', $list);
		
        $this->display();
    }
	
	public function page($pageSize = 8, $pageNum = 1) {
		$filter = null;
		if(session('?tuijian_first_id')) {
			$filter['gid'] = array("neq", session('tuijian_first_id'));
		}
		
		// 分页
		$db = M('paimai');
		$list = $db->where($filter)->order('tuijian desc, time desc')->page($pageNum, $pageSize)->field(array('gid','title','thumb','zuigaojia','status','UNIX_TIMESTAMP(end_time)'=>'end_time'))->select();
		$this->ajaxReturn($list, "JSON");
	}
}