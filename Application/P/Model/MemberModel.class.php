<?php
 namespace P\Model;
/**
 * ============================================================================
 * 粗卡云:
  
 * 联系方式:
 * ============================================================================
 * 文章服务类
 */
class MemberModel extends BaseModel {
 
 
	 /**
	  * 获取指定对象
	  */
     public function getByMobile($mobile){
		$db = M('member');
		$data['mobile'] = $mobile;
		return $db->where($data)->find();
	 }
 
 	public function getByYaoqing($yaoqing){
		$db = M('member');
		$data['yaoqing'] = $yaoqing;
		return $db->where($data)->find();
	 }

};
?>