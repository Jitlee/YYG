<?php
namespace Admin\Controller;
class MiaoshaController extends GoodsBaseController {
	
	protected function onadd($data) {
		$hdb = M('MiaoshaHistory');
		$db->add($data);
	}
	
	protected function onedit($data) {
	}
	
	public function index() {
		$this->assign('type', $this->goodsType);
			
		$db = D('miaosha');
		$list = $db->relation(true)->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
		$this->assign('title', '秒杀商品列表');
		$this->assign('pid', 'gdmgr');
		$this->assign('mid', 'mslst');
		$this->display();
	}
	
	public function add() {
		if(IS_POST) {
			$db = M('miaosha');
			$data = $db->create();
			if($data) {
				$result = $db->add(); // 写入数据到数据库 
				if($result != false) {
					$hdb = M('MiaoshaHistory');
					$db->add($data);
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
			$this->assign('mid', 'addms');
			$this->assign('title', '添加秒杀商品');
			$this->display();
		}
	}
	
	public function edit($gid = null) {
		if(IS_POST) {
			$db = M('miaosha');
			if($db->create()) {
				$result = $db->save(); // 写入数据到数据库 
				$hdb = M('MiaoshaHistory');
				$map['gid']=$data['gid'];
				$map['qishu']=$data['qishu'];
				$hdb->where($map)->save($data);
				self::saveImages($_POST['gid']);
				$this->success('操作成功', U('index', '', ''));
			} else {
				$this->ajaxReturn('数据创建错误');
			}
		} else {
			$this->assign('type', $this->goodsType);
			
			$db = D('miaosha');
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