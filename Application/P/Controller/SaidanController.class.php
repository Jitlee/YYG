<?php
namespace P\Controller;
use Think\Controller;
use P\Model;

class SaidanController extends CommonController {
	
		public function detail($gid=null,$qishu=null)
		{
			//当前
			$fit['gid'] = $gid;
			$fit['qishu'] = $qishu;
			$db=M("shaidan");					
			$sditem= $db->where($fit)->find();
			$this->assign("sditem", $sditem);
			
			$content = htmlspecialchars_decode(html_entity_decode($sditem['content']));
			$this->assign('content', $content);
			
			//最新评论
			$Model = M();
			$newitem=$Model->query('SELECT  sid,yyg_shaidan.uid, gid,qishu,gtype,ip,title,content,photos,thumbs,zan,ping, yyg_shaidan.time,yyg_member.username,yyg_member.img userimg FROM yyg_shaidan inner join yyg_member ON yyg_member.uid=yyg_shaidan.uid order by time desc limit 10 ');		
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
			
			$this->SetPage($pageSize,$pageNum,$total);
			
			$list = $db->join(" yyg_member ON yyg_member.uid=yyg_shaidan.uid")
					->field("sid,yyg_shaidan.uid, gid,qishu,gtype,ip,title,content,photos,thumbs,zan,ping, yyg_shaidan.time,yyg_member.username,yyg_member.img userimg")
					->order('time desc')->page($pageNum, $pageSize)->select();
			
			$sa_one=array();$sa_two=array();$sa_tree=array();$sa_for=array();	
			$dn=count($list);				
			if($dn>0)$sa_one[]=$list[0];
			if($dn>1)$sa_two[]=$list[1];
			if($dn>2)$sa_tree[]=$list[2];
			if($dn>3)$sa_for[]=$list[3];
			
			if($list && count($list)>3){
				$n=0;
				for($i=4;$i<count($list);$i++){
					
					$n=$i%4;
					if($n==0){
						array_push($sa_one,$list[$i]);
					}else if($n==1){
						//$sa_two[]=$list[$i];
						array_push($sa_two,$list[$i]);
					}else if($n==2){
						//$sa_tree[]=$list[$i];
						array_push($sa_tree,$list[$i]);
					}else if($n==3){
						//$sa_for[]=$list[$i];
						array_push($sa_for,$list[$i]);
					}
					$n+=$lie;				 
					$n++;
				}
			}
			//总数
			$this->assign("total", $total);
			
			$this->assign("list", $list);
			$this->assign("sa_one", $sa_one);
			$this->assign("sa_two", $sa_two);
			$this->assign("sa_tree",$sa_tree);
			$this->assign("sa_for", $sa_for);		
			$this->display();
		}	
		

}
	