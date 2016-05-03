<?php
namespace Admin\Controller;
class MiaoshaController extends GoodsBaseController {
	protected $_config = array(
		'type'			=> 1,
		'listTitle'		=> '秒杀商品列表',
		'addTitle'		=> '添加秒杀商品',
		'editTitle'		=> '编辑秒杀商品',
		'listMid'		=> 'mslst',
		'addMid'			=> 'addms',
	);
	
	public function index($pageSize = 10, $pageNum = 1) {
		$this->assign('type', $this->_config['type']);
		$map['type'] = $this->_config['type'];
		// 分页
		$db = D('miaosha');
		$count = $db->where($map)->count();
		if(!$pageSize) {
			$pageSize = 10;
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
		
		$list = $db->where($map)->order('time desc')->relation(true)->page($pageNum, $pageSize)->select();
		$this->assign('list',$list);// 模板变量赋值
		
		$this->assign('title', $this->_config['lstTitle']);
		$this->assign('addTitle', $this->_config['addTitle']);
		$this->assign('pid', 'gdmgr');
		$this->assign('mid', $this->_config['listMid']);
		$this->display('Miaosha/index');
	}
	
	public function add() {
		if(IS_POST) {
			$jishi = intval($_POST['jishijiexiao']);
			$money = floatval($_POST['money']);
			$danjia = floatval($_POST['danjia']);
			$_POST['zongrenshu'] = ceil($money / $danjia);
			$_POST['shengyurenshu'] = $_POST['zongrenshu'];
			$zongrenshu = (int)$_POST['zongrenshu'];
			
			$db = M('miaosha');
//			$db->startTrans();
			$data = $db->create();
			if($data) {
				$status = -1;
				$result = $db->add(); // 写入数据到数据库 
				if($result > 0) {
					$rst = $db->execute("call p_create_miaosha_code($result, 1, $zongrenshu)");
//					echo dump($rst);
					if($rst > 0) {
						$status = 1;
					}
				}
				
				if($status == 1) {
//					$db->commit();
					self::saveImages($result, $this->_config['type']);
//					echo '成功';
					$this->success('操作成功', U('index', '', ''));
				} else {
//					$db->rollback();
//					echo '失败';
					$this->ajaxReturn('数据错误');						
				}
 			} else {
// 				$db->rollback();
				$this->ajaxReturn('数据创建错误');
			}
		} else {
			$this->assign('type', $this->_config['type']);
			
			$cdb = M('category');
			$categories = $cdb->select();
			$this->assign('allCategories', $categories);
			$this->assign('action', U('add','',''));
			$this->assign('categoryAction', U('Category/brands', '', ''));
			$this->assign('uploader', U('upload', '', ''));
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', $this->_config['addMid']);
			$this->assign('title', $this->_config['addTitle']);
			$this->assign('status', 0);
			$this->display('Miaosha/add');
		}
	}
	
	public function edit($gid = null) {
		if(IS_POST) {
			$jishi = intval($_POST['jishijiexiao']);
			$money = floatval($_POST['money']);
			$danjia = floatval($_POST['danjia']);
			$_POST['zongrenshu'] = ceil($money / $danjia);
			$_POST['shengyurenshu'] = $_POST['zongrenshu'];
			
			$db = M('miaosha');
			$data = $db->create();
			if($data) {
				$result = $db->save(); // 写入数据到数据库 
				self::saveImages($_POST['gid'], $this->_config['type']);
				$this->success('操作成功', U('index', '', ''));
			} else {
				$this->ajaxReturn('数据创建错误');
			}
		} else {
			$this->assign('type', $this->_config['type']);
			
			$db = D('miaosha');
			$map['gid'] = $gid;
			$map['type'] = $this->_config['type'];
			$data = $db->relation(true)->find($gid);
			$data['content'] = htmlspecialchars_decode(html_entity_decode($data['content']));
			$this->assign('data', $data);
			
			$imgdb = M('GoodsImages');
			$imgmap['gid'] = $gid;
			$images = $imgdb->where($imgmap)->select();
			$this->assign('images', $images);
			
			$cdb = M('category');
			$categories = $cdb->select();
			$this->assign('allCategories', $categories);
			
			$bdb = D('category');
			$bdata = $bdb->relation(true)->find($data['cid']);
			$this->assign('allBrands', $bdata['brands']);
			
			$this->assign('action', U('edit','',''));
			$this->assign('categoryAction', U('Category/brands', '', ''));
			
			$this->assign('uploader', U('upload', '', ''));
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', $this->_config['addMid']);
			$this->assign('title', $this->_config['editTitle']);
			$this->assign('status', $data['status']);
			
			$this->display('Miaosha/add');
		}
	}
	
	public function remove($gid = 0) {
		$db = M('Miaosha');
		$ret = $db->delete($gid);
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
	
	public function history($gid) {
		$db = D('Miaosha');
		$goods = $db->relation(true)->find($gid);
		$this->assign('goods', $goods);
		
		$mdb = M('MiaoshaHistory');
		$mmap['$gid'] = $gid;
		$list = $mdb->where($mmap)->order('qishu desc')->select();
		$this->assign('list', $list);
		$this->assign("pid", "gdmgr");
		$this->assign("title", "往期");
		$this->display();
	}
}