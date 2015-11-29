<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		run_task();
    		$this->assign('title', '一元购');
		$this->assign('pid', 'home');
		$sdb = M('slide');
		$slides = $sdb->select();
		$this->assign('slides', $slides);
		$this->display();
    }
	
	public function pageAll($pageSize, $pageNum) {
		// 分页
		$db = M('miaosha');
		$filter['jishijiexiao'] = 0;
		$filter['type'] = 1;
		
		$cid = intval(I('get.cid'));
		if($cid > 0) {
			$filter['cid'] = $cid;
		}
		
		$type = I("get.type");
		$order = null;
		switch($type) {
			case 2:
				$order = "time desc";
				break;
			case 3:
				$order = "shengyurenshu desc";
				break;
			case 4: // 总需人数
				$order = "zongrenshu desc";
				break;
			default: // 人气
				$order = "canyurenshu desc";
				break;
		}
		
		$list = $db->where($filter)->order($order)->page($pageNum, $pageSize)->field('gid,title,thumb,money,danjia,status, qishu, canyurenshu, zongrenshu,type')->select();
		$this->ajaxReturn($list, "JSON");
	}
	
	public function _empty($gid, $qishu) {
		$this->view($gid, $qishu);
	}
	
	public function view($gid, $qishu = null) {
		layout('sublayout');
		$this->assign('title', '商品详情');
		
		$data = $this->getGood($gid, $qishu);
		$data['percentage'] = min(100, intval($data['canyurenshu'])*100/ intval($data['zongrenshu']));
		$this->assign('data', $data);
		
		$data['status'] = intval($data['status']);
		$data['qishu'] = intval($data['qishu']);
		$data['maxqishu'] = intval($data['maxqishu']);
		$qishuArray = array();
		if($data['status'] == 2) {
			// 下一期
			if($data['qishu'] < $data['maxqishu']) {
				array_push($qishuArray, array(
					'qishu'		=> $data['qishu'] + 1,
					'gid'		=> $data['gid'],
				));
			}
			
			// 当期
			array_push($qishuArray, array(
				'qishu'		=> $data['qishu'],
				'gid'		=> $data['gid'],
				'active'		=> true,
			));
			
			// 上一期
			if($data['qishu'] > 1) {
				array_push($qishuArray, array(
					'qishu'		=> $data['qishu'] - 1,
					'gid'		=> $data['gid'],
				));
			}
		} else {
			
			$imgdb = M('GoodsImages');
			$imgmap['gid'] = $gid;
			$imgmap['type'] = $data['type'];
			$images = $imgdb->where($imgmap)->select();
			if(empty($images)) {
				$image['image_url'] = $data['thumb'];
				array_push($images, $image);
			}
			$this->assign('images', $images);
		
			// 当期
			array_push($qishuArray, array(
				'qishu'		=> $data['qishu'],
				'gid'		=> $data['gid'],
				'active'		=> true,
			));
			
			// 上一期
			if($data['qishu'] > 1) {
				array_push($qishuArray, array(
					'qishu'		=> $data['qishu'] - 1,
					'gid'		=> $data['gid'],
				));
			}
			
			// 上上期
			if($data['qishu'] > 2) {
				array_push($qishuArray, array(
					'qishu'		=> $data['qishu'] - 2,
					'gid'		=> $data['gid'],
				));
			}
		}
		$this->assign('periods', $qishuArray);
		
		if($data['status'] == 2) {
			$this->display('end');
		} else {
			$this->display('view');
		}
	}
	
	private function getGood($gid, $qishu = null) {
		if(!$qishu) {
			$db = M('miaosha');
			return $db->field('gid,title,subtitle,thumb,money,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,end_time')->find($gid);
		} else {
			// 历史
			$db = M('MiaoshaHistory');
			$map['gid'] = $gid;
			$map['qishu'] = $qishu;
			$data = $db->field('gid,title,subtitle,thumb,money,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,prizeuid,prizecode,end_time')->where($map)->find();
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
				$user = $udb->field('uid, username, email, mobile, img, qianming')->find($data['prizeuid']);
				$data['prizer'] = $user;
					
				if(empty($user['username'])) {
					$user['username'] = substr($user['mobile'], 0, 3).'****'.substr($user['mobile'], 7, 4);
				}
				
				// 获取用户当期购买数量
				$mhdb = M('MemberMiaosha');
				$mhmap['uid'] = $data['prizeuid'];
				$mhmap['gid'] = $data['gid'];
				$mhmap['qishu'] = $data['qishu'];
				$count = $mhdb->where($mhmap)->sum('count');
				$data['prizer']['count'] = $count;
			}
			
			return $data;
		}
	}
	
	public function detail($gid) {
		layout(false);
		$this->assign('title', '商品图文详情');
		
		$db = M('miaosha');
		$data = $db->field('gid,content')->find($gid);
		$data['content'] = htmlspecialchars_decode(html_entity_decode($data['content']));
		$this->assign('data', $data);
		
		$this->display();
	}
	
	public function category() {
		$db = M('category');
		$list = $db->field('cid, name')->select();
		
		$db = M('miaosha');
		$filter["jishijiexiao"] = 0;
		$filter["type"] = 1;
		$all['name'] = '全部';
		$all['cid'] = 0;
		array_unshift($list, $all);
		
		$this->ajaxReturn($list, "JSON");
	}
}