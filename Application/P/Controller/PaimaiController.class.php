<?php
namespace P\Controller;
use Think\Controller;
class PaimaiController extends CommonController {
    public function index($cid = 0, $pageNo = 1){
		run_task();
		$this->assign('title', '拍卖专区');
		$this->assign('pid', 'paimai');
		
		$pmap = array(
//			'status'		=> array('neq', 2)
		);
		if($cid > 0) {
			$pmap['cid'] = $cid;
		}
		
		$order = 'time desc';
//		switch($sort) {
//			case 1:
//				$order = 'end_time desc';
//				break;
//			case 2:
//				$order = 'canyurenshu desc';
//				break;
//			case 3:
//				$order = 'shengyurenshu asc';
//				break;
//			case 4:
//				$order = 'money asc';
//				break;
//			case 5:
//				$order = 'money desc';
//				break;
//			default:
//				break;
//		}
		
		$num = 0;
		$total = 0;
		$pageSize = 12;
		
		$pdb = M('Paimai');
		$list = $pdb->where($pmap)->field(array('gid','title','thumb','qipaijia',
				'jiafujia','chujiacishu','zuigaojia','status','baomingrenshu',
				'type','renqi','tuijian', 'baoyou', 'end_time', 'now() - end_time' => '_time'))
			->order($order)->page($pageNo, $pageSize)->select();
		if($list) {
			$this->assign('list', $list);
			$num = count($list);
			
			$total = $pdb->where($pmap)->count();
			
			$pageCount = ceil($total / $pageSize);
			$this->assign('pageSize', $pageSize);
			$this->assign('pageNo', $pageNo);
			$this->assign('pageCount', $pageCount);
			$this->assign('minPageNo', floor(($pageNo-1)/10.0) * 10 + 1);
			$this->assign('maxPageNo', min(ceil(($pageNo)/10.0) * 10 + 1, $pageCount));
		}

		$this->assign('num', $num);
		$this->assign('total', $total);
		$this->assign('cid', $cid);
		
		$renqi = $pdb->where('status < 2')
			->field('gid,title,thumb,zuigaojia,chujiacishu')
			->order('chujiacishu desc')->page(1, 12)->select();
			
		$this->assign('renqi', $renqi);
		
        $this->display();
    }
	
	public function view($gid) {
		$this->assign('title', '拍卖详情');
		$db = M('paimai');
		$data = $db->field('gid, title, subtitle,thumb, baoliujia,qipaijia,lijijia,jiafujia,zuigaojia,baomingrenshu,chujiacishu,baozhengjin,prizeuid, liji,status, content,end_time')->find($gid);
		$data['content'] = htmlspecialchars_decode(html_entity_decode($data['content']));
		$this->assign('data', $data);
		
		$data['baoliujia'] = intval($data['baoliujia']);
		$baoliu = $data['baoliujia'] > 0;
		$this->assign('baoliu', $baoliu);
		
		$imgdb = M('GoodsImages');
		$imgmap['gid'] = $gid;
		$imgmap['type'] = 3;
		$images = $imgdb->where($imgmap)->select();
		if(count($images) > 0) {
			$this->assign('firstImage', $images[0]);
		}
		$this->assign('images', $images);
		
		$data['status'] = intval($data['status']);
		$data['qipaijia'] = intval($data['qipaijia']);
		$data['zuigaojia'] = intval($data['zuigaojia']);
		$data['jiafujia'] = intval($data['jiafujia']);
		$zuidijia = $data['qipaijia'];
		if($data['zuigaojia'] >= $data['qipaijia']) {
			$zuidijia = $data['zuigaojia'] + $data['jiafujia'];
		}
		$this->assign('zuidijia', $zuidijia);
		
		if($data['status'] < 2) {
			// 判断是否已出价
			$hdb = M('MemberPaimai');
			$hmap['uid'] = get_temp_uid();
			$hmap['gid'] = $gid;
			$record = $hdb->where($hmap)->order('id desc')->find();
			if($record) {
				$this->assign('isBaozheng', true);
				if(intval($record['flag']) > 0) {	
					$this->assign('lastChujia', $record['money']);	
				}
			}
		} else {
			// 获取当前中奖用户
			if($data['prizeuid']) {
				$udb = M('member');
				$user = $udb->field('uid, username, email, mobile, img, qianming')->find($data['prizeuid']);
				$data['prizer'] = $user;
					
				if(empty($user['username'])) {
					$user['username'] = substr($user['mobile'], 0, 3).'****'.substr($user['mobile'], 7, 4);
				}
				$this->assign('prizer', $user);
			}
		}
		$this->display(); // 已结束
	}

	public function chujia($gid, $money) {
		if(is_login()) {
			$pdb = M('paimai');
			$good = $pdb->field('gid,zuigaojia, qipaijia, jiafujia, chujiacishu, status')->find($gid);
			$result = array();
			$mpdb = M('MemberPaimai');
			if(intval($good['status']) < 2) { // 如果 商品未结束
				$zuigaojia = floatval($good['zuigaojia']);
				$qipaijia = floatval($good['qipaijia']);
				$jiafujia = floatval($good['jiafujia']);
				$chujiacishu = intval($good['chujiacishu']);
				$money = floatval($money);
				
				$uid = get_temp_uid();
				// 检测是否缴纳保证金
				$mpmap['gid'] = $good['gid'];
				$mpmap['uid'] = $uid;
				$mpmap['flag'] = 0;
				$record = $mpdb->where($mpmap)->find();
				if(!$record) {
					$result['status'] = 2;
					$result['message'] = '操作异常，请先缴纳保证金';
				} else if($money < $zuigaojia + $jiafujia) {
					$result['status'] = 3;
					$result['message'] = '出价不能低于当前的最高出价与加价幅度之和';
				} else if($money < $qipaijia) {
					$result['status'] = 4;
					$result['message'] = '出价不能低于起拍价';
				} else {
					$mpdata['uid'] = $uid;
					$mpdata['gid'] = $good['gid'];
					$mpdata['flag'] = 1;
					$mpdata['money'] = $money;
					if($mpdb->add($mpdata)) {
						$good['chujiacishu']++;
						$good['zuigaojia'] = $money;
						$good['chujiazhe'] = $uid;
						if($pdb->save($good)) {
							add_renci(1);
							$result['status'] = 0;
							$result['message'] = '出价成功';
							add_renci(1);
						} else {
							$result['status'] = 6;
							$result['message'] = '出价失败';
						}
					} else {
						$result['status'] = 5;
						$result['message'] = '出价失败';
					}
				}
			} else { // 已结束
				$result['status'] = 1;
				$result['message'] = '拍卖已结束';
			}
			$this->ajaxReturn($result, 'JSON');
		}
	}

	/**
	 * 刷新数据
	 * 返回商品状态和最高价
	 */
	public function refresh($gid) {
		$pdb = M('paimai');
		$good = $pdb->field('gid,zuigaojia, baomingrenshu, chujiacishu,status')->find($gid);
		$this->ajaxReturn($good, 'JSON');
	}
	
	public function prizerecord($gid, $uid, $pageNum = 1) {
		$db = M('MemberPaimai');
		$map['flag'] = array('neq', 0);
		$map['gid'] = $gid;
		$list = $db->where($map)->order('id desc')->page($pageNum, 20)->select();
		if($pageNum > 1) {
			if(empty($list)) {
				$this->ajaxReturn(null);
			} else {
				$this->ajaxReturn($list, 'JSON');
			}
		} else {
			$this->assign('gid', $gid);
			$this->assign('uid', $uid);
			$this->assign('list', $list);
			$this->assign('title', '出价记录');
			layout('sublayout');
			$this->display();
		}
	}
	
	public function article($id) {
		layout(false);
		
		$db = M('articles');
		$data = $db->find($id);
		//echo dump($data);
		$content = htmlspecialchars_decode(html_entity_decode($data['articlecontent']));
		$this->assign('content', $content);
		
		$this->assign('title', $data['name']);
		
		$this->display();
	}
	
	public function record($gid, $pageNo = 1){
		$db = M('MemberPaimai');
		$pageSize = 10;
		$map = array(
			'gid'	=> $gid,
			'flag'	=> array('gt',  0),
		);
		$list = $db->where($map)->join('yyg_member on yyg_member.uid = yyg_member_paimai.uid')
			->field(array('yyg_member_paimai.money','yyg_member_paimai.time','IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
			->order('yyg_member_paimai.time desc')->page($pageNo, $pageSize)->select();
		
		
		$num = 0;
		$total = 0;
		if($list) {
			$this->assign('list', $list);
			$num = count($list);
			
			$total = $db->join('yyg_member on yyg_member.uid = yyg_member_paimai.uid')->where($map)->count();
			
			$pageCount = ceil($total / $pageSize);
			$this->assign('pageSize', $pageSize);
			$this->assign('pageNo', $pageNo);
			$this->assign('pageCount', $pageCount);
			$this->assign('minPageNo', floor(($pageNo-1)/10.0) * 10 + 1);
			$this->assign('maxPageNo', min(ceil(($pageNo)/10.0) * 10 + 1, $pageCount));
		}
		
		$this->assign('gid', $gid);
		$this->assign('num', $num);
		$this->assign('total', $total);
		layout(false);
		$this->display();
	}
}