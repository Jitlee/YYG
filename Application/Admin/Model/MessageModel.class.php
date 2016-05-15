<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * 粗卡云:
  
 * 联系方式:
 * ============================================================================
 * 文章分类服务类
 */
class MessageModel extends BaseModel {
	  
	 public function getSendmsg(){
	 	$m = M('message');	
	 	$sql = "select * from yyg_message where status=0 and msgtime >date_add(now(),interval -2 day) limit 0,1";
	 	$catList = $m->query($sql);	 	
	 	return $catList;
	 }
};
?>
	