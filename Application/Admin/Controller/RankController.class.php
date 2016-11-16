<?php
namespace Admin\Controller;
use Think\Controller;
class RankController extends CommonController {
	/*等级列表*/
	public function index(){
		$list=M('rank')->where()->order('sort asc')->select();
		foreach ($list as $key => $value) {
			$list[$key]['rank_total']=M('member')->where(array('rank_id'=>$value['rank_id']))->count();
			if(!empty($value['sort'])){
				$rank_list[]=$value['rank_id'];
			}
		}
		$this->rank_list=$rank_list;
		$this->list=$list;
		$this->assign('title', '等级设置');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'rank');
		$this->assign('mid', 'rankmgr #index');
		$this->display();
	}
	/* 添加等级*/
	public function rank_add(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.');
		$data['create_time']=date('Y-m-d h:i:s',time());
		$rs=M('rank')->add($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'添加成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败，请稍后重试'));
		}
	}
	/* 编辑等级*/
	public function rank_edit(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.');
		$data['create_time']=date('Y-m-d h:i:s',time());
		$rs=M('rank')->where(array('rank_id'=>$data['rank_id']))->save($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'编辑成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'编辑失败，请稍后重试'));
		}
	}

	/*保存等级链*/
	public function save(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.arr');
		$data1=array_count_values($data);
		foreach ($data1 as $k1 => $v1) {
			if($v1>1){
				$this->ajaxReturn(array('status'=>0,'info'=>'等级链不能有重复值'));
			}
		}
		foreach ($data as $key => $value) {
			M('rank')->where(array('rank_id'=>$value))->setField('sort',$key+1);
			M('member')->where(array('rank_id'=>$value))->setField('level',$key+1);
		}
		M('rank')->where(array('rank_id'=>array('not in',$data)))->setField('sort',NULL);
		M('member')->where(array('rank_id'=>array('not in',$data)))->setField('level',NULL);
		$this->ajaxReturn(array('status'=>1,'info'=>'保存成功'));
	}
	
	/*删除等级*/
	public function del(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.id');
		if(false!==M('rank')->where(array('rank_id'=>$data))->delete()){
			M('member')->where(array('rank_id'=>$data))->delete();
			$this->ajaxReturn(array('status'=>1,'info'=>'删除成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'删除失败，请刷新后重试'));
		}

	}
}