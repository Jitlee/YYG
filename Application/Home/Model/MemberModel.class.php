<?php
namespace Home\Model;
 

class MemberModel extends BaseModel{

	public function GetByOpenid($openid) {
		$db = M('member');
		$data['openid'] = $openid;
		$admin = $db->where($data)->find();
		return $admin;
	 }
	
}