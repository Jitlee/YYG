<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 竞彩控制器
 */
class JingcaiController extends Controller {
	
	public function index(){
		$this->uid=session('_uid');
		// print_r(session());
		$this->img=session('wxUserinfo.img');
		// print_r(session('wxUserinfo.img'));die;
		$lunbotu=M('jc_ad')->where(array('status'=>1))->select();
		$menu=M('jc_menu')->where(array('status'=>1))->order('sort desc')->select();
		$this->lunbotu=$lunbotu;
		$this->menu=$menu;
		$this->display();
    }
    /*竞彩足球*/
    public function football(){
    	layout(false);
    	$list=M('jc_project')->where(array('status'=>1,'type'=>1))->select();
    	$count=count($list);
    	$this->count=$count;
    	$this->list=$list;
    	$this->title="竞彩足球";
    	$this->display();
    }
    public function firstgoal(){
    	layout(false);
    	$list=M('jc_other')->where(array('status'=>1,'menu_id'=>12))->order('time desc')->find();
    	$choic=M('jc_other_choic')->where(array('jco_id'=>$list['jco_id']))->select();
    	foreach($choic as $key=>$value){
    		if($value['xx_number']==0){
    			$choic[$key]['bl']=0;
    		}else{
    			$choic[$key]['bl']=round($value['xx_number']/$list['number']*100,1);
    		}
    		
    	}
    	$this->choic=$choic;
    	$count=count($list);
    	$this->count=$count;
    	$this->list=$list;
    	$this->title="首金大猜想";
    	$this->display();
    }
    /*赛事资料*/
    public function match_data(){
    	layout(false);
    	$this->display();
    }
    /*NBA*/
    public function NBA(){
    	$dongbu=S('dongbu');
    	$xibu=S('xibu');
    	if(!$dongbu||!$xibu){
			$url="http://nba.sports.sina.com.cn/league_order1.php";
	    	$content=get($url);
	    	$content = iconv("gb2312","utf-8//IGNORE",$content);
	    	// print_r($content);die;
	    	preg_match_all('/东部排名(.*?)<\/table>/s', $content, $rs1);
	    	preg_match_all('/<tr(.*?)<\/tr>/s', $rs1[0][0], $rs2);
	    	foreach($rs2[0] as $key=>$value){
	    		preg_match_all('/<td.*?>(.*?)<\/td>/s', $value, $rs3[$key]);
	    		$match[$key]=$rs3[$key][1];
	    	}
	    	unset($match[0]);
	    	unset($match[count($dongbu)]);
	    	unset($match[16]);
	    	unset($match[17]);
	    	unset($match[18]);
	    	unset($match[19]);
	    	unset($match[35]);
	    	// print_r($match[36]);die;
	    	foreach ($match as $k1 => $v1) {
	    		// print_r($v1[1]);
	    		// preg_match_all('/<.*?0\">(.*?)</',$v1[1],$getname);
	    		// $v1[1]=$getname[1][0];
	    		$v1[1]=str_replace('href', "", $v1[1]);
	    		if($k1<=15){
	    			$dongbu[]=$v1;
	    		}
	    		else{
	    			$xibu[]=$v1;
	    		}
	    	}
	    	//1 2 3 4 5 18
	    	S('dongbu',$dongbu);
	    	S('xibu',$xibu);
    	}

    	// print_r($dongbu);die;
    	$this->dongbu=$dongbu;
    	$this->xibu=$xibu;
    	layout(false);
    	$this->display();
    }
     /*CSL*/
    public function CSL(){
    	$match=S('CSL');
    	if(!$match){
    		$url="http://match.sports.sina.com.cn/football/opta_rank.php?year=2016&lid=8";
	    	$content=get($url);
	    	// $content = iconv("gb2312","utf-8//IGNORE",$content);
	    	preg_match_all('/<tr(.*?)<\/tr>/s', $content, $rs1);
	    	unset($rs1[0]);
	    	unset($rs1[1][0]);
	    	foreach($rs1[1] as $key=>$value){
	    		preg_match_all('/<td.*?>(.*?)<\/td>/s', $value, $rs3[$key]);
	    		$rs3[$key][1]=str_replace('href', "", $rs3[$key][1]);
	    		$match[$key]=$rs3[$key][1];
	    	}
	    	//0,1,3,4,5,6,7,9
	    	// print_r($dongbu);die;
	    	S('CSL',$match);
    	}
    	$this->match=$match;
    	layout(false);
    	$this->display();
    }
     /*UEFA*/
    public function UEFA(){
    	
    	layout(false);
    	$this->display();
    }
    /*CSL*/
    public function SERIEA(){
    	$match=S('SERIEA');
    	if(!$match){
	    	$url="http://match.sports.sina.com.cn/football/opta_rank.php?year=2015&lid=4";
	    	$content=get($url);
	    	// $content = iconv("gb2312","utf-8//IGNORE",$content);
	    	preg_match_all('/<tr(.*?)<\/tr>/s', $content, $rs1);
	    	unset($rs1[0]);
	    	unset($rs1[1][0]);
	    	foreach($rs1[1] as $key=>$value){
	    		preg_match_all('/<td.*?>(.*?)<\/td>/s', $value, $rs3[$key]);
	    		$rs3[$key][1]=str_replace('href', "", $rs3[$key][1]);
	    		$match[$key]=$rs3[$key][1];
	    	}
	    	S('SERIEA',$match);
	    }
    	//0,1,3,4,5,6,7,9
    	// print_r($dongbu);die;
    	$this->match=$match;
    	layout(false);
    	$this->display();
    }
    /*LFP*/
    public function LFP(){
    	$match=S('LFP');
    	if(!$match){
	    	$url="http://match.sports.sina.com.cn/football/opta_rank.php?year=2015&lid=2";
	    	$content=get($url);
	    	// $content = iconv("gb2312","utf-8//IGNORE",$content);
	    	preg_match_all('/<tr(.*?)<\/tr>/s', $content, $rs1);
	    	unset($rs1[0]);
	    	unset($rs1[1][0]);
	    	foreach($rs1[1] as $key=>$value){
	    		preg_match_all('/<td.*?>(.*?)<\/td>/s', $value, $rs3[$key]);
	    		$rs3[$key][1]=str_replace('href', "", $rs3[$key][1]);
	    		$match[$key]=$rs3[$key][1];
	    	}
	    	S('LFP',$match);
    	}
    	//0,1,3,4,5,6,7,9
    	// print_r($dongbu);die;
    	$this->match=$match;
    	layout(false);
    	$this->display();
    }
    
    /*Bundesliga*/
    public function Bundesliga(){
    	$match=S('Bundesliga');
    	if(!$match){
	    	$url="http://match.sports.sina.com.cn/football/opta_rank.php?year=2015&lid=3";
	    	$content=get($url);
	    	// $content = iconv("gb2312","utf-8//IGNORE",$content);
	    	preg_match_all('/<tr(.*?)<\/tr>/s', $content, $rs1);
	    	unset($rs1[0]);
	    	unset($rs1[1][0]);
	    	foreach($rs1[1] as $key=>$value){
	    		preg_match_all('/<td.*?>(.*?)<\/td>/s', $value, $rs3[$key]);
	    		$rs3[$key][1]=str_replace('href', "", $rs3[$key][1]);
	    		$match[$key]=$rs3[$key][1];
	    	}
	    	S('Bundesliga',$match);
	    }
    	//0,1,3,4,5,6,7,9
    	// print_r($dongbu);die;
    	$this->match=$match;
    	layout(false);
    	$this->display();
    }
     /*比分直播*/
    public function livescores(){
    	$url="http://i.sporttery.cn/api/match_live/get_match_list?callback=?&_=1469065725758";
    	$content=get($url);
    	$content=str_replace('var match_list = ', "", $content);
    	$content=substr($content,0,strlen($content)-1); 
    	$content=json_decode($content);
    	$content=object_array($content);
    	foreach ($content as $key => $value) {
    		if($value['status']=="Playing"){
    			//进行中
    			$playing[]=$value;
    		}
    		if($value['status']=="Fixture"){
    			//未开赛
    			$fixture[]=$value;
    		}
    		if($value['status']=="Played"){
    			//已结束
    			$played[]=$value;
    		}
    	}
    	// print_r($content);die;
    	$this->match=$content;
    	$this->playing=$playing;
    	$this->played=$played;
    	$this->fixture=$fixture;
    	layout(false);
    	$this->display();
    }
    //更新赛事
    public function get_match_update(){
    	$url="http://i.sporttery.cn/api/match_live/get_match_updated?callback=?&_=1469067957894";
    	$content=get($url);
    	$content=str_replace('var match_updated = ', "", $content);
    	$content=substr($content,0,strlen($content)-1);
    	// $content=json_decode($content);
    	// $content=object_array($content);
    	echo($content);
    }
    protected function unicode_decode($name)
	{
	    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
	    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
	    preg_match_all($pattern, $name, $matches);
	    if (!empty($matches))
	    {
	        $name = '';
	        for ($j = 0; $j < count($matches[0]); $j++)
	        {
	            $str = $matches[0][$j];
	            if (strpos($str, '\\u') === 0)
	            {
	                $code = base_convert(substr($str, 2, 2), 16, 10);
	                $code2 = base_convert(substr($str, 4), 16, 10);
	                $c = chr($code).chr($code2);
	                $c = iconv('UCS-2', 'UTF-8', $c);
	                $name .= $c;
	            }
	            else
	            {
	                $name .= $str;
	            }
	        }
	    }
	    return $name;
	}
	/*确认页面*/
    public function confirm(){
    	if(!IS_POST)$this->error('非法操作');
    	$data=I('post.');
    	$uid=session('_uid');
    	if(empty($uid)){
    		$this->error('未登录',U('/Home/Public/login'));
    	}
    	// print_r($data);die;
    	$select=explode(',', $data['chs']);
    	foreach ($select as $key => $value) {
    		if(empty($value)){
    			unset($select[$key]);
    		}
    	}
        // print_r($select);die;
    	foreach ($select as $key => $value) {
    		$chs[]=explode(':', $value);
    	}
        $total_pl=1;
    	foreach ($chs as $key => $value) {
            $total_pl*=$value[2];
        }
        $this->total_pl=round($total_pl,2);
        $this->count=count($chs);
		$this->type=$data['type'];
		// S('football_'.$uid,$chuan);
		// $this->chuan=$chuan;
    	$this->display();
    }

    /*不重复排列组合*/
    protected function getCombinationToString($arr,$m)
		{
		    $result = array();
		    if ($m ==1)
		    {
		       return $arr;
		    }
		    
		    if ($m == count($arr))
		    {
		        $result[] = implode(',' , $arr);
		        return $result;
		    }
		        
		    $temp_firstelement = $arr[0];
		    unset($arr[0]);
		    $arr = array_values($arr);
		    $temp_list1 = $this->getCombinationToString($arr, ($m-1));
		    
		    foreach ($temp_list1 as $s)
		    {
		        $s = $temp_firstelement.','.$s;
		        $result[] = $s;
		    }
		    unset($temp_list1);

		    $temp_list2 = $this->getCombinationToString($arr, $m);
		    foreach ($temp_list2 as $s)
		    {
		        $result[] = $s;
		    }    
		    unset($temp_list2);
		    
		    return $result;
		}
		/*首金竞猜买入*/
    public function buy_first(){
    	if(!IS_POST)$this->error('非法操作');
    	$data=I('post.');
    	// print_r($data);
    	//找到选择的这个选项
    	$rs=M('jc_other_choic')->where(array('id'=>$data['choic']))->find();
    	$total=$data['number']*200;
    	if($total<=0){
    		$this->error('非法操作');
    	}
    	// echo $total;die;
    	//查看这个人有没有登陆
    	$uid=session('_uid');
    	if(empty($uid)){
    		$this->ajaxReturn(array('status'=>0,'info'=>'正在跳转登陆页面','url'=>U('/Home/Public/login')));
    	}
    	//找到此用户的运动币
    	$score=M('member')->where(array('uid'=>$uid))->getfield('score');
    	if($total>$score){
    		$this->ajaxReturn(array('status'=>0,'info'=>'运动币不足请先充值','url'=>U('Person/recharge')."?is_score=1"));
    	}
    	/*添加纪录*/
    	M()->startTrans();
    	//增加人数
    	$status1=M('jc_other_choic')->where(array('id'=>$data['choic']))->setINC('xx_number',1);
    	$status2=M('jc_other')->where(array('jco_id'=>$rs['jco_id']))->setINC('number',1);
    	$array=array(
    		'jc_id'=>$rs['jco_id'],
    		'uid'=>$uid,
    		'buy_detail'=>$data['choic'].":".$data['number'],
    		'count'=>$data['number'],
    		'total_bl'=>$rs['xx_pl'],
    		'money'=>$total,
    		'status'=>1,
    		'type'=>3,
    		'time'=>date('Y-m-d H:i:s'),
    		);
    	$status3=M('jc_record')->add($array);
    	$status4=M('member')->where(array('uid'=>$uid))->setDEC('score',$total);
    	if($status1&&$status2&&$status3&&$status4){
    		M()->commit();
    		$this->ajaxReturn(array('status'=>1,'info'=>'购买成功，请留意开奖公告'));
    	}
    	else{
    		M()->rollback();
    		$this->ajaxReturn(array('status'=>0,'info'=>'购买失败，请联系客服咨询'));
    	}
    }

    /*足球竞猜买入*/
    public function buy_football(){
    	if(!IS_POST)$this->error('非法操作');
    	$uid=session('_uid');
    	if(empty($uid)){
    		$this->error('未登录',U('/Home/Public/login'));
    	}
    	$chuan=S('football_'.$uid);
    	if(empty($chuan)){
    		$this->ajaxReturn(array('status'=>0,'info'=>'获取您的场次失败,请重试','url'=>U('football')));
    	}
    	$data=I('post.');
    	// print_r($chuan);
    	$fangshi=$data['fangshi']-2;
    	if($fangshi<0){
    		$this->ajaxReturn(array('status'=>0,'info'=>'串买方式错误'));
    	}
    	if($data['number']<=0){
    		$this->ajaxReturn(array('status'=>0,'info'=>'购买倍数错误'));
    	}

    	$total=$data['number']*200;
    	if($total<=0){
    		$this->error('非法操作');
    	}
    	//找到此用户的运动币
    	$score=M('member')->where(array('uid'=>$uid))->getfield('score');
    	if($total>$score){
    		$this->ajaxReturn(array('status'=>0,'info'=>'运动币不足请先充值','url'=>U('Person/recharge')."?is_score=1"));
    	}
    	//处理串买数据
    	$buy_data=$chuan[$fangshi];
    	unset($buy_data['pl']);
    	$buy_data=serialize($buy_data);
    	// print_r($buy_data);die;
    	/*添加纪录*/
    	M()->startTrans();
    	$array=array(
    		'jc_id'=>'',
    		'uid'=>$uid,
    		'buy_detail'=>$buy_data,
    		'count'=>$data['number'],
    		'total_bl'=>'',
    		'money'=>$total,
    		'status'=>1,
    		'type'=>$data['type'],
    		'time'=>date('Y-m-d H:i:s'),
		);
    	$status3=M('jc_record')->add($array);
    	$status4=M('member')->where(array('uid'=>$uid))->setDEC('score',$total);
    	if($status3&&$status4){
    		M()->commit();
    		if($data['type']==1){
    			$this->ajaxReturn(array('status'=>1,'info'=>'购买成功，请留意开奖公告','url'=>U('football')));
    		}elseif($data['type']==2){
    			$this->ajaxReturn(array('status'=>1,'info'=>'购买成功，请留意开奖公告','url'=>U('basketball')));
    		}else{
    			$this->ajaxReturn(array('status'=>1,'info'=>'购买成功，请留意开奖公告','url'=>U('index')));
    		}
    		
    	}
    	else{
    		M()->rollback();
    		$this->ajaxReturn(array('status'=>1,'info'=>'购买失败，请联系客服咨询'));
    	}
    }
    /*
    检查登陆情况
     */
    public function check_login(){
    	$uid=session('_uid');
    	if(empty($uid)){
    		$this->ajaxReturn(array('status'=>0,'info'=>'未登录，不能购买','url'=>U('/Home/Public/login')));
    	}
    	else{
    		$this->ajaxReturn(array('status'=>1));
    	}
    }
    /*竞彩篮球*/
    public function basketball(){
    	layout(false);
    	$list=M('jc_project')->where(array('status'=>1,'type'=>2))->select();
    	$count=count($list);
    	$this->count=$count;
    	$this->list=$list;
    	$this->title="竞彩篮球";
    	$this->display();
    }
    /*无厘头大猜想*/
    public function wulitou(){
    	layout(false);
    	$list=M('jc_other')->where(array('status'=>1,'menu_id'=>13))->select();
    	// print_r($list);die;
    	foreach ($list as $key => $value) {
    		$list[$key]['xx']=M('jc_other_choic')->where(array('jco_id'=>$value['jco_id']))->select();
    	}
    	// print_r($list);die;
    	$count=count($list);
        
    	$this->count=$count;
    	$this->list=$list;
    	$this->title="无厘头大猜想";
    	$this->display();
    }
     /*无厘头大猜想*/
    public function buy_other_confirm(){
    	layout(false);
    	if(!IS_POST)$this->error('非法操作');
    	$data=I('post.select');
    	$data=explode(',',$data);
    	foreach ($data as $key => $value) {
    		if(empty($value)){
    			unset($data[$key]);
    		}
    	}
    	$pl=1;
    	foreach ($data as $k => $v) {
    		$info[$k]['id']=$v;
    		$info[$k]['xx_info']=M('jc_other_choic')->where(array('id'=>$v))->find();
    		$pl*=$info[$k]['xx_info']['xx_pl'];
    	}
    	$this->pl=$pl;
    	$select=implode(',',$data);
    	$this->select=$select;
    	$this->k=count($data);
    	$this->display();
    }
     /*无厘头大猜想*/
    public function buy_other(){
    	if(!IS_POST)$this->error('非法操作');
    	$data=I('post.');
    	$total=$data['number']*200;
    	if($total<=0){
    		$this->error('非法操作');
    	}
    	//查看这个人有没有登陆
    	$uid=session('_uid');
    	if(empty($uid)){
    		$this->ajaxReturn(array('status'=>0,'info'=>'正在跳转登陆页面','url'=>U('/Home/Public/login')));
    	}
    	//找到此用户的运动币
    	$score=M('member')->where(array('uid'=>$uid))->getfield('score');
    	if($total>$score){
    		$this->ajaxReturn(array('status'=>0,'info'=>'运动币不足请先充值','url'=>U('Person/recharge')."?is_score=1"));
    	}
    	$data['select']=explode(',', $data['select']);
    	foreach ($data['select'] as $key => $value) {
    		$select[$key]=M('jc_other_choic')->where(array('id'=>$value))->find();
    	}
    	/*添加纪录*/
    	M()->startTrans();
    	//增加人数
    	$pl=1;
    	// print_r($select);die;
    	foreach ($select as $k => $v) {
    		M('jc_other')->where(array('jco_id'=>$v['jco_id']))->setINC('number',1);
    		M('jc_other_choic')->where(array('id'=>$v['id']))->setINC('xx_number',1);
    		$pl*=$v['xx_pl'];
    	}
    	$array=array(
    		'jc_id'=>'',
    		'uid'=>$uid,
    		'buy_detail'=>serialize($data['select']),
    		'count'=>$data['number'],
    		'total_bl'=>$pl,
    		'money'=>$total,
    		'status'=>1,
    		'type'=>4,
    		'time'=>date('Y-m-d H:i:s'),
		);
    	$status3=M('jc_record')->add($array);
    	$status4=M('member')->where(array('uid'=>$uid))->setDEC('score',$total);
    	if($status3&&$status4){
    		M()->commit();
    		$this->ajaxReturn(array('status'=>1,'info'=>'购买成功，请留意开奖公告','url'=>U('wulitou')));
    	}
    	else{
    		M()->rollback();
    		$this->ajaxReturn(array('status'=>0,'info'=>'购买失败，请联系客服咨询'));
    	}

    }
    
    public function test(){
        $map['is_false']=0;
        $map['mobile']=array('neq','admin');
        $mobile=M('member')->where($map)->getField('mobile',true);
        $mobile=implode(';', $mobile);
        echo $mobile;
    }
}