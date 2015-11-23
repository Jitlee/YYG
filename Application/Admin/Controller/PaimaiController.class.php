<?php
namespace Admin\Controller;
class PaimaiController extends GoodsBaseController {
	private $goodsType = 3;
	public function index($pageSize = 25, $pageNum = 1) {
		$this->assign('type', $this->goodsType);
			
		// 分页
		$db = D('paimai');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
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
		
		$list = $db->relation(true)->page($pageNum, $pageSize)->select();
		$this->assign('list',$list);// 模板变量赋值
		
		$this->assign('title', '拍卖商品列表');
		$this->assign('pid', 'gdmgr');
		$this->assign('mid', 'pmlst');
		$this->display();
	}
	
	public function add() {
		if(IS_POST) {
			$db = M('paimai');
			$data = $db->create();
			if($data) {
				$result = $db->add(); // 写入数据到数据库 
				if($result != false) {
					self::saveImages($result, 3);
					$this->success('操作成功', U('index', '', ''));
				} else {
					$this->ajaxReturn('数据错误');
				}
			} else {
				$this->ajaxReturn('数据创建错误');
			}
		} else {
			$cdb = M('category');
			$categories = $cdb->select();
			$this->assign('allCategories', $categories);
			$this->assign('action', U('add','',''));
			$this->assign('categoryAction', U('Category/brands', '', ''));
			$this->assign('uploader', U('upload', '', ''));
			$this->assign('pid', 'gdmgr');
			$this->assign('mid', 'addpm');
			$this->assign('title', '添加拍卖商品');
			$this->display();
		}
	}
	
	public function edit($gid = null) {
		if(IS_POST) {
			$db = M('paimai');
			if($db->create()) {
				$result = $db->save(); // 写入数据到数据库 
				self::saveImages($_POST['gid'], 3);
				$this->success('操作成功', U('index', '', ''));
			} else {
				$this->ajaxReturn('数据创建错误');
			}
		} else {
			$this->assign('type', $this->goodsType);
			
			$db = D('paimai');
			$map['gid'] = $gid;
			$data = $db->relation(true)->find($gid);
			$data['content'] = htmlspecialchars_decode(html_entity_decode($data['content']));
			$this->assign('data', $data);
			
			$imgdb = M('GoodsImages');
			$imgmap['gid'] = $gid;
			$imgmap['type'] = 3;
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
			$this->assign('mid', 'addpm');
			$this->assign('title', '编辑拍卖商品');
			
			$this->display('add');
		}
	}
}