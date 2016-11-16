<?php
namespace Home\Model;
use Think\Model;


class WxUserModel extends Model {
		 
	public function Insert($dataInfo)
	{  
		  $user = array(); 
		  $user["openid"]=  $dataInfo["openid"];
		  $user["nickname"]=  $dataInfo["nickname"];
		  $user["sex"]=  $dataInfo["sex"];
		  $user["city"]=  $dataInfo["city"];
		  $user["country"]=  $dataInfo["country"];
		  $user["province"]=  $dataInfo["province"];
		  $user["language"]=  $dataInfo["language"];
		  $user["headimgurl"]=  $dataInfo["headimgurl"];
		  $user["subscribe_time"]=  $dataInfo["subscribe_time"];
		  $user["remark"]=  $dataInfo["remark"];
		  $user["groupid"]=  $dataInfo["groupid"];
		  $user["tagid_list"]=  $dataInfo["tagid_list"];
		  $user["subscribe"]=  $dataInfo["subscribe"];
		  $user["is_share"]=  $dataInfo["is_share"];
 
			$db = M('wx_user');
			$rs = $db->add($user);
			 
 
		return $rs;
	}
	
	public function GetWxID($openid, $Auth)
	{
		$wx_id=M('wx_user')->where(array('openid'=>$openid))->getField('wx_id');
		if(empty($wx_id)){
            //获取来源者信息
            $add_info=$Auth->userInfo($openid);
            //保存关注者信息
            if(!M('wx_user')->where(array('openid'=>$openid))->Find()){
				$rs=$this->Insert($add_info);
	            if($rs===false){
                    return -1;
                }
                $wx_id=M('wx_user')->where(array('openid'=>$openid))->getField('wx_id');
            }
        }
		return $wx_id;
	}
		
		
}
	