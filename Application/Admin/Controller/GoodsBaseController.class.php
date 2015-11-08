<?php
namespace Admin\Controller;
use Think\Controller;
abstract class GoodsBaseController extends Controller {
	const ROOT_PATH = '/Uploads/Goods/';
	
	protected $goodsType = 1;
	
	protected $titles = array(
		'list'		=> '商品列表',   // 列表标题
		'add'		=> '添加商品',   // 添加标题
		'edit'		=> '编辑商品',   // 编辑标题
	);
	
	protected abstract function onadd($data);
	protected abstract function onedit($data);
	
	
	public function index() {
		$db = D('goods');
		$map["type"] = $this->$goodsType;
		$list = $db->where($map["type"])->relation(true)->select();
		if($list != false) {
			$this->assign('list',$list);// 模板变量赋值
		}
		$this->assign('title', $this->titles["list"]);
		$this->display('Goods/index');
	}
	
	public function add() {
		if(IS_POST) {
			$db = M('Goods');
			$data = $db->create();
			if($data) {
				$result = $db->add(); // 写入数据到数据库 
				if($result != false) {
					$data['gid'] = $result;
					$this->onadd($data);
					self::saveImages($result);
					$this->success('操作成功', U('index', '', ''));
				} else {
					$this->ajaxReturn("数据错误");
				}
			} else {
				$this->ajaxReturn("数据创建错误");
			}
		} else {
			$cdb = M('category');
			$categories = $cdb->select();
			$this->assign('allCategories', $categories);
			
			$this->assign('action', U('add','',''));
			$this->assign('categoryAction', U('Category/brands', '', ''));
			$this->assign('uploader', U('upload', '', ''));
			$this->assign('title', $this->titles["add"]);
			$this->display('Goods/add');
		}
	}
	
	public function edit($gid = null) {
		if(IS_POST) {
			$db = M('Goods');
			if($db->create()) {
				$result = $db->save(); // 写入数据到数据库 
				$this->onedit($data);
				self::saveImages($_POST['gid']);
				$this->success('操作成功', U('index', '', ''));
			} else {
				$this->ajaxReturn("数据创建错误");
			}
		} else {
			$db = D('Goods');
			$map["gid"] = $gid;
			$data = $db->relation(true)->find($gid);
			$data["content"] = htmlspecialchars_decode(html_entity_decode($data['content']));
			$this->assign('data', $data);
			
			$imgdb = M('GoodsImages');
			$imgmap["gid"] = $gid;
			$images = $imgdb->where($imgmap)->select();
			$this->assign('images', $images);
			
			$cdb = M('category');
			$categories = $cdb->select();
			$this->assign('allCategories', $categories);
			
			$bdb = D('category');
			$bdata = $bdb->relation(true)->find($data["cid"]);
			$this->assign('allBrands', $bdata["brands"]);
			
			$this->assign('action', U('edit','',''));
			$this->assign('categoryAction', U('Category/brands', '', ''));
			
			$this->assign('uploader', U('upload', '', ''));
			$this->assign('title', $this->titles["edit"]);
			$this->display('Goods/add');
		}
	}
	
	private function saveImages($gid) {
		$urls = $_POST["imageUrls"];
		$keys = $_POST["imageKeys"];
		$imgdb = M('GoodsImages');
		$imgdata["gid"] = $gid;
		$imgdb->where($imgdata["gid"])->delete();
		
		for ($i = 0; $i < count($urls); ++$i) {
			$imgdb = M('goodsImages');
			$imgdata["gid"] = $gid;
			$imgdata['image_url'] = $urls[$i];
			$imgdata['image_key'] = $keys[$i];
			$imgdb->add($imgdata);
		}
	}
	
	public function upload() {
		if (!empty($_FILES)) {
			$config = array(
			    'maxSize'    =>    3145728,
			    'rootPath'   =>    '.' . self::ROOT_PATH,
			    'savePath'   =>    '',
			    'saveName'   =>    array('uniqid',''),
			    'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
			    'autoSub'    =>    true,
			    'subName'    =>    array('date','Ymd'),
			);
	
			$upload = new \Think\Upload($config);// 实例化上传类
			
		    // 上传文件 
		    $info   =   $upload->upload();
		    if($info != false) {// 上传成功
		    		$returnData["status"] = 0;
				$returnData["url"] = self::ROOT_PATH . $info['Filedata']['savepath'] . $info['Filedata']['savename'];
				$returnData["key"] = encode($info['Filedata']['savepath'] . $info['Filedata']['savename']);
		        $this->ajaxReturn($returnData, "JSON");
		    }else{// 上传错误提示错误信息
		    		$returnData["status"] = -1;
		    		$returnData["info"] = $upload->getError();
		        $this->ajaxReturn($returnData, "JSON");
		    }
		}
	}
	
	public function removefile($name) {
		del_dir_or_file('.' . self::ROOT_PATH . decode($name));
	}
}