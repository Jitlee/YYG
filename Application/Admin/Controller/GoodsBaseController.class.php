<?php
namespace Admin\Controller;
use Think\Controller;
abstract class GoodsBaseController extends CommonController {
	protected $ROOT_PATH = '/Uploads/Goods/';
	
	protected function saveImages($gid, $type) {
		$urls = $_POST['imageUrls'];
		$keys = $_POST['imageKeys'];
		$imgdb = M('GoodsImages');
		$map['gid'] = $gid;
		$imgdb->where('gid=' . $gid . 'and type=' . $type)->delete();
		
		for ($i = 0; $i < count($urls); ++$i) {
			$imgdata['gid'] = $gid;
			$imgdata['image_url'] = $urls[$i];
			$imgdata['image_key'] = $keys[$i];
			$imgdata['type'] = $type;
			$imgdb->add($imgdata);
		}
	}
}