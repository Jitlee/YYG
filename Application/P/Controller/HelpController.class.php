<?php
namespace P\Controller;
use Think\Controller;
class HelpController extends Controller {
	
	public function _empty($id) {
		$this->index($id);
	}
	
	public function index($id=1){
    				
    	$this->assign('title', '一元购');		
		$m = D('P/ArticleCats');
		$cats=$m->queryByList(1);
 		
		foreach ($cats as $key =>$v){
			$v["html"]=$this->GetArticles($v["catid"]);
			if($newitem)
			{
				array_push($newitem,$v);
			}
			else
			{
				$newitem[]=$v;
			}
		}
		$this->assign('catList',$newitem);
		
		$db = M('articles');
		$data = $db->find($id);
		$data['content'] = htmlspecialchars_decode(html_entity_decode($data['articlecontent']));
		$this->assign('data', $data);
		$this->display();
    }
	
	function GetArticles($catid=0)
	{
		$m = D('P/Articles');
    	$cate=$m->queryByList($catid);
    	$html='';
    	foreach ($cate as $v) {
 			$html=$html."<li><a href='".$v["articleid"]."'>".$v["articletitle"]."</li>";
			 
		}
		return $html;
	}
}
	
	

