<?php
namespace Admin\Controller;
use Think\Controller;
class AutoController extends CommonController {
	public function index(){
		// S('auto_time','0',1);
		$auto_id=S('auto_id');
		$auto_bl=F('auto_bl');
		// dump($auto_id);die;
		$M=M('miaosha');
		$D=M('member_miaosha');
		if(!empty($auto_id)){
			$map['gid']=array('in',$auto_id);
			$map['in_auto']=array('in','1');
			$map['status']=array('in','0,1');
			
			$list=$M->where($map)->select();
			foreach ($list as $key => $value) {
				//找到这商品
				$total=$D->JOIN('yyg_member ON yyg_member_miaosha.uid=yyg_member.uid')->where(array('gid'=>$value['gid'],'qishu'=>$value['qishu'],'yyg_member.is_false'=>1))->getField('sum(`count`) as total');
				$list[$key]['bl']=round((($total)/$value['zongrenshu'])*100,2);
				if($list[$key]['bl']>=$auto_bl){
					$list[$key]['xiaohao_status']=1;
				}
			}
			$this->list=$list;
		}
		$this->auto_bl=F('auto_bl');
		$auto_status=S('auto_status');
		$auto_time=S('auto_time');
		$this->auto_time=$auto_time;
		$this->auto_status=$auto_status;
		$this->assign('title', '设置自动下单');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'automgr');
		$this->assign('mid', 'index');
		$this->display();
	}
	/*开启进程*/
	public function start(){
		if(IS_AJAX&&IS_POST){
			if(S('auto_status')==1){
				$this->ajaxReturn(array('status'=>0,'info'=>'进程已经开启中'));
			}elseif(S('auto_status',1)&&S('auto_time',time())){
				$this->ajaxReturn(array('status'=>1,'info'=>'开启成功'));
			}else{
				$this->ajaxReturn(array('status'=>0,'info'=>'开启失败，刷新后重试'));
			}
			
		}
		$this->error('非法操作');
	}
	/*暂停进程*/
	public function stop(){
		if(IS_AJAX&&IS_POST){
			if(S('auto_status')!=1){
				$this->ajaxReturn(array('status'=>0,'info'=>'进程尚未开启'));
			}
			if(S('auto_status',2)&&S('auto_time',0,0.1)){
				$this->ajaxReturn(array('status'=>1,'info'=>'暂停成功'));
			}else{
				$this->ajaxReturn(array('status'=>0,'info'=>'暂停失败，刷新后重试'));
			}
			$this->ajaxReturn(array('status'=>1,'info'=>'暂停成功'));
		}
		$this->error('非法操作');
	}
	// /*关闭进程*/
	// public function auto_exit(){
	// 	if(IS_AJAX&&IS_POST){
	// 		$data=$this->client('exit');
	// 		$this->ajaxReturn($data);
	// 		// $this->ajaxReturn(array('status'=>1,'info'=>'结束成功'));
	// 	}
	// 	$this->error('非法操作');
	// }

	
	/*移除auto_id*/
	public function out_auto(){
		if(!IS_AJAX)$this->error('非法操作');
		$id=I('post.gid');
//		$auto_id=S('auto_id');
//		if(count($auto_id)==1){
//			$auto_id=array();
//		}
//		else{
//			foreach ($auto_id as $key => $value) {
//				if($value==$id){
//					unset($auto_id[$key]);
//				}
//			}	
//		}
//		S('auto_id',$auto_id);
		$rs=M('miaosha')->where(array('gid'=>$id))->setField('in_auto',0);
		$this->ajaxReturn(array('status'=>1,'info'=>'取消成功'));
		
	}
	/*设置比例*/
	public function save_bl(){
		if(IS_AJAX){
			$bl=I('post.auto_bl');
			if(empty($bl)){
				$this->ajaxReturn(array('status'=>0,'info'=>'比例设置不能为【0】或【空】'));
			}
			if($bl>=100){
				$this->ajaxReturn(array('status'=>0,'info'=>'比例设置不能大于50'));
			}
			F('auto_bl',$bl);
			$this->ajaxReturn(array('status'=>1,'info'=>'设置成功'));
		}
	}

	//快速下单规则设置
	public function autoset(){
		$list=M('auto_rule')->select();
		$this->list=$list;
		$this->assign('title', '设置快速开奖规则');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'automgr');
		$this->assign('mid', 'autoset');
		$this->display();
	}
	/*添加规则*/
	public function autorule_add(){
		if(!IS_POST)$this->error('非法操作');
		$data=I('post.');
		$rs=M('auto_rule')->add($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'添加成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败'));
		}
	}
	/*删除规则*/
	public function autoset_del(){
		if(!IS_POST)$this->error('非法操作');
		$data=I('post.');
		$rs=M('auto_rule')->where($data)->delete();
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'添加成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败'));
		}
	}
}