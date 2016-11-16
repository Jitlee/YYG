<?php
namespace Admin\Controller;
use Think\Controller;
class TestController extends CommonController {
    public function index(){
    	$map['time']=array('egt','2016-07-01');
    	$map['_string']="`yaoqing` is null OR `yaoqing` ='0'";
    	$rs=M('member')->where($map)->field('uid,openid,time')->select();
    	foreach ($rs as $key => $value) {
    		$rs2=M('wx_user')->where(array('openid'=>$value['openid']))->getField('wx_id');
    		// print_r($rs2);
    		unset($map);
    		$map['wx_id']=$rs2;
    		$map['bk_time']=array('lt',strtotime($value['time']));
    		$rs3=M('bangkan')->where($map)->order('bk_time asc')->find();
    		// print_r($rs3);
    		// echo M('bangkan')->getlastsql();
    		$rs4=M('kanjia')->where(array('kj_id'=>$rs3['kj_id']))->find();
    		// print_r($rs4);
    		if($rs4['uid']==$value['uid']){
    			echo "自己";
    		}
    		else{
    			print_r($value['uid']);
    			print_r($rs4);
    		}
    		
    	}
    	die;
    }
}