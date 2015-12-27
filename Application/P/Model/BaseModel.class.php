<?php
 namespace P\Model;
/**
 * ============================================================================
 * 粗卡云:
  
 * 联系方式:
 * ============================================================================
 * 基础服务类
 */
use Think\Model;
class BaseModel extends Model {
    /**
     * 用来处理内容中为空的判断
     */
	public function checkEmpty($data,$isDie = false){
	    foreach ($data as $key=>$v){
			if(trim($v)==''){
				if($isDie)die("{'status':-1,'key':'$key'}");
				return false;
			}
		}
		return true;
	}
	
	/**
	 * 输入sql调试信息
	 */
	public function logSql($m){
		echo $m->getLastSql();
	}
    /**
	 * 获取一行记录
	 */
	public function queryRow($sql){
		$plist = $this->query($sql);
		return empty($plist)?array():$plist[0];
	}
};
?>