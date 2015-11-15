<?php
namespace Admin\Controller;
use Think\Controller;
abstract class GoodsBaseController extends CommonController {
	protected $ROOT_PATH = '/Uploads/Goods/';
	
	protected function saveImages($gid) {
		$urls = $_POST['imageUrls'];
		$keys = $_POST['imageKeys'];
		$imgdb = M('GoodsImages');
		$imgdata['gid'] = $gid;
		$imgdb->where($imgdata['gid'])->delete();
		
		for ($i = 0; $i < count($urls); ++$i) {
			$imgdb = M('goodsImages');
			$imgdata['gid'] = $gid;
			$imgdata['image_url'] = $urls[$i];
			$imgdata['image_key'] = $keys[$i];
			$imgdb->add($imgdata);
		}
	}
}