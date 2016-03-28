<?php
namespace Admin\Controller;
/**
 * ============================================================================  
 * 联系方式:
 * ============================================================================
 * 文章控制器
 */
class ArticlesController extends CommonController{	
	 
	 protected function _initialize() {
	 	$this->assign('pid', 'marticles');
		$this->assign('mid', 'articles'); 
	 }
	 
	 /**
	 * 跳到新增/编辑页面
	 */
	public function toEdit($id=0){
		
	    $m = D('Admin/Articles');
    	$object = array();
    	if($id>0){
    		$object = $m->get($id);
    	}else{
    		$object = $m->getModel();
    	}
    	$m = D('Admin/ArticleCats');
    	$this->assign('catList',$m->getCatTopLists());
		$object["articlecontent"] = htmlspecialchars_decode(html_entity_decode($object["articlecontent"]));
    	$this->assign('object',$object);
		//echo dump($object);
		$this->view->display('/articles/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		 
		$m = D('Admin/Articles');
    	$rs = array();
    	if(I('id',0)>0){
    		$rs = $m->edit();
    	}else{
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		 
		//$this->checkAjaxPrivelege('wzlb_03');
		$m = D('Admin/Articles');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
   /**
	 * 查看
	 */
	public function toView(){
		 
		//$this->checkPrivelege('wzlb_00');
		$m = D('Admin/Articles');
		if(I('id')>0){
			$object = $m->get();
			$this->assign('object',$object);
		}
		$this->view->display('/articles/view');
	}
	/**
	 * 分页查询
	 */
	public function index($pageNum = 1,$pageSize = 10){
		$m = D('Admin/Articles');
    	$page = $m->queryByPage($pageSize,$pageNum);
	  	$pager = new \Think\Page($page['total'],$page['pageSize']);// 实例化分页类 传入总记录数和每页显示的记录数
	  	$page['pager'] = $pager->show();
    	
		$this->assign('pid', 'marticles');
		$this->assign('mid', 'articles'); 
    	 
		//echo dump($page);
		$this->assign('page', $page);
		 
		$this->SetPage($pageSize,$pageNum,$page["total"]);
		
    	$this->assign('articleTitle',I('articleTitle'));
        $this->display("/articles/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
    	 
		//$m = D('Admin/Articles');
		$list = $m->queryByList();
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
    /**
	 * 显示商品是否显示/隐藏
	 */
	 public function editiIsShow(){
	 	 
	 	//$this->checkAjaxPrivelege('wzlb_02');
	 	$m = D('Admin/Articles');
		$rs = $m->editiIsShow();
		$this->ajaxReturn($rs);
	 }
};
?>