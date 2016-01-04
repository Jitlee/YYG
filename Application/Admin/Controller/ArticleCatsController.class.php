<?php
namespace Admin\Controller;
/**
 * ============================================================================
 * 粗卡云:
  
 * 联系方式:
 * ============================================================================
 * 文章分类控制器
 */
class ArticleCatsController extends CommonController{
	 	
	 protected function _initialize() {
	 	$this->assign('pid', 'marticles');
		$this->assign('mid', 'cat'); 
	 }
	 
	 
	/**
	 * 跳到新增/编辑页面
	 */
	public function toEdit($id=0,$parentId=0){
		 
	    $m = D('Admin/ArticleCats');
    	$object = array();
    	if($id>0){
    		//$this->checkPrivelege('wzfl_02');
    		$object = $m->get($id);
    	}else{
    		//$this->checkPrivelege('wzfl_01');
    		$object = $m->getModel();
    		$object['parentId'] = $parentId;
    	}
    	$this->assign('object',$object);
		$this->view->display('/articlecats/edit');
	}
	/**
	 * 新增/修改操作
	 */
	public function edit(){
		 
		$m = D('Admin/ArticleCats');
    	$rs = array();
    	if(I('id',0)>0){
    		$rs = $m->edit();
    	}else{    		
    		$rs = $m->insert();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 修改名称
	 */
	public function editName(){
		 
		$m = D('Admin/ArticleCats');
    	$rs = array('status'=>-1);
    	if(I('id',0)>0){
    		 
    		$rs = $m->editName();
    	}
    	$this->ajaxReturn($rs);
	}
	/**
	 * 删除操作
	 */
	public function del(){
		 
	 
		$m = D('Admin/ArticleCats');
    	$rs = $m->del();
    	$this->ajaxReturn($rs);
	}
	/**
	 * 分页查询
	 */
	public function index(){
		 
		//$this->checkPrivelege('wzfl_00');
		$m = D('Admin/ArticleCats');
      	$list = $m->queryByList(I('parentId',1));
    	$this->assign('catItems',$list);
		//echo dump($list);
		
        $this->display("/articlecats/list");
	}
	/**
	 * 列表查询
	 */
    public function queryByList(){
		$m = D('Admin/ArticleCats');
		$list = $m->queryByList(I('id',0));
		$rs = array();
		$rs['status'] = 1;
		$rs['list'] = $list;
		$this->ajaxReturn($rs);
	}
    /**
	 * 显示分类是否显示/隐藏
	 */
	 public function editiIsShow(){
	 	 
	 	$this->checkAjaxPrivelege('wzfl_02');
	 	$m = D('Admin/ArticleCats');
		$rs = $m->editiIsShow();
		$this->ajaxReturn($rs);
	 }

};
?>