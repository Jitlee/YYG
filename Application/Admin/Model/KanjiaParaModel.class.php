<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * 粗卡云:
  
 * 联系方式:
 * ============================================================================
 * 广告服务类
 */
class KanjiaParaModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	//$id = (int)I("id",0);
		$data = array();
		$data["kjcode"] = I("kjcode");
		$data["kjname"] = I("kjname");
		$data["money"] = (int)I("money");
		$data["prizenum"] = (int)I("prizenum");
		$data["shengyuprizenum"] = (int)I("prizenum");
		$data["prizetype"] = I("prizetype");
		
		$data["reg_title"] = I("reg_title");
		$data["reg_description"] = I("reg_description");
		$data["reg_imgurltype"] = I("reg_imgurltype");
		$data["reg_imgurl"] = I("reg_imgurl");
		$data["news_title"] = I("news_title");
		$data["news_description"] = I("news_description");
		$data["news_imgurltype"] = I("news_imgurltype");
		$data["news_imgurl"] = I("news_imgurl");
		//分享配置
		$data["share_title"] = I("share_title");
		$data["share_description"] = I("share_description");		
		$data["share_imgurl"] = I("share_imgurl");
		
		$data["havekants"] = I("havekants");
		$data["overts"] = I("overts");
		$data["create_time"] =date('Y-m-d H:i:s');
		if($this->checkEmpty($data,true)){
			$data["prizeid"] = I("prizeid");
			$rd["msg"]="保存失败。";
		    $m = M('kanjia_para');
			$rs = $m->add($data);
		    if(false !== $rs){
				$rd['status']= 1;
			}
			else
			{
				$rd["msg"]=$m->getDbError();
			}
		}
		

		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	 
		$data["kjcode"] = I("kjcode");
		$data["kjname"] = I("kjname");
		
		$data["money"] = I("money");
		$data["prizenum"] = I("prizenum");
		$data["shengyuprizenum"] = I("prizenum");
		$data["prizetype"] = I("prizetype");
		
		$data["reg_title"] = I("reg_title");
		$data["reg_description"] = I("reg_description");
		$data["reg_imgurltype"] = I("reg_imgurltype");
		$data["reg_imgurl"] = I("reg_imgurl");
		
		$data["news_title"] = I("news_title");
		$data["news_description"] = I("news_description");
		$data["news_imgurltype"] = I("news_imgurltype");
		$data["news_imgurl"] = I("news_imgurl");
		
		$data["share_title"] = I("share_title");
		$data["share_description"] = I("share_description");		
		$data["share_imgurl"] = I("share_imgurl");
		
		$data["havekants"] = I("havekants");
		$data["overts"] = I("overts");
		
		
	    if($this->checkEmpty($data,true)){	
	    	$data["prizeid"] = I("prizeid");
			
			$m = M('kanjia_para');
		    $rs = $m->where("kjid=".(int)I("kjid"))->save($data);
			if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
	
	public function updatePrizeid($zj_id){
	 	$rd = array('status'=>-1);
		$data = array();
		$data["havesendprize"] = 1;
		$data["sendprize"] =time();
					
		$m = M('kanzhong');
	    $rs = $m->where("zj_id=".(int)$zj_id)->save($data);
		if(false !== $rs){
			$rd['status']= 1;
		}
		
		return $rd;
	}

	 /**
	  * 获取指定对象
	  */
     public function get($kjid){
	 	$m = M('kanjia_para');
		return $m->where("kjid=".$kjid)->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage(){
     	 
        $m = M('kanjia_para');
	 	$sql = "select a.*
	 	        from cky_kanjia_para a where 1=1   order by kjid desc";

		return $m->pageQuery($sql);
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	    $m = M('kanjia_para');
	     $sql = "select * from __PREFIX__kanjia_para order by kjid desc";
		 return $m->find($sql);
	  }
	  
	  
	  
	 /**
	  * 删除
	  */
	 public function del(){
	    $rd = array('status'=>-1);
	    $m = M('kanjia_para');
	    $rs = $m->delete((int)I('kjid'));
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
	 
	 public function GetKjParaByKjid($kjid)
	 {
	 		$sql="
select 
	m.mobile,kp.prizetype,kp.prizeid,m.uid,kp.kjcode,kp.prizenum
from yyg_kanjia k 
inner join yyg_member m on m.uid=k.uid
inner join yyg_wx_user wu on wu.openid=m.openID
inner join yyg_kanjia_para kp on kp.kjcode=k.type
where kj_id=$kjid";
		$m = M('kanjia');
		$rsarr= $m->query($sql);
		return $rsarr[0];
	 }
	 
	 /*****砍价明细项删除****/
	  public function kanjiaItemDel(){
	    $rd = array('status'=>-1);
	    //找到 $type
	    $kj_id=(int)I('kjid');
	    $obj=$this->GetKjParaByKjid($kj_id);
	    $type=$obj['kjcode'];
		$prizenum=(int)$obj["prizenum"];
		
	    $m = M('kanjia');
	    $rs = $m->delete($kj_id);
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
	 
};
?>