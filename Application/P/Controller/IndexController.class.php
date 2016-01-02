<?php
namespace P\Controller;
class IndexController extends CommonController {
		
	public function index(){
		
		run_task();
    		$this->assign('title', '一元购');
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
		
		// 商品分类
		$cdb = D('category');
		$categories = $cdb->relation(true)->page(1,6)->select();
		$this->assign('allCategories', $categories);
		
		$data=session('wxUserinfo');
		$this->assign('data', $data);
		
		// 最新揭晓
		$hdb = M('MiaoshaHistory');
		$filter = 'prizeuid is not null and exists(select 0 from yyg_miaosha b where yyg_miaosha_history.gid = b.gid and (yyg_miaosha_history.qishu = b.qishu or yyg_miaosha_history.qishu = b.qishu - 1))';
		$zuixins = $hdb->join('yyg_member on yyg_member.uid = yyg_miaosha_history.prizeuid')
			->where($filter)->order('end_time desc')
			->field(array('yyg_miaosha_history.gid','yyg_miaosha_history.title','yyg_miaosha_history.thumb',
				'yyg_miaosha_history.money','yyg_miaosha_history.danjia','yyg_miaosha_history.xiangou',
				'yyg_miaosha_history.status','yyg_miaosha_history.qishu','yyg_miaosha_history.canyurenshu',
				'yyg_miaosha_history.zongrenshu','yyg_miaosha_history.type','yyg_miaosha_history.prizeuid',
				'IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
			->page(1,10)->select();
		$this->assign('zuixins', $zuixins);
		
		// 推荐商品
		$gdb = M('miaosha');
		$tuijians = $gdb->where('status <> 2 and tuijian = 1')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,type')->page(1,2)->select();
		$this->assign('tuijians', $tuijians);
		
//		// 最新揭晓count
//		$hdb = M('MiaoshaHistory');
//		$jiexiaocount = $hdb->where('jishijiexiao > 0 and to_days(end_time) = to_days(now())')->count();
//		$this->assign('jiexiaocount', $jiexiaocount);

		$remens = $gdb->where('status <> 2 and jishijiexiao=0')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,shengyurenshu,type')->page(1,8)->select();
		$this->assign('remens', $remens);
		
		$jijiagns = $gdb->where('status <> 2 and jishijiexiao>0')->order('time desc')->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,shengyurenshu,type')->page(1,8)->select();
		$this->assign('jijiagns', $jijiagns);
		$this->display();
    }

	public function view($gid, $qishu = null) {
		run_task();
		
		$this->assign('title', '商品详情');
		$data = $this->getGood($gid, $qishu);
		$data['content'] = htmlspecialchars_decode(html_entity_decode($data['content']));
		$this->assign('data', $data);
		
		$qishu = $data['qishu'];
		$this->assign('gid', $gid);
		$this->assign('qishu', $qishu);
		
		// 购买记录
		$mmdb = M('MemberMiaosha');
		$mmmap['gid'] = $gid;
		$mmmap['qishu'] = $qishu;
		$records = $mmdb->join('yyg_member on yyg_member.uid = yyg_member_miaosha.uid')
			->field(array('yyg_member_miaosha.id'=>'mid','yyg_member_miaosha.uid', 'yyg_member.img', 'yyg_member_miaosha.count','yyg_member_miaosha.time','IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
			->where($mmmap)->order('id desc')->page(1, 6)->select();
		if(!empty($records)) {
			$this->assign('records', $records);
		}
		
		// 本人购买记录
		if(is_login()) {
			$mmmap = array(
				'gid'		=> $gid,
				'qishu'		=> $qishu,
				'yyg_member_miaosha.uid'		=> get_temp_uid()
			);
			$myrecords = $mmdb->join('yyg_member on yyg_member.uid = yyg_member_miaosha.uid')
				->field(array('yyg_member_miaosha.id'=>'mid','yyg_member_miaosha.uid', 'yyg_member.img', 'yyg_member_miaosha.count','yyg_member_miaosha.time','IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
				->where($mmmap)->order('id desc')->page(1, 9)->select();
			if($myrecords) {
				$this->assign('myrecords', $myrecords);
			}
		}
		
		// 图片
		$imgdb = M('GoodsImages');
		$imgmap['gid'] = $gid;
		$images = $imgdb->where($imgmap)->select();
		$this->assign('images', $images);
		if(count($images) > 0) {
			$this->assign('firstImage', $images[0]);
		}
		
		$this->display();
	}
	
	private function getGood($gid, $qishu = null) {
		if($qishu == null) {
			$db = M('miaosha');
			$data = $db->field('gid,title,subtitle,thumb,money,danjia,xiangou,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,end_time,content')->find($gid);
			$data['qishu'] = intval($data['qishu']);
			$data['current'] = $data['qishu'];
			// 上期获得者
			if($data['qishu'] > 1) {
				$data['lastprizer'] = $this->getPrizer($gid, $qishu - 1);
			}	
			return $data;
		} else {
			// 历史
			$db = M('MiaoshaHistory');
			$map['gid'] = $gid;
			$map['qishu'] = $qishu;
			$data = $db->field('gid,title,subtitle,thumb,money,danjia,xiangou,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,prizeuid,prizecode,end_time,content')->where($map)->find();
			if(empty($data)) {
				return $this->getGood($gid);
			}
			
			// 获取当情期
			$mdb = M('miaosha');
			$mmap['gid'] = $gid;
			$mmap['status'] = array('lt', 2);
			$current = $mdb->field('qishu')->where($mmap)->find();
			$data['current'] = intval($current['qishu']);
			
			// 获取当前中奖用户
			if($data['prizeuid']) {
				$data['prizer'] = $this->getPrizer($gid, $qishu);
			}
			
			return $data;
		}
	}

	private function getPrizer($gid, $qishu) {
		$udb = M('member');
		$umap = array(
			'yyg_miaosha_history.qishu' => $qishu,
			'yyg_miaosha_history.gid
			' => $gid,
		);
		return $udb->field(array('yyg_miaosha_history.end_time', 'yyg_miaosha_history.prizecode',
				'IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))'  => 'username',
				'yyg_member.uid', 'yyg_member.img', 'yyg_member.login_ip', 
				'yyg_miaosha_code.time' => 'record_time'))
			->join('yyg_miaosha_history on yyg_miaosha_history.prizeuid = yyg_member.uid')
			->join('yyg_miaosha_code on yyg_miaosha_code.uid = yyg_member.uid and yyg_miaosha_history.gid = yyg_miaosha_code.gid and yyg_miaosha_code.qishu = yyg_miaosha_history.qishu')
			->where($umap)
			->find();
	}
	
	public function record($gid, $qishu, $pageNo = 1) {
		// 购买记录
		$db = M('MemberMiaosha');
		$map['gid'] = $gid;
		$map['qishu'] = $qishu;
		$pageSize = 10;
		
		$list = $db->join('yyg_member on yyg_member.uid = yyg_member_miaosha.uid')
			->field(array('yyg_member_miaosha.id'=>'mid','yyg_member_miaosha.uid', 'yyg_member.img', 'yyg_member_miaosha.count','yyg_member_miaosha.time','IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
			->where($map)->order('id desc')->page($pageNo, $pageSize)->select();
		if(!empty($list)) {
			$this->assign('list', $list);
		}
		
		$num = 0;
		$total = 0;
		if($list) {
			$this->assign('list', $list);
			$num = count($list);
			
			$total = $db->join('yyg_member on yyg_member.uid = yyg_member_miaosha.uid')->where($map)->count();
			
			$pageCount = ceil($total / $pageSize);
			$this->assign('pageSize', $pageSize);
			$this->assign('pageNo', $pageNo);
			$this->assign('pageCount', $pageCount);
			$this->assign('minPageNo', floor(($pageNo-1)/10.0) * 10 + 1);
			$this->assign('maxPageNo', min(ceil(($pageNo)/10.0) * 10 + 1, $pageCount));
		}
		
		$this->assign('gid', $gid);
		$this->assign('qishu', $qishu);
		$this->assign('num', $num);
		$this->assign('total', $total);
		layout(false);
		$this->display();
	}
	
}
	