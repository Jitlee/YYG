<?php
namespace Home\Model;
use Think\Model;
class MemberScoreModel extends Model{
    
	public function AddLessScore($addType,$score)
	{		
			$udb = M('member');
			$menberfilter["uid"]=session("_uid");
			$dbmember = $udb->where($menberfilter)->find();
			if(!$dbmember) {
				$result["msg"]='用户不存在。';
			}
			else
			{
				//1. 扣减member数据  2. 写入钱包记录  3  写入提现记录	手费费				
				$score= floatval($score);			
				$Userscore=floatval($dbmember['score']);
				$reScore	=	$Userscore + 		$score;
				if($reScore<0)
				{
					$result["msg"]="积分不足。".$dbmember['score'];				
				}
				else
				{
					//1. 扣减member数据 					
					if($dbmember)
					{
						$dbmember['score'] = $reScore;
						$udb->save($dbmember);					
					}
					
					//3  写入提现记录
					$dbcash = M('member_score');
					$newitem['uid']=  session("_uid");
					$newitem['time']= date('y-m-d-H-i-s');
					$newitem['scoresource']= $addType;
					$newitem['score']= $score;
					
					$dbcash->create($newitem);
					if($dbcash->add() != false) {
						$result["status"]=1;
					} 
					else 
					{
						$result["msg"]='数据错误';
					} 
				}
			} 
			return $result;
	}
	public function AddScoreRecord($uid,$addType,$score)
	{		
			$udb = M('member');
			$menberfilter["uid"]=$uid;
			$dbmember = $udb->where($menberfilter)->find();
			if(!$dbmember) {
				$result["msg"]='用户不存在。';
			}
			else
			{
				//3  写入记录
				$dbcash = M('member_score');
				$newitem['uid']=  $uid;
				$newitem['time']= date('y-m-d-H-i-s');
				$newitem['scoresource']= $addType;
				$newitem['score']= $score;
				
				$dbcash->create($newitem);
				if($dbcash->add() != false) {
					$result["status"]=1;
				} 
				else 
				{
					$result["msg"]='数据错误';
				} 
				 
			} 
			return $result;
	}
	public function AddScore($uid,$addType,$score)
	{		
			$udb = M('member');
			$menberfilter["uid"]=$uid;
			$dbmember = $udb->where($menberfilter)->find();
			if(!$dbmember) {
				$result["msg"]='用户不存在。';
			}
			else
			{
				//1. 扣减member数据  2. 写入钱包记录  3  写入提现记录	手费费				
				$score= (int)$score;			
				$Userscore=(int)$dbmember['score'];
				$reScore	=	$Userscore + $score;
				if($reScore<0)
				{
					$result["msg"]="积分不足。".$dbmember['score'];				
				}
				else
				{
					//1. 扣减member数据 					
					if($dbmember)
					{
						$dbmember['score'] = $reScore;
						$udb->save($dbmember);					
					}					
					//3  写入记录
					$this->AddScoreRecord($uid,$addType,$score);
				}
			} 
			return $result;
	}
	
	
	public  function getGood($gid, $qishu = null) {
		if(!$qishu) {
			$db = M('miaosha');
			return $db->field('gid,title,subtitle,thumb,money,xiangou,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,time end_time')->find($gid);
		} else {
			// 历史
			$db = M('MiaoshaHistory');
			$map['gid'] = $gid;
			$map['qishu'] = $qishu;
			$data = $db->field('gid,title,subtitle,thumb,money,xiangou,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,prizeuid,prizecode,end_time')->where($map)->find();
			if(empty($data)) {
				return $this->getGood($gid);
			}
			
			// 获取当情期
			$mdb = M('miaosha');
			$mmap['gid'] = $gid;
			$mmap['status'] = array('lt', 2);
			$current = $mdb->field('qishu')->where($mmap)->find();
			$data['current'] = $current['qishu'];
			
			// 获取当前中奖用户
			if($data['prizeuid']) {
				$udb = M('member');
				$user = $udb->field(array('uid','IFNULL(NULLIF(username, \'\'), INSERT(mobile,4,4,\'****\'))'  => 'username', 'img'))->find($data['prizeuid']);
				$data['prizer'] = $user;
				
				// 获取用户当期购买数量
				$mhdb = M('MiaoshaCode');
				$mhmap['uid'] = $data['prizeuid'];
				$mhmap['gid'] = $data['gid'];
				$mhmap['qishu'] = $data['qishu'];
				$count = $mhdb->where($mhmap)->count();
				$data['prizer']['count'] = $count;
			}
			
			return $data;
		}
	}


	
}