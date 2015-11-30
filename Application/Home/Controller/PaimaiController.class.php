<?php
namespace Home\Controller;
use Think\Controller;
class PaimaiController extends Controller {
    public function index(){
		run_task();
    		$this->assign('title', '拍卖专区');
		$this->assign('pid', 'paimai');
		
		// 推荐
		$db = M('paimai');
		$tuijian = $db->where('tuijian=1 AND status < 2')->order('time desc')->find();
		if(!$tuijian) {
			$tuijian = $db->where('renqi=1 AND status < 2')->order('time desc')->find();
			if(!$tuijian) {
				$tuijian = $db->where(' status < 2')->order('time desc')->find();
			}
		}
		
		if($tuijian) {
			session('tuijian_first_id', $tuijian['gid']);
			$filter['gid'] = array("neq", $tuijian['gid']);
			$this->assign('tuijian', $tuijian);
		} else {
			session('tuijian_first_id', null);
		}
		
//		$list = $db->where($filter)
//			->order('tuijian desc, time desc')
//			->page($pageNum, $pageSize)
//			->field('gid,title,thumb,zuigaojia,status,end_time')
//			->select();
//		$this->assign('list', $list);
		
        $this->display();
    }
	
	public function page($pageSize = 8, $pageNum = 1) {
		$filter = null;
		if(session('?tuijian_first_id')) {
			$filter['gid'] = array("neq", session('tuijian_first_id'));
		}
		
		// 分页
		$db = M('paimai');
		$list = $db->where($filter)->order('tuijian desc, time desc')->page($pageNum, $pageSize)->field(array('gid','title','thumb','zuigaojia','status','prizeuid','UNIX_TIMESTAMP(end_time)'=>'end_time'))->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function _empty($gid) {
		$this->view($gid);
	}
	
	protected function view($gid) {
		if(is_login()) {
			$this->assign('title', '拍卖详情');
			$db = M('paimai');
			$data = $db->field('gid, title, subtitle,thumb, baoliujia,qipaijia,lijijia,jiafujia,zuigaojia,chujiacishu,baozhengjin,prizeuid, liji,status,end_time')->find($gid);
			
			$this->assign('data', $data);
			
			$data['baoliujia'] = intval($data['baoliujia']);
			$baoliu = $data['baoliujia'] > 0;
			$this->assign('baoliu', $baoliu);
			
			$data['status'] = intval($data['status']);
			
			if($data['status'] < 2) {
				$data['qipaijia'] = intval($data['qipaijia']);
				$data['zuigaojia'] = intval($data['zuigaojia']);
				$data['jiafujia'] = intval($data['jiafujia']);
				$zuidijia = $data['qipaijia'];
				if($data['zuigaojia'] >= $data['qipaijia']) {
					$zuidijia = $data['zuigaojia'] + $data['jiafujia'];
				}
				$this->assign('zuidijia', $zuidijia);
			
				$imgdb = M('GoodsImages');
				$imgmap['gid'] = $gid;
				$imgmap['type'] = 3;
				$images = $imgdb->where($imgmap)->select();
				if(empty($images)) {
					$image['image_url'] = $data['thumb'];
					array_push($images, $image);
				}
				$this->assign('images', $images);
				
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
				layout('sublayout');
				$this->display('view');
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
				
				layout('sublayout');
				$this->display('end'); // 已结束
			}
		} else {
			$this->redirect('Home/Person/login/'.encode('Paimai/index'));
		}
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
							$result['status'] = 0;
							$result['message'] = '出价成功';
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
		$good = $pdb->field('gid,zuigaojia, chujiacishu,status')->find($gid);
		$this->ajaxReturn($good, 'JSON');
	}
}