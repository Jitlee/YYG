<?php
namespace Wechat\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
use Com\Jssdk;
class TestController extends Controller{
    //将帮看人绑定到砍价人的邀请名单上
    public function test1(){
        $map['time']=array('egt','2016-07-01');
        $map['yaoqing']="0 OR NULL";
        $rs1=M('member')->where($map)->select();
        echo count($rs1)."<br>";
        // print_r($rs1);
        foreach ($rs1 as $key => $value) {
            $wx_id=M('wx_user')->where(array('openid'=>$value['openid']))->getField('wx_id');
            if($wx_id){
                $rs2[$key]['uid']=$value['uid'];
                $rs2[$key]['wx_id']=$wx_id;
            }
        }
        //找到这个人帮谁砍了
        foreach ($rs2 as $key2 => $value2) {
            $bangkan=M('bangkan')->where(array('wx_id'=>$value2['wx_id']))->order('bk_time desc')->limit(1)->getField('kj_id');
            if($bangkan){
                $rs2[$key2]['kj_id']=$bangkan;
                $kanjiaren=M('kanjia')->where(array('kj_id'=>$bangkan))->getfield('uid');
                if($kanjiaren==$value2['uid']){
                    unset($rs2[$key2]);
                }
                else{
                    $rs2[$key2]['kj_uid']=$kanjiaren;
                }
            }
        }
        echo count($rs2);
        print_r($rs2);
        // //把邀请人重新归位
        // foreach ($rs2 as $key3 => $value3) {
        //     M('member')->where(array('uid'=>$value3['uid']))->setField('yaoqing',$value3['kj_uid']);
        // }
    }
    //小号购买
    public function index(){
        $kj_id=56;
        $kj_info=M('kanjia')->where(array('kj_id'=>$kj_id))->find();
        $wx_user=M('wx_user')->where(array('nickname is not null'))->select();
        header("Content-type:text/html;charset=utf-8");
        set_time_limit (0);//   //设置程序最大执行时间为无限  0为无限制
        ini_set('max_execution_time', '0');//设置最大执行时间  0为不限时
        $len=count($wx_user);
        $shengyumoney=$kj_info['shengyumoney'];
        for($n=2215;$n<4000;$n++){
            // print_r($wx_user[$n]);
            $sj=mt_rand(0,5)+mt_rand(1,99)/100;
            echo $sj;
            //添加帮砍记录
            $add_info=array(
                'wx_id'=>$wx_user[$n]['wx_id'],
                'kj_id'=>$kj_id,
                'bk_money'=>$sj,
                'bk_time'=>time(),
                );
            if($shengyumoney<=$sj){
                $sj=$shengyumoney;
            }
            if($shengyumoney<=0){
                exit();
            }
            $shengyumoney=$shengyumoney-$sj;
            M('bangkan')->add($add_info);
            M('kanjia')->where(array('kj_id'=>$kj_id))->setDEC('shengyumoney',$sj);
        }

    }
}
