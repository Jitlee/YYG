<?php
namespace Admin\Controller;
class PaimaiController extends GoodsBaseController {
	
	protected function onadd($data) {
	}
	
	protected function onedit($data) {
	}
	
	public function index() {
		$this->assign('type', $this->goodsType);
			
		$db = D('paimai');
		$list = $db->relation(true)->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
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
					self::saveImages($result);
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
				$this->onedit($data);
				self::saveImages($_POST['gid']);
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
			$this->assign('mid', $this->_config['addmid']);
			$this->assign('title', $this->_config['edit']);
			
			$this->display('add');
		}
	}
}