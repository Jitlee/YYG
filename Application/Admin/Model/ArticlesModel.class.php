<?php
 namespace Admin\Model;
/**
 * ============================================================================
 * 粗卡云:
  
 * 联系方式:
 * ============================================================================
 * 文章服务类
 */
class ArticlesModel extends BaseModel {
    /**
	  * 新增
	  */
	 public function insert(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["catId"] = (int)I("catId");
		$data["articleTitle"] = I("articleTitle");
		$data["isShow"] = (int)I("isShow",0);
		$data["articleContent"] = I("articleContent");
		$data["articleKey"] = I("articleKey");
		$data["staffId"] = (int)session('RTC_STAFF.staffId');
		$data["createTime"] = date('Y-m-d H:i:s');
	    if($this->checkEmpty($data,true)){
			$m = M('articles');
			$rs = $m->add($data);
		    if(false !== $rs){
				$rd['status']= 1;
			}
		}
		return $rd;
	 } 
     /**
	  * 修改
	  */
	 public function edit(){
	 	$rd = array('status'=>-1);
	 	$id = (int)I("id",0);
		$data = array();
		$data["catId"] = (int)I("catId");
		$data["articleTitle"] = I("articleTitle");
		$data["isShow"] = (int)I("isShow",0);
		$data["articleContent"] = I("articleContent");
		$data["articleKey"] = I("articleKey");
		$uid=session('_uid');
		$data["staffId"] = $uid;
	    if($this->checkEmpty($data,true)){	
			$m = M('articles');
		    $rs = $m->where("articleId=".(int)I('id',0))->save($data);
			if(false !== $rs){
				$rd['status']= 1;
				
			}
		}
		return $rd;
	 } 
	 /**
	  * 获取指定对象
	  */
     public function get($id){
	 	$m = M('articles');
		return $m->where("articleId=".$id)->find();
	 }
	 /**
	  * 分页列表
	  */
     public function queryByPage($pageSize = 10, $pageNum = 1){
        $m = M('articles');
	 	$sql = "select a.articleTitle,a.articleId,a.isShow,a.createTime,c.catName
	 	    from __PREFIX__articles a,__PREFIX__article_cats c,__PREFIX__admin s 
	 	    where a.catId=c.catId  ";
	 	if(I('articleTitle')!='')$sql.=" and articleTitle like '%".I('articleTitle')."%'";
	 	$sql.=' order by articleId desc';
	 	
	 	$Model = M();
		return $newitem=$Model->pageQuery($sql,$pageNum,$pageSize);		 
	 }
	 /**
	  * 获取列表
	  */
	  public function queryByList(){
	     $m = M('articles');
	     $sql = "select * from __PREFIX__articles where isShow =1 order by articleId desc";
		 $rs = $m->query($sql);
		 return $rs;
	  }
	  
	 /**
	  * 删除
	  */
	 public function del(){
	 	$rd = array('status'=>-1);
	    $m = M('articles');
	    $rs = $m->delete((int)I('id'));
		if(false !== $rs){
		   $rd['status']= 1;
		}
		return $rd;
	 }
	 /**
	  * 显示分类是否显示/隐藏
	  */
	 public function editiIsShow(){
	 	$rd = array('status'=>-1);
	 	if(I('id',0)==0)return $rd;
	 	$m = M('articles');
	 	$m->isShow = ((int)I('isShow')==1)?1:0;
	 	$rs = $m->where("articleId=".(int)I('id',0))->save();
	    if(false !== $rs){
			$rd['status']= 1;
		}
	 	return $rd;
	 }
};
?>