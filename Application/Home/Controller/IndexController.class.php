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
		
		// 商品分类
		$cdb = M('Category');
		$categories = $cdb->page(1,8)->select();
		$this->assign('allCategories', $categories);
		
		$this->display();
    }
	
	public function all($category = 0, $categoryName = '商品分类'){
		run_task();
    		$this->assign('title', '热门秒杀');
		$this->assign('pid', 'jiexiao');
		
		$this->assign('category', $category);
		$this->assign('categoryName', $categoryName);
		
		$this->assign('tabId', 1);
		
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
		
		$list = $db->where($filter)->order($order)->page($pageNum, $pageSize)->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,type')->select();
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
			return $db->field('gid,title,subtitle,thumb,money,xiangou,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,end_time')->find($gid);
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
	
	public function record($qishu, $gid, $pageNum = 1) {
		$pageNum = intval($pageNum);
		$db = M('MemberMiaosha');
		$map['gid'] = $gid;
		$map['qishu'] = $qishu;
		$list = $db->join('yyg_member on yyg_member.uid = yyg_member_miaosha.uid')
			->field(array('yyg_member_miaosha.id'=>'mid','yyg_member_miaosha.uid', 'yyg_member_miaosha.count','yyg_member_miaosha.time','IFNULL(NULLIF(yyg_member.username, \'\'), INSERT(yyg_member.mobile,4,4,\'****\'))' => 'username'))
			->where($map)->order('id desc')->page($pageNum, 20)->select();
		if($pageNum > 1) {
			if(empty($list)) {
				$this->ajaxReturn(0, 'JSON');
			} else {
				$this->ajaxReturn($list, 'JSON');
			}
		} else {
			$this->assign('gid', $gid);
			$this->assign('qishu', $qishu);
			$this->assign('list', $list);
			$this->assign('title', '参与记录');
			layout('sublayout');
			$this->display();
		}
	}
	
	public function prizerecord($qishu, $gid, $uid, $username, $pageNum = 1) {
		$db = M('MiaoshaCode');
		$map['qishu'] = $qishu;
		$map['gid'] = $gid;
		$map['uid'] = $uid;
		$list = $db->field(array('pcode + 10000001' => 'pcode'))->where($map)->order('id desc')->page($pageNum, 200)->select();
		if($pageNum > 1) {
			if(empty($list)) {
				$this->ajaxReturn(null);
			} else {
				$this->ajaxReturn($list, 'JSON');
			}
		} else {
			$count = $db->where($map)->count();
			$this->assign('count', $count);
			
			$this->assign('gid', $gid);
			$this->assign('uid', $uid);
			$this->assign('qishu', $qishu);
			$this->assign('username', $username);
			$this->assign('list', $list);
			$this->assign('title', '云购码列表');
			layout('sublayout');
			$this->display();
		}
	}
	
	public function coderecord($qishu, $gid, $mid, $uid, $username, $pageNum = 1) {
		$db = M('MiaoshaCode');
		$map['qishu'] = $qishu;
		$map['gid'] = $gid;
		$map['uid'] = $uid;
		$map['mid'] = $mid;
		$list = $db->field(array('pcode + 10000001' => 'pcode'))->where($map)->order('id desc')->page($pageNum, 200)->select();
		if($pageNum > 1) {
			if(empty($list)) {
				$this->ajaxReturn(null);
			} else {
				$this->ajaxReturn($list, 'JSON');
			}
		} else {
			$count = $db->where($map)->count();
			$this->assign('count', $count);
			
			$this->assign('gid', $gid);
			$this->assign('uid', $uid);
			$this->assign('qishu', $qishu);
			$this->assign('mid', $mid);
			$this->assign('username', $username);
			$this->assign('list', $list);
			$this->assign('title', '云购码列表');
			layout('sublayout');
			$this->display();
		}
	}
}