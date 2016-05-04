<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
//		run_task();
    	$this->assign('title', '壹圆购物');
		$this->assign('pid', 'home');
		//自动登录
		//home_is_login();
		
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
//		run_task();
    	$this->assign('title', '热门秒杀');
		$this->assign('pid', 'jiexiao');
		
		$this->assign('category', $category);
		$this->assign('categoryName', $categoryName);
		
		$this->assign('tabId', 0);
		
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
		$order = 'gid desc';
		switch($type) {
			case 2:
				$order = "time desc,".$order;
				break;
			case 3:
				$order = "shengyurenshu asc,".$order;
				break;
			case 4: // 总需人数
				$order = "zongrenshu desc,".$order;
				break;
			default: // 人气
				$order = "canyurenshu desc,".$order;
				break;
		}
		
		$list = $db
			->field('gid,title,thumb,money,danjia,xiangou,status, qishu, canyurenshu, zongrenshu,type')
			->where($filter)
			->order($order)
			->page($pageNum, $pageSize)
			->select();
			
//		echo $db->getLastSql();
		
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
		
		$db = M('miaosha');
		$current = $db->field('qishu, status')->find($gid);
		$this->assign('current', $current);
		
//		echo dump($data);
		
		$data['status'] = intval($data['status']);
		$data['qishu'] = intval($data['qishu']);
		$data['maxqishu'] = intval($data['maxqishu']);
		if($data['status'] == 2) {
			
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
		}
//		$this->assign('periods', $qishuArray);
		
		if($data['status'] == 2) {
			$this->display('end');
		} else {
			$this->display('view');
		}
	}
	
	private function getGood($gid, $qishu = null) {
		if(!$qishu) {
			$db = M('miaosha');
			$goods = $db->field('gid,title,subtitle,thumb,money, goumaicishu,xiangou,canyurenshu,zongrenshu,shengyurenshu,qishu,maxqishu,status,type,UNIX_TIMESTAMP(date_add(`time`,interval +jishijiexiao hour)) * 1000 end_time')->find($gid);
			
//			echo $db->getLastSql();
			if((int)$goods['status'] == 2) {
				return $this->getGood($gid, (int)$goods['qishu']);
			}
			return $goods;
		} else {
			// 历史
			$db = M('MiaoshaHistory');
			$map['gid'] = $gid;
			$map['qishu'] = $qishu;
			$data = $db
				->field('gid,title,qishu,thumb,m.money,danjia,status, canyurenshu, shengyurenshu, end_time, goumaicishu, prizeid, prizeuid, prizecode, prizecount,
					INSERT(u.username,ROUND(CHAR_LENGTH(u.username) / 2),ROUND(CHAR_LENGTH(u.username) / 4),\'****\') username, u.img userimg')
				->join("m left join __MEMBER__ u on u.uid = m.prizeuid")
			->where($map)->find();
			
			if(empty($data)) {
				return $this->getGood($gid, null);
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
			$this->assign('title', '购物码列表');
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
			$this->assign('title', '购物码列表');
			layout('sublayout');
			$this->display();
		}
	}
}