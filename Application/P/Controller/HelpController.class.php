<?php
namespace P\Controller;
use Think\Controller;
class HelpController extends Controller {
	
	public function _empty($id) {
		$this->index($id);
	}
	
	public function index($id=0){		
    		$this->assign('title', '一元购');
		
		$db = M('article');
		$data = $db->find($id);
		$data['content'] = htmlspecialchars_decode(html_entity_decode($data['content']));
		$this->assign('data', $data);
		$this->display();
    }
}
	