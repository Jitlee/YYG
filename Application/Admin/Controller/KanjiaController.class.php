<?php
namespace Admin\Controller;
use Think\Controller;
class KanjiaController extends CommonController {
	/*砍价规则列表*/
	public function index(){
		$map['status']=1;
		$map['type']=1;
		$list=M('kanjiarule')->where($map)->order('kjr_yikan')->select();
		$this->list=$list;
		$this->assign('title', '活动金额设置');
		
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #index');
		
		
		$this->display();
	}
	
	public function paralist()
	{
		$list=M('KanjiaPara')->select();
		$this->list=$list;
		

		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #index');
		$this->display();
	}
	
	public function paraedit($kjid=0)
	{
		$m = D('Admin/KanjiaPara');
    	$object = array();		 
    	if($kjid>0){
    		$object = $m->get($kjid);
    	}else{
    		$object = $m->getModel(); 
    	}
    	$this->assign('object',$object);
		$this->display();
	}
	public function paraeditsave(){
		$m = D('Admin/KanjiaPara');
    	$rs = array();
    	if(I('kjid',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	
	/* 添加砍价规则*/
	public function kanjia_add(){
		$this->isAjaxLogin();
		$this->checkAjaxPrivelege('gggl_03');
		$data=I('post.');		
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
	
	/*积分砍价规则列表*/
	 public function sendprize(){
		if(!IS_AJAX)$this->error('非法操作');
		$zj_id=I('zj_id');
		///false!==M('kanzhong')->where(array('zj_id'=>$data))->delete()
		//获取砍价相关信息
		$mdbpara = D('Admin/KanjiaPara');

		$rst  = $mdbpara->updatePrizeid($zj_id);
		if($rst!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'发送奖品成功'.$zj_id));
			exit;
		}
		$this->ajaxReturn(array('status'=>0,'info'=>'发送奖品失败，请刷新后重试.'));		
	}
	/*积分砍价规则列表*/
	public function ffindex($kjcode){
		$map['status']=1;

		$map['type']=$kjcode;
		$list=M('kanjiarule')->where($map)->select();
		$this->list=$list;
		$this->assign('title', '积分活动金额设置');
		$this->assign('action', U('ffindex', '', ''));
		$this->assign('kjcode', $kjcode);
		
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #index');
		
		$this->display();
	}
	
	public function kanjiaitemdel(){
		$m = D('Admin/KanjiaPara');
    	$rs = $m->kanjiaItemDel();
    	$this->ajaxReturn($rs);
	}
	
	/*积分参与活动列表*/
    public function ffcanyu($kjcode,$pageSize = 15, $pageNum = 1){
//  	$pageSize = 20;
//		$pageNum = (int)I("p",1);
//		$kjcode	=I("kjcode");
    	// 分页
    	$map['type']=$kjcode;
		$db = M('kanjia');
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

		$list=$db
			->join('kj inner join yyg_wx_user u on u.wx_id=kj.wx_id')			
			->where($map)->page($pageNum, $pageSize)
			-> order(" shengyumoney asc,time desc")
			->select();
		foreach ($list as $key => $value) {
			$list[$key]['bangkan_count']=M('bangkan')->where(array('kj_id'=>$vlaue['kj_id']))->count();
			$shengyu=round(($value['shengyumoney']/$value['money'])*100,2);
			$list[$key]['shengyubili']=$shengyu;
//			$list[$key]['shengyubili']=round(($value['shengyumoney']/$value['money'])*100,2);
			$candel=0;
			if($shengyu > 85)
			{
				$candel=1;
			}
			$list[$key]['candel']=$candel;
		}
		
			
    	$this->list=$list;
    	$this->assign('title','参与活动者列表');
    	$this->assign('kjcode', $kjcode);
    	
    	$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #index');
		
    	$this->display();
    }
    /*积分中奖记录*/
    public function ffzhongjiang($kjcode){
//  	$kjcode	=I("kjcode");
    	$map['type']=$kjcode;
    	$list=M('kanzhong')->where($map)->select();
		$this->list=$list;
		$this->assign('title', '中奖用户');
		$this->assign('kjcode', $kjcode);
		$this->assign('action', U('ffzhongjiang', '', ''));
	
		$this->assign('pid', 'activity');
		$this->assign('mid', 'activitymgr #index');
		
		$this->display();
    }
}