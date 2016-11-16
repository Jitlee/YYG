<?php
namespace Admin\Controller;
use Think\Controller;
class Kanjia_backController extends CommonController {
	/*砍价规则列表*/
	public function index(){
		$map['status']=1;
		$map['type']=1;
		$list=M('kanjiarule')->where($map)->select();
		$this->list=$list;
		$this->assign('title', '活动金额设置');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #index');
		$this->display();
	}
	/* 添加砍价规则*/
	public function kanjia_add(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.');
		$data['create_time']=date('Y-m-d h:i:s',time());
		$rs=M('kanjiarule')->add($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'添加成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败，请稍后重试'));
		}
	}
	/* 编辑等级*/
	public function kanjia_edit(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.');
		$rs=M('kanjiarule')->where(array('kjr_id'=>$data['kjr_id']))->save($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'编辑成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'编辑失败，请稍后重试'));
		}
	}

	
	/*删除等级*/
	public function del(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.kjr_id');
		if(false!==M('kanjiarule')->where(array('kjr_id'=>$data))->delete()){
			$this->ajaxReturn(array('status'=>1,'info'=>'删除成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'删除失败，请刷新后重试'));
		}

	}

	/*参与活动列表*/
    public function canyu($pageSize = 20, $pageNum = 1){
    	// 分页
		$map['kanjia.type']=1;
		$db = D('Common/KanjiaUser','VModel');
		$count = $db->where($map)->count();
		if(!$pageSize) {
			$pageSize = 20;
		}
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

		$list=$db->where($map)->page($pageNum, $pageSize)->order('shengyumoney asc')->select();
		foreach ($list as $key => $value) {
			$list[$key]['bangkan_count']=M('bangkan')->where(array('kj_id'=>$vlaue['kj_id']))->count();
			$list[$key]['shengyubili']=round(($value['shengyumoney']/$value['money'])*100,2);
		}
    	$this->list=$list;
    	$this->assign('title','参与活动者列表');
    	$this->assign('pid','activity');
    	$this->assign('mid','activitymgr #canyu');
    	$this->display();
    }

    public function zhongjiang(){
		$map['type']=1;
    	$list=M('kanzhong')->where($map)->select();
		$this->list=$list;
		$this->assign('title', '中奖用户');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #zhongjiang');
		$this->display();
    }
    public function zhongjian_add(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.');
		$data['time']=time();
		$rs=M('kanzhong')->add($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'添加成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败，请稍后重试'));
		}
	}
	public function zhongjian_edit(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.');
		$rs=M('kanzhong')->where(array('zj_id'=>$data['zj_id']))->save($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'编辑成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'编辑失败，请稍后重试'));
		}
	}
	public function kanzhong_del(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.zj_id');
		if(false!==M('kanzhong')->where(array('zj_id'=>$data))->delete()){
			$this->ajaxReturn(array('status'=>1,'info'=>'删除成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'删除失败，请刷新后重试'));
		}

	}

	/*福分砍价规则列表*/
	public function ffindex(){
		$map['status']=1;
		$map['type']=2;
		$list=M('kanjiarule')->where($map)->select();
		$this->list=$list;
		$this->assign('title', '福分活动金额设置');
		$this->assign('action', U('ffindex', '', ''));
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #ffindex');
		$this->display();
	}
		/*福分参与活动列表*/
    public function ffcanyu($pageSize = 20, $pageNum = 1){
    	// 分页
    	$map['type']=2;
		$db = D('Common/KanjiaUser','VModel');
		$count = $db->where($map)->count();
		if(!$pageSize) {
			$pageSize = 20;
		}
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

		$list=$db->where($map)->page($pageNum, $pageSize)->order('shengyumoney asc')->select();
		foreach ($list as $key => $value) {
			$list[$key]['bangkan_count']=M('bangkan')->where(array('kj_id'=>$vlaue['kj_id']))->count();
			$list[$key]['shengyubili']=round(($value['shengyumoney']/$value['money'])*100,2);
		}
    	$this->list=$list;
    	$this->assign('title','福分参与活动者列表');
    	$this->assign('pid','activity');
    	$this->assign('mid','activitymgr #ffcanyu');
    	$this->display();
    }
    /*福分中奖记录*/
    public function ffzhongjiang(){
    	$map['type']=2;
    	$list=M('kanzhong')->where($map)->select();
		$this->list=$list;
		$this->assign('title', '福分中奖用户');
		$this->assign('action', U('ffzhongjiang', '', ''));
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #ffzhongjiang');
		$this->display();
    }
    /*饮料参与活动列表*/
    public function ylcanyu($pageSize = 20, $pageNum = 1){
    	// 分页
		$map['kanjia.type']=3;
		$db = D('Common/KanjiaUser','VModel');
		$count = $db->where($map)->count();
		if(!$pageSize) {
			$pageSize = 20;
		}
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

		$list=$db->where($map)->page($pageNum, $pageSize)->order('shengyumoney asc')->select();
		foreach ($list as $key => $value) {
			$list[$key]['bangkan_count']=M('bangkan')->where(array('kj_id'=>$vlaue['kj_id']))->count();
			$list[$key]['shengyubili']=round(($value['shengyumoney']/$value['money'])*100,2);
		}
    	$this->list=$list;
    	$this->assign('title','饮料参与活动者列表');
    	$this->assign('pid','activity');
    	$this->assign('mid','activitymgr #ylcanyu');
    	$this->display();
    }
    /*饮料活动中奖*/
    public function ylzhongjiang($pageSize = 20, $pageNum = 1){
    	$db=D('KanjiaUser','VModel');
    	$count = $db->where($map)->count();
		if(!$pageSize) {
			$pageSize = 20;
		}
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
		$map['type']=3;
		$map['status']=2;
    	$list=$db->where($map)->page($pageNum, $pageSize)->order('end_time asc')->select();
    	// print_r($list);
		$this->list=$list;
		$this->assign('title', '饮料中奖用户');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #ylzhongjiang');
		$this->display();
    }
    /*发货操作*/
    public function fahuo(){
    	$data=I('post.');
    	if(!IS_POST)$this->error('非法操作');
    	$data['msgtype']='kddx';
    	$data['msgtime']=date('Y-m-d H:i:s');
    	$data['status']=99;
    	// unset($data['kj_id']);
    	$status=M('message')->add($data);
    	$msg = D("Home/Verifycode");
    	$rs=$msg->SendMessageByTemplate($data['mobile'],$data['par1'],$data['par2'],'23832');
		// $rs=$msg->Sendkd($data['mobile'],$data['par1'],$data['par2']);
		if($rs["status"] !=0)	
		{
			$datamsg["errormsg"] = $rs["msg"];	
		}

    	if($status){
    		M('kanjia')->where(array('kj_id'=>$data['kj_id']))->setField('is_send','1');
    		$this->ajaxReturn(array('status'=>1,'info'=>'发货成功'));
    	}
    	else{
    		$this->ajaxReturn(array('status'=>0,'info'=>'发货失败，请稍后重试'));
    	}
    }
}