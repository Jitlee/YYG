<?php
namespace Admin\Controller;
use Think\Controller;
class JingcaiController extends CommonController {
	/*公告列表*/
	public function index(){
		$list=M('jc_notice')->where(array('status'=>1))->select();
		$this->list=$list;
		$this->assign('title', '竞彩公告');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'notice');
		$this->display();
	}
	/* 添加公告*/
	public function notice_add(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.');
		$rs=M('jc_notice')->add($data);
		if($rs!==false){
			$this->ajaxReturn(array('status'=>1,'info'=>'添加成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败，请稍后重试'));
		}
	}

	
	
	/*删除公告*/
	public function notice_del(){
		if(!IS_AJAX)$this->error('非法操作');
		$data=I('post.id');
		if(false!==M('jc_notice')->where(array('id'=>$data))->delete()){
			$this->ajaxReturn(array('status'=>1,'info'=>'删除成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'删除失败，请刷新后重试'));
		}

	}

	/*轮播图列表*/
	public function lunbotu(){
		$list=M('jc_ad')->where(array('status'=>1))->select();
		$this->list=$list;
		$this->assign('title', '轮播图列表');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'lunbotu');
		$this->display();
	}
	/*轮播图列表*/
	public function lunbotu_add(){
		if(IS_POST){
			$data=I('post.');
			$rs=M('jc_ad')->add($data);
			if($rs){
				$this->ajaxReturn(array('status'=>1,'url'=>U('lunbotu')));
			}
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败'));
		}
		$this->assign('title', '轮播图列表');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'lunbotu');
		$this->display();
	}
	/*删除轮播图*/
	public function ad_del($id = null) {
		$db = M('jc_ad');
		$ret = $db->delete($id);
		
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
	/*菜单列表*/
	public function menu(){
		$list=M('jc_menu')->where(array('status'=>1))->order('sort desc')->select();
		$this->list=$list;
		$this->assign('title', '菜单列表');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'menu');
		$this->display();
	}
	/*添加菜单*/
	public function menu_add(){
		if(IS_POST){
			$data=I('post.');
			$rs=M('jc_menu')->add($data);
			if($rs){
				$this->ajaxReturn(array('status'=>1,'url'=>U('menu')));
			}
			$this->ajaxReturn(array('status'=>0,'info'=>'添加失败'));
		}
		$this->assign('title', '添加菜单');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'menu');
		$this->display();
	}
	/*删除菜单*/
	public function menu_del($id = null) {
		$db = M('jc_menu');
		$ret = $db->delete($id);
		
		if($ret > -1) {
			$this->success('操作成功');
		} else {
			$this->error('数据错误');
		}
	}
	/*数据采集*/
	public function data(){
		$list=S('football');
		$time=S('football_update');
		// print_r($list);die;
		$this->update_time=$time;
		$this->list=$list;
		$this->assign('title', '数据采集');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'data');
		$this->display();
	}
	/*更新数据*/
	public function updatedata(){
		set_time_limit (0);//   //设置程序最大执行时间为无限  0为无限制
		ini_set('max_execution_time', '0');//设置最大执行时间  0为不限时
		header("Content-Type:text/html;charset=utf-8");
		//采集数据
		//受注足球url=http://i.sporttery.cn/open_v1_0/fb_match_list/get_fb_match_list/?username=11000000&password=test_passwd&format=jsonp&callback=initData
		$football_url="http://i.sporttery.cn/open_v1_0/fb_match_list/get_fb_match_list/?username=11000000&password=test_passwd&format=jsonp&callback=initData";
		$football_info=get($football_url);
		$football_info=preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $football_info);
		$football_info=str_replace('initData(', "", $football_info);
		$football_info=substr_replace($football_info, '', -1,1);
		$football_info=json_decode($football_info);
		$football_info=object_array($football_info);
		// print_r($football_info);die;
		$match=object_array($football_info['data']['list']);

		foreach ($match as $key => $value) {
			$match2[$key]=object_array($match[$key]);
		}
		foreach ($match2 as $k2 => $v2) {
			$array=$this->shengpingfu($v2['id']);
			$match2[$k2]['nh']=$array['h'];
			$match2[$k2]['na']=$array['a'];
			$match2[$k2]['nd']=$array['d'];
		}
		S('football',$match2);
		S('football_update',date('Y-m-d h:i:s'));
		$this->list=$match2;
		$this->assign('title', '数据采集');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'data');
		$this->redirect('data');
	}
	/*数据胜平负采集*/
	public function shengpingfu($mid=0){
		//$url=http://info.sporttery.cn/wechat/fb_match_info.html?mid=81943;
		$url="http://i.sporttery.cn/open_v1_0/fb_match_list/get_fb_match_odds/?username=11000000&password=test_passwd&format=jsonp&m_id=".$mid."&callback=initData";
		$rs=get($url);
		$rs=preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $rs);
		$rs=str_replace('initData(', "", $rs);
		$rs=substr_replace($rs, '', -1,1);
		$rs=json_decode($rs);
		$rs=object_array($rs);
		$array=$rs['data']['had'];
		return $array;
	}

	/*数据存档*/
	public function cundang(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.id');
		$type=I('post.type');
		if($type==1){
			$all_data=S('football');
		}
		else{
			$all_data=S('baskball');
		}
		$data=$all_data[$id];
		// print_r($data);die;
		//整理数据
		$data_2=array(
			'id'=>$data['id'],
			'number'=>$data['num'],
			'match_name'=>$data['l_cn'],
			'begin_time'=>$data['date']." ".$data['time'],
			'l_id'=>$data['l_id'],
			'h_id'=>$data['h_id'],
			'a_id'=>$data['a_id'],
			'team1'=>$data['h_cn'],
			'team2'=>$data['a_cn'],
			'sell_status'=>$data['status'],
			'rangqiu'=>$data['goalline'],
			'win'=>$data['nh'],
			'lost'=>$data['na'],
			'ping'=>$data['nd'],
			'rang_win'=>$data['h'],
			'rang_lost'=>$data['a'],
			'rang_ping'=>$data['d'],
			'type'=>$type,
			'l_cn_abbr'=>$data['l_cn_abbr'],
			);
		if(M('jc_data')->where(array('id'=>$data['id']))->find()){
			$this->ajaxReturn(array('status'=>'0','info'=>'该赛事已经存档过'));
		}
		$rs=M('jc_data')->add($data_2);
		if($rs){
			$this->ajaxReturn(array('status'=>'1','info'=>'存档成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>'0','info'=>'存档失败，稍后重试'));
		}
	}


	/*数据采集*/
	public function bk_data(){
		$list=S('baskball');
		$time=S('baskball_update');
		// print_r($list);die;
		$this->update_time=$time;
		$this->list=$list;
		$this->assign('title', '数据采集');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'bk_data');
		$this->display();
	}
	/*篮球更新数据*/
	public function updatebk_data(){
		set_time_limit (0);//   //设置程序最大执行时间为无限  0为无限制
		ini_set('max_execution_time', '0');//设置最大执行时间  0为不限时
		header("Content-Type:text/html;charset=utf-8");
		//采集数据
		//受注足球url=http://i.sporttery.cn/open_v1_0/fb_match_list/get_fb_match_list/?username=11000000&password=test_passwd&format=jsonp&callback=initData
		$baskball_url="http://i.sporttery.cn/open_v1_0/bk_match_list/get_bk_match_list/?username=11000000&password=test_passwd&format=jsonp&callback=initData";
		$baskball_info=get($baskball_url);
		$baskball_info=preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $baskball_info);
		$baskball_info=str_replace('initData(', "", $baskball_info);
		$baskball_info=substr_replace($baskball_info, '', -1,1);
		$baskball_info=json_decode($baskball_info);
		$baskball_info=object_array($baskball_info);
		// print_r($baskball_info);die;
		$match=object_array($baskball_info['data']['list']);

		foreach ($match as $key => $value) {
			$match2[$key]=object_array($match[$key]);
		}
		foreach ($match2 as $k2 => $v2) {
			$array=$this->bk_shengpingfu($v2['id']);
			$match2[$k2]['nh']=$array['h'];
			$match2[$k2]['na']=$array['a'];
			// $match2[$k2]['nd']=$array['d'];
		}
		// print_r($match2);die;
		S('baskball',$match2);
		S('baskball_update',date('Y-m-d h:i:s'));
		$this->list=$match2;
		$this->assign('title', '数据采集');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'data');
		$this->redirect('bk_data');
	}
	/*篮球数据胜平负采集*/
	public function bk_shengpingfu($mid=0){
		//$url=http://info.sporttery.cn/wechat/fb_match_info.html?mid=81943;
		$url="http://i.sporttery.cn/open_v1_0/bk_match_list/get_bk_match_odds/?username=11000000&password=test_passwd&format=jsonp&m_id=".$mid."&callback=initData";
		$rs=get($url);
		$rs=preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $rs);
		$rs=str_replace('initData(', "", $rs);
		$rs=substr_replace($rs, '', -1,1);
		$rs=json_decode($rs);
		$rs=object_array($rs);
		$array=$rs['data']['hdc'];
		return $array;
	}

	/*赛事列表*/
	public function match($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_data');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>array('in','1,2')))->order("begin_time asc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '赛事列表');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'match');
		$this->display();
	}
	/*赛事列表*/
	public function match_1($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_data');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('type'=>1,'status'=>array('in','1,2')))->order("begin_time asc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '赛事列表');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'match');
		$this->type=1;
		$this->display('match');
	}
	/*赛事列表*/
	public function match_2($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_data');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('type'=>2,'status'=>array('in','1,2')))->order("begin_time asc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '赛事列表');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'match');
		$this->type=2;
		$this->display('match');
	}
	/*发布赛事*/
	public function fabu(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.id');
		$data=M('jc_data')->where(array('id'=>$id))->find();
		//整理数据
		if(M('jc_project')->where(array('id'=>$data['id']))->find()){
			$this->ajaxReturn(array('status'=>'0','info'=>'该赛事已经发布过'));
		}
		$rs=M('jc_project')->add($data);
		if($rs){
			$this->ajaxReturn(array('status'=>'1','info'=>'发布成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>'0','info'=>'发布失败，稍后重试'));
		}
	}
	/*删除赛事*/
	public function del(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.id');
		$rs=M('jc_data')->where(array('id'=>$id))->delete();
		if($rs){
			$this->ajaxReturn(array('status'=>'1','info'=>'删除成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>'0','info'=>'删除失败，稍后重试'));
		}
	}
	/*已发布赛事*/
	public function selling($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_project');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>array('in','1,2')))->order("begin_time asc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '已发布赛事列表');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'selling');
		$this->display();
	}
	/*停盘*/
	public function stop(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.id');
		$rs=M('jc_project')->where(array('id'=>$id))->setField('status',2);
		if($rs){
			$this->ajaxReturn(array('status'=>'1','info'=>'停盘成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>'0','info'=>'停盘失败，稍后重试'));
		}
	}
	/*开盘*/
	public function start(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.id');
		$rs=M('jc_project')->where(array('id'=>$id))->setField('status',1);
		if($rs){
			$this->ajaxReturn(array('status'=>'1','info'=>'开成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>'0','info'=>'开盘失败，稍后重试'));
		}
	}
	/*侃球*/
	public function comment($pageSize = 25, $pageNum = 1){
		$db=D('Common/MatchCommentMember','VModel');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>0))->order("c_time asc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '侃球');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'comment');
		$this->type=0;
		$this->display();	
	}
	/*侃球1*/
	public function comment_1($pageSize = 25, $pageNum = 1){
		$db=D('Common/MatchCommentMember','VModel');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>array('in','1')))->order("c_time asc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '侃球');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'comment');
		$this->type=1;
		$this->display('comment');	
	}
	/*侃球*/
	public function comment_2($pageSize = 25, $pageNum = 1){
		$db=D('Common/MatchCommentMember','VModel');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>2))->order("c_time asc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '侃球');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'comment');
		$this->type=2;
		$this->display('comment');	
	}
	/*通过*/
	public function agree(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.id');
		$rs=M('jc_comment')->where(array('jcc_id'=>$id))->setField('status',1);
		if($rs){
			$this->ajaxReturn(array('status'=>'1','info'=>'通过成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>'0','info'=>'通过失败，稍后重试'));
		}
	}
	/*不通过*/
	public function disagree(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.id');
		$rs=M('jc_comment')->where(array('jcc_id'=>$id))->setField('status',2);
		if($rs){
			$this->ajaxReturn(array('status'=>'1','info'=>'不通过成功'));
		}
		else{
			$this->ajaxReturn(array('status'=>'0','info'=>'不通过失败，稍后重试'));
		}
	}
	/*已结束赛事*/
	public function match_end($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_project');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>3))->order("begin_time desc")->page($pageNum, $pageSize)->select();
		$this->list=$list;
		$this->assign('title', '已发布赛事列表');
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'match_end');
		$this->display();
	}
	/*更新足球所有*/
	public function update_all_data(){
		//找出我们的赛事
		$ids=M('jc_project')->where(array('sell_status'=>'Selling','type'=>1))->getfield('id',true);
		foreach ($ids as $key => $value) {
			$url="http://i.sporttery.cn/open_v1_0/fb_match_list/get_fb_result_odds/?username=11000000&password=test_passwd&format=jsonp&callback=initData&m_id=".$value."&_=";
			$rs=get($url);
			$rs=preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $rs);
			$rs=str_replace('initData(', "", $rs);
			$rs=substr_replace($rs, '', -1,1);
			$rs=json_decode($rs);
			$rs=object_array($rs);
			$win=$rs['data']['had']['h'];
			$ping=$rs['data']['had']['d'];
			$lost=$rs['data']['had']['a'];
			$rang_win=$rs['data']['hhad']['h'];
			$rang_ping=$rs['data']['hhad']['d'];
			$rang_lost=$rs['data']['hhad']['a'];
			// print_r($rs);
			$rs['data']['had']=serialize($rs['data']['had']);
			$rs['data']['hhad']=serialize($rs['data']['hhad']);
			$rs['data']['crs']=serialize($rs['data']['crs']);
			$rs['data']['ttg']=serialize($rs['data']['ttg']);
			$rs['data']['hafu']=serialize($rs['data']['hafu']);

			if(!M('jc_all_data')->where(array('id'=>$rs['data']['id']))->find()){
				M('jc_all_data')->add($rs['data']);
			}
			else{
				M('jc_all_data')->where(array('id'=>$rs['data']['id']))->save($rs['data']);
			}
			//处理结果数据
			$goal=explode(':', $rs['data']['final']);
			if($rs['status']['code']!="8000"){
				continue;
			}
			if($rs['data']['match_status']=="Final"){
				//比赛结束,更新数据
				$array=array(
					'sell_status'=>$rs['data']['match_status'],
					'status'=>3,
					'l_goal'=>$goal[0],
					'a_goal'=>$goal[1],
					'll_goal'=>$goal[0]+$rs['data']['goalline'],
					'aa_goal'=>$goal[1],
					'had_result'=>$rs['data']['had_result'],
					'hhad_result'=>$rs['data']['hhad_result'],
					'win'=>$win,
					'ping'=>$ping,
					'lost'=>$lost,
					'rang_win'=>$rang_win,
					'rang_ping'=>$rang_ping,
					'rang_lost'=>$rang_lost,
					);
				M('jc_project')->where(array('id'=>$rs['data']['id'],'sell_status'=>'Selling'))->setField($array);
			}
		}
		$this->redirect('selling');
	}
	/*更新足球所有*/
	public function update_bk_data(){
		//找出我们的赛事
		$ids=M('jc_project')->where(array('sell_status'=>'Selling','type'=>2))->getfield('id',true);
		foreach ($ids as $key => $value) {
			$url="http://i.sporttery.cn/open_v1_0/bk_match_list/get_bk_result_odds/?username=11000000&password=test_passwd&format=jsonp&callback=initData&m_id=".$value."&_=";
			$rs=get($url);
			$rs=preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $rs);
			$rs=str_replace('initData(', "", $rs);
			$rs=substr_replace($rs, '', -1,1);
			$rs=json_decode($rs);
			$rs=object_array($rs);
			$win=$rs['data']['mnl']['h'];
			$lost=$rs['data']['mnl']['a'];
			$rang_win=$rs['data']['hdc']['h'];
			$rang_lost=$rs['data']['hdc']['a'];
			$rs['data']['had']=serialize($rs['data']['mnl']);
			$rs['data']['hhad']=serialize($rs['data']['hdc']);
			$rs['data']['crs']=serialize($rs['data']['hilo']);
			$rs['data']['ttg']=serialize($rs['data']['wnm']);
			if(!M('jc_all_data')->where(array('id'=>$rs['data']['id']))->find()){
				M('jc_all_data')->add($rs['data']);
			}
			else{
				M('jc_all_data')->where(array('id'=>$rs['data']['id']))->save($rs['data']);
			}
			//处理结果数据
			$goal=explode(':', $rs['data']['final']);
			if($rs['data']['match_status']=="Final"){
				//比赛结束,更新数据
				$array=array(
					'sell_status'=>'Final',
					'status'=>3,
					'l_goal'=>$goal[0],
					'a_goal'=>$goal[1],
					'll_goal'=>$goal[0]+$rs['data']['goalline'],
					'aa_goal'=>$goal[1],
					'had_result'=>$rs['data']['mnl_result'],
					'hhad_result'=>$rs['data']['hdc_result'],
					'win'=>$win,
					'ping'=>$ping,
					'lost'=>$lost,
					'rang_win'=>$rang_win,
					'rang_ping'=>$rang_ping,
					'rang_lost'=>$rang_lost,
					);
				M('jc_project')->where(array('id'=>$rs['data']['id'],'sell_status'=>'Selling'))->setField($array);
			}
		}
		$this->redirect('selling');
	}

	/*大猜想*/
	public function other($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_other');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>1))->order("time desc")->page($pageNum, $pageSize)->select();
		foreach ($list as $key => $value) {
			$list[$key]['choice']=unserialize($value['choice']);
		}
		$this->list=$list;
		$this->assign('title', '大猜想');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'other');
		$this->display();
	}
	/*添加大猜想*/
	public function other_add(){
		if(IS_POST){
			$data=I('post.');
			$data['choice']=serialize($data['xx_data']);
			$data['time']=date('Y-m-d h:i:s');
			M()->startTrans();
			$jco_id=M('jc_other')->add($data);
			foreach ($data['xx_data'] as $key => $value) {
				if($key%2==0){
					$xx_data[$key]['xx_title']=$value;
					$xx_data[$key]['xx_pl']=$data['xx_data'][$key+1];
					$xx_data[$key]['jco_id']=$jco_id;
				}
			}
			$choice_status=M('jc_other_choic')->addAll($xx_data);
			if($jco_id&&$choice_status){
				M()->commit();
				$this->ajaxReturn(array('status'=>1,'info'=>'添加成功','url'=>U('other')));
			}
			else{
				M()->rollback();
				$this->ajaxReturn(array('status'=>0,'info'=>'添加失败，请稍后重试'));
			}
		}
		else{
			$list=M('jc_menu')->where(array('status'=>1))->select();
			$this->menu=$list;
			$this->assign('title', '大猜想');
			$this->assign('action', U('index', '', ''));
			$this->assign('pid', 'jingcai');
			$this->assign('mid', 'other');
			$this->display();
		}
	}
	/*添加大猜想*/
	public function other_del(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.del_id');
		$rs=M('jc_other')->where(array('jco_id'=>$id,'number'=>array('gt','1')))->delete();
		if($rs){
			$this->ajaxReturn(array('status'=>1,'info'=>'删除成功','url'=>U('other')));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'删除失败，请稍后重试'));
		}
	}
	/*结束大猜想*/
	public function other_end(){
		if(!IS_POST)$this->error('非法操作');
		$id=I('post.end_id');
		$xx=I('post.right');
		//askii反转得出哪个选项
		$xx=ord($xx)-65;
		//找出选择id和赔率
		$xx_data=M('jc_other_choic')->where(array('jco_id'=>$id))->order('id asc')->select();
		$xx_data=$xx_data[$xx];
		//插入结果到jc_other表
		$save=array(
			'end_choic_id'=>$xx_data['id'],
			'end_choic'=>$xx_data['xx_title'],
			'end_pl'=>$xx_data['xx_pl'],
			'end_time'=>date('Y-m-d h:i:s'),
			'status'=>2,
			);
		$rs=M('jc_other')->where(array('jco_id'=>$id))->save($save);
		if($rs){
			$this->ajaxReturn(array('status'=>1,'info'=>'结束成功','url'=>U('other')));
		}
		else{
			$this->ajaxReturn(array('status'=>0,'info'=>'结束失败，请稍后重试'));
		}
	}
	/*大猜想--已结束*/
	public function end_other($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_other');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('status'=>2))->order("time desc")->page($pageNum, $pageSize)->select();
		foreach ($list as $key => $value) {
			$list[$key]['choice']=unserialize($value['choice']);
		}
		$this->list=$list;
		$this->assign('title', '大猜想-已结束');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'end_other');
		$this->display();
	}
	public function comment_keyword(){
		if(IS_POST){
			$keyword=I('post.keyword');
			M('config')->where(array('name'=>'comment_keyword'))->setField('value',$keyword);
			$this->ajaxReturn(array('status'=>1,'info'=>'保存成功'));
		}
		$keyword=M('config')->where(array('name'=>'comment_keyword'))->getfield('value');
		$this->keyword=$keyword;
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'comment_keyword');
		$this->display();
	}

	/*大猜想--未发放列表*/
	public function unissued($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_record');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('type'=>array('in','3,4'),'status'=>1))->order("time desc")->page($pageNum, $pageSize)->select();
		foreach ($list as $key => $value) {
			if($list[$key]['type']=='3'){
	    		$xx=explode(':',$list[$key]['buy_detail']);
	    		unset($xx[1]);
	    	}else{
	    		$xx=unserialize($list[$key]['buy_detail']);
	    	}
	    	$rs=1;
	    	$rss=0;
    		foreach ($xx as $k => $v) {
	    		$result[$k]=M('jc_other_choic')->join('yyg_jc_other ON yyg_jc_other_choic.jco_id=yyg_jc_other.jco_id')->where(array('id'=>$v))->find();
	    		// print_r($result);die;
	    		$result[$k]['right']=M('jc_other_choic')->where(array('id'=>$result[$k]['end_choic_id']))->getField('xx_title');
	    		// print_r($result);die;
	    		if($v==$result[$k]['end_choic_id']){
	    			$result[$k]['is_right']='胜';
	    			$pd=1;
	    		}	
	    		else{
	    			$result[$k]['is_right']='负';
	    			$pd=0;
	    		}
	    		$rs=($rs & $pd);
	    		if(empty($result[$k]['end_choic_id'])){
	    			$result[$k]['is_right']='未揭晓';
	    			$rss=2;
	    		}
	    	}
	    	$list[$key]['result']=$result;
	    	unset($result);
	    	if(!empty($rss)){
    			$list[$key]['rs']=$rss;
	    	}
	    	else{
	    		$list[$key]['rs']=$rs;
	    	}
		}
		// print_r($list);
		$this->list=$list;
		$this->assign('title', '大猜想--未发放列表');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'unissued');
		$this->display();
	}
	/*大猜想--已发放列表*/
	public function issued($pageSize = 25, $pageNum = 1){
		// 分页
		$db = M('jc_record');
		$count = $db->count();
		if(!$pageSize) {
			$pageSize = 25;
		}
		$pageNum = intval($pageNum);
		$pageCount = ceil($count / $pageSize);
		if($pageNum > $pageCount) {
			$pageNum = $pageCount;
		}
		$this->assign('pageSize', $pageSize);
		$this->assign('pageNum', $pageNum);
		$this->assign('count', $count);
		$this->assign('pageCount', $pageCount);
		$this->assign('minPageNum', floor(($pageNum-1)/10.0) * 10 + 1);
		$this->assign('maxPageNum', min(ceil(($pageNum)/10.0) * 10 + 1, $pageCount));
		$list = $db->where(array('type'=>array('in','3,4'),'status'=>2))->order("time desc")->page($pageNum, $pageSize)->select();
		foreach ($list as $key => $value) {
			if($list[$key]['type']=='3'){
	    		$xx=explode(':',$list[$key]['buy_detail']);
	    		unset($xx[1]);
	    	}else{
	    		$xx=unserialize($list[$key]['buy_detail']);
	    	}
	    	$rs=1;
	    	$rss=0;
    		foreach ($xx as $k => $v) {
	    		$result[$k]=M('jc_other_choic')->join('yyg_jc_other ON yyg_jc_other_choic.jco_id=yyg_jc_other.jco_id')->where(array('id'=>$v))->find();
	    		// print_r($result);die;
	    		$result[$k]['right']=M('jc_other_choic')->where(array('id'=>$result[$k]['end_choic_id']))->getField('xx_title');
	    		// print_r($result);die;
	    		if($v==$result[$k]['end_choic_id']){
	    			$result[$k]['is_right']='胜';
	    			$pd=1;
	    		}	
	    		else{
	    			$result[$k]['is_right']='负';
	    			$pd=0;
	    		}
	    		$rs=($rs & $pd);
	    		if(empty($result[$k]['end_choic_id'])){
	    			$result[$k]['is_right']='未揭晓';
	    			$rss=2;
	    		}
	    	}
	    	$list[$key]['result']=$result;
	    	unset($result);
	    	if(!empty($rss)){
    			$list[$key]['rs']=$rss;
	    	}
	    	else{
	    		$list[$key]['rs']=$rs;
	    	}
		}
		// print_r($list);
		$this->list=$list;
		$this->assign('title', '大猜想--已发放列表');
		$this->assign('action', U('index', '', ''));
		$this->assign('pid', 'jingcai');
		$this->assign('mid', 'issued');
		$this->display();
	}
	/*发放奖金*/
	public function fafan(){
		if(!IS_post)$this->error('非法操作');
		$jcr_id=I('post.id');
		$jcr_info=M('jc_record')->where(array('jcr_id'=>$jcr_id))->find();
		$type=I('post.type');
		$uid=I('post.uid');
		if($type!=1){
			$save=array(
				'status'=>2,
				'end_time'=>date('Y-m-d H:i:s'),
			);
			$status=M('jc_record')->where(array('jcr_id'=>$jcr_id))->save($save);
			if($status){
				$this->ajaxReturn(array('status'=>1,'info'=>'发放0积分成功','url'=>U('unissued')));
			}
			else{
				$this->ajaxReturn(array('status'=>0,'info'=>'发放失败'));
			}
		}
		else{
			$save=array(
				'status'=>2,
				'end_time'=>date('Y-m-d H:i:s'),
			);
			M()->startTrans();
			$status=M('jc_record')->where(array('jcr_id'=>$jcr_id))->save($save);
			//发放积分
			$status2=M('member')->where(array('uid'=>$uid))->setINC('score',($jcr_info['money']*$jcr_info['total_bl']));
			$total_money=$jcr_info['money']*$jcr_info['total_bl'];
			$array=array(
				'uid'=>$uid,
				'scoresource'=>'竞猜奖励',
				'time'=>date('Y-m-d H:i:s'),
				'score'=>$total_money,
				);
			$status=M('member_score')->add($array);
			if($status&&$status2&&$status){
				M()->commit();
				$this->ajaxReturn(array('status'=>1,'info'=>'发放'.$total_money.'积分成功','url'=>U('unissued')));
			}else{
				M()->rollback();
				$this->ajaxReturn(array('status'=>0,'info'=>'发放失败'));
			}
		}
	}
}	