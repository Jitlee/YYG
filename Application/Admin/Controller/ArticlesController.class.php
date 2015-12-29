<?php
namespace Admin\Controller;
/**
 * ============================================================================
 * 粗卡云:
  
 * 联系方式:
 * ============================================================================
 * 文章控制器
 */
class ArticlesController extends CommonController{
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit(){
		 
	    $m = D('Admin/Articles');
    	$object = array();
    	if(I('id',0)>0){
    		$this->checkPrivelege('wzlb_02');
    		$object = $m->get();
    	}else{
    		$this->checkPrivelege('wzlb_01');
    		$object = $m->getModel();
    	}
    	$m = D('Admin/ArticleCats');
    	$this->assign('catList',$m->getCatLists());
    	$this->assign('object',$object);
		$this->view->display('/articles/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		 
		$m = D('Admin/Articles');
    	$rs = array();
    	if(I('id',0)>0){
    		$this->checkAjaxPrivelege('wzlb_02');
    		$rs = $m->edit();
    	}else{
    		$this->checkAjaxPrivelege('wzlb_01');
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
	public function index(){
		$m = D('Admin/Articles');
    	$page = $m->queryByPage();
    	$pager = new \Think\Page($page['total'],$page['pageSize']);// 实例化分页类 传入总记录数和每页显示的记录数
    	$page['pager'] = $pager->show();
    	
		$this->assign('pid', 'marticles');
		$this->assign('mid', 'articles');
    	
    	$this->assign('Page',$page);
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