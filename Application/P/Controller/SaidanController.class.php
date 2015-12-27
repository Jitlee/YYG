<?php
namespace P\Controller;
use Think\Controller;
use P\Model;

class SaidanController extends Controller {
	
		public function detail($gid=null,$qishu=null)
		{
			//当前
			$fit['gid'] = $gid;
			$fit['qishu'] = $qishu;
			$db=M("shaidan");					
			$sditem= $db->where($fit)->find();
			$this->assign("sditem", $sditem);

			//最新评论
			$Model = M();
			$newitem=$Model->query('SELECT  * FROM yyg_shaidan order by time desc');		
			$this->assign("newitem", $newitem);
			
			 
			
			$m = D('P/MemberScore');
			$oldgoods = $m->getGood($gid,$qishu);
			$this->assign("oldgoods", $oldgoods);
			
			$m = D('P/MemberScore');
			$cg = $m->getGood($gid);
			$this->assign("cgoods", $cg);
			
			$this->display();
		}
		
		public function xianmu($sid)
		 {
			$fit['sid'] = $sid;
			$db=M("shaidan");					
			$sditem= $db->where($fit)->find();
			$xianmu=0;
			if($sditem)
			{
				$xianmu=floatval($sditem["zan"]);
				$sditem["zan"]=$xianmu+1;
				$db->save($sditem);
			}
			return $this->ajaxReturn($xianmu);
		}	
		
		public function index($pageSize = 40, $pageNum = 1)
		{
			$title="晒单分享";
			// 分页
			$db = D('shaidan');
			$total = $db->where($map)->count();
			if(!$pageSize) {
				$pageSize = 40;
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
			
			$list = $db
			->join(" yyg_member ON yyg_member.uid=yyg_shaidan.uid")
			->field("sid,yyg_shaidan.uid, gid,qishu,gtype,ip,title,content,photos,thumbs,zan,ping, yyg_shaidan.time,yyg_member.username,yyg_member.img userimg")
			->order('time desc')->page($pageNum, $pageSize)->select();
			
				
			$sa_one=array();
			$sa_two=array();
			$sa_tree=array();
			$sa_for=array();		
			
			if($list){
				$n=0;
				for($i=0;$i<count($list);$i++){
					if($n=4)
					{
						$n=0;
					}
					 
					if($i==0){
						$sa_one[]=$list[$i];
					}else if($i==1){
						$sa_two[]=$list[$n];
					}else if($i==2){
						$sa_tree[]=$list[$n];
					}else if($i==3){
						$sa_for[]=$list[$n];
					}
					$n+=$lie;				 
					$n++;
				}
			}
			//总数
			$this->assign("total", $total);
			$this->assign("sa_one", $sa_one);
			$this->assign("sa_one", $sa_one);
			$this->assign("sa_two", $sa_two);
			$this->assign("sa_tree",$sa_tree);
			$this->assign("sa_for", $sa_for);		
			$this->display();
		}	
		

}
	