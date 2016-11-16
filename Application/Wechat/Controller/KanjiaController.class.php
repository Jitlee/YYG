<?php
namespace Wechat\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
use Com\Jssdk;
class KanjiaController extends CommonController{

    public function index(){
        // print_r(session());die;
        /*找到页面信息*/
        $kj_id=I('get.kj_id');
        $this->getcode($kj_id);
        die;
    }
    public function index_2(){
        /*找到页面信息*/
        $kj_id=I('get.kj_id');
        // $this->getcode($kj_id);
        if(empty($kj_id)){
            $this->error("错误页面",U('/Home/'));
        }
        else{
            $D=D('Common/KanjiaUser','VModel');
            $map['kj_id']=$kj_id;
            $rs=$D->where($map)->find();
            // print_r($rs);
        }
        if(!$rs){
            $this->error("获取信息失败，请稍后重试",U('/Home/'));
        }
        $code=I('get.code');
        //检查此用户有没有授权
        if(empty($code)){
            //没有进行授权操作跳转到授权页面
            $this->getcode($kj_id);
        }else{
            //根据code获取用户信息
            $user_info=$this->get_user_openid($code);
            if(!$user_info){
                $this->getcode($kj_id);
                die;
            }
            //获取到openid
            $openid=$user_info['openid'];
            $user_access_token=$user_info['access_token'];
            if(empty($openid)){
                $this->getcode($kj_id);
            }
            // if(empty($user_access_token)){
            //     $this->getcode($kj_id);
            // }
            // unset($user_info);
            // $user_info=$this->get_user_info($openid,$user_access_token);
            // if(!$user_info){
            //     // $this->getcode($kj_id);
            //     die;
            // }
            // print_r($user_info);
        }
        // print_r($user_info['openid']);
        // print_r($rs['openid']);die;
        if($user_info['openid']==$rs['openid']){
            $is_same=1;
        }
        else{
            $is_same=0;
        }
        $s_uid=session('_uid');
        if(!empty($s_uid)){
            if($s_uid==$rs['uid']){
                $is_same=1;
            }
        }
        // print_r($user_info);
        // print_r($rs);
        $this->is_same=$is_same;
        $this->user_info=$rs;
        // print_r($rs);
        $shengyumoney=$rs['shengyumoney'];
        $yikan=$rs['money']-$rs['shengyumoney'];
        $bl=$yikan/$rs['money'];
        $bl=$bl*100;
        if(empty($bl)){
            $bl='1';
        }
        $this->bl=$bl;
        //帮砍信息
        $D2=D('Common/BangkanUser','VModel');
        $bangkan_info=$D2->where(array('kj_id'=>$kj_id))->limit(300)->order('bk_time desc')->select();
        $bangkan_count=$D2->where(array('kj_id'=>$kj_id))->order('bk_time desc')->count();
        empty($bangkan_count)?$bangkan_count=0:$bangkan_count;
        foreach ($bangkan_info as $key => $value) {
                $bangkan_info[$key]['bk_money']=round($bangkan_info[$key]['bk_money'],0);
                $bangkan_info[$key]['mobile']=substr_replace($bangkan_info[$key]['mobile'],'****','3','4'); 
                // $bangkan_info[$key]['username']=$bangkan_info[$key]['mobile'];
        }
        // print_r($bangkan_info);
        $this->bangkan_count=$bangkan_count;
        $this->bangkan_info=$bangkan_info;
        $this->kj_id=$kj_id;
        $wx_info=C('wx_info');
        $jssdk=new Jssdk($wx_info['AppID'],$wx_info['Secret']);
        $signPackage=$jssdk->getSignPackage();
        $this->signPackage=$signPackage;
        $this->display();
    }
    /*获取code*/
    public function getcode($kj_id){
        $wx_info=C('wx_info');
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?";
        $appid=$wx_info['AppID'];
        $redirect_uri=urlencode("http://www.eyuanduobao.com/".U('index_2').'?kj_id='.$kj_id);
        // print_r($redirect_uri);die;
        //构造url
        $url=$url."appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=1&connect_redirect=1#wechat_redirect";

        //重定向url
        header("location: ".$url."");
        exit;
    }
    /*获得用户openid*/
    public function get_user_openid($code){
        //url:https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code 
        $url='https://api.weixin.qq.com/sns/oauth2/access_token';
        $wx_info=C('wx_info');
        $param=array(
                'appid'=>$wx_info['AppID'],
                'secret'=>$wx_info['Secret'],
                'code'=>$code,
                'grant_type'=>'authorization_code',
            );
        $result=get($url,$param);
        $result=json_decode($result);
        //处理object
        $result=object_array($result);

        //获取长久一点的access_token
        //url:https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=APPID&grant_type=refresh_token&refresh_token=REFRESH_TOKEN 
        $result=get("https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".$wx_info['AppID']."&grant_type=refresh_token&refresh_token=".$result['refresh_token']."");
        $result=json_decode($result);
        //处理object
        $result=object_array($result);
        //如果返回错误信息
        if(!empty($result['errcode'])){
            // $this->error('网站错误，请联系管理员'.$result['errcode'].'');
            return false;
        }
        else{
            return $result;
        }
    }
    /*拉取用户信息*/
    //这个access_token和基础配置的access_token的不一样
    public function get_user_info($openid,$access_token){
        $user_info=get('https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN');
        $user_info=json_decode($user_info);
        //处理object
        $user_info=object_array($user_info);
        // print_r($user_info);die;
        if(!empty($user_info['errcode'])){
            return false;
        }else{
           return $user_info; 
        }
    }
    /*判断这个用户有没有关注*/
    public function is_follow($openid){
        //https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
        $rs=get('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.S('access_token').'&openid='.$openid.'&lang=zh_CN');
        $rs=json_decode($rs);
        //处理object
        // print_r(S('access_token'));
        $rs=object_array($rs);
        // print_r($rs);
        if($rs['subscribe']==0){
            return false;
        }
        else{
            return true;
        }
    }
    
    /*创建临时二维码*/
    public function create_qr($openid='oyKgswCJrfs6l5Axjd7TZtcTHXt8'){
        //找到此用户的uid
        $uid=M('member')->where(array('openid'=>$openid))->limit(1)->getField('uid');
        //https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN
        //{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
        $param=array(
            'expire_seconds'=>2592000,
            'action_name'=>'QR_SCENE',
            'action_info'=>array(
                'scene'=>array(
                    'scene_id'=>$uid,
                    )
                ),
            );
        $param=json_encode($param);
        // S('access_token',null);die;
        // echo S('access_token');die;
        $rs=post('https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.S('access_token'),$param);
        $rs=json_decode($rs);
        //处理object
        $rs=object_array($rs);
        header('location:https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$rs['ticket']);
        // print_r($rs);
    }

    /*创建永久二维码*/
    public function create_fqr(){
        $param=array(
            'expire_seconds'=>2592000,
            'action_name'=>'QR_LIMIT_STR_SCENE',
            'action_info'=>array(
                'scene'=>array(
                    'scene_str'=>'kj1',
                    )
                ),
            );
        $param=json_encode($param);
        // S('access_token',null);die;
        // echo S('access_token');die;
        $rs=post('https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.S('access_token'),$param);
        $rs=json_decode($rs);
        //处理object
        $rs=object_array($rs);
        header('location:https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$rs['ticket']);
        // print_r($rs);
    }

    public function test(){
        $wx_info=C('wx_info');
        $jssdk=new Jssdk($wx_info['AppID'],$wx_info['Secret']);
        $signPackage=$jssdk->getSignPackage();
        print_r($rs);
        $this->signPackage=$signPackage;
        $this->display();
    }

    public function kj_reg(){
        if(!IS_AJAX)$this->error("非法操作");
        $data=I('post.');
        $yaoqing=M('kanjia')->where(array('kj_id'=>$data['kj_id']))->getfield('uid');
        $kanjia_info=D('Common/KanjiaUser','VModel')->where(array('kj_id'=>$data['kj_id']))->find();
        //检验手机号码有没有注册
        $is_register=M('member')->where(array('mobile'=>$data['mobile'],'is_register'=>1))->find();
        if($is_register){
            $this->ajaxReturn(array('status'=>0,'info'=>'您是老用户,只能发起活动哦~','url'=>U('/Home')));
            // $this->ajaxReturn(array('status'=>0,'info'=>'该号码已经注册'));
        }
        //校验验证码
        $yzm=M('verifycode')->where(array('mobile'=>$data['mobile']))->order('createTime desc')->find();
        if($yzm['code']!=$data['yzm']){
            $this->ajaxReturn(array('status'=>0,'info'=>'验证码错误'));
        }
        //更改验证码状态
        M('verifycode')->where(array('mobile'=>$data['mobile']))->order('createTime desc')->setField('codestatus',1);
        //随机送福分
        $rand=mt_rand(1,50);
        $add_info['mobile']=$data['mobile'];
        $add_info['password']=md5($data['password']);
        $add_info['is_register']=1;
        // $add_info['username']=$data['nickname'];
        $add_info['openid']=$data['openid'];
        $add_info['yaoqing']=$yaoqing;
        $add_info['score']=100+$rand;
        $add_info['img']="/Public/Home/images/tx/211274314672928.jpg";
        $rs=M('member')->add($add_info);
        if(!$rs){
            $this->ajaxReturn(array('status'=>0,'info'=>'网络错误，请稍后重试'));
        }
        //将用户注册进去
        $mscore = D('Home/MemberScore');
        $muid=(int)$rs;
        $resultr = $mscore->AddScoreRecord($muid,'注册赠送积分。',100);
        session("_uid", $rs);
        $user=M('member')->where(array('uid'=>$rs))->find();
        session('wxUserinfo', $user);
        //如果有邀请添加积分
        if($yaoqing>0)
        {       
            //检查邀请人的等级变化
            check_rank($yaoqing); 
            $resultr = $mscore->AddScore($yaoqing,'邀请赠送积分。',100);                   
        }
        //帮砍
        $new_array=array(
            'kj_id'=>$data['kj_id'],
            'bk_money'=>$add_info['score'],
            'bk_time'=>time(),
            'uid'=>$rs,
            );
        $bangkan_status=M('bangkan')->where(array('uid'=>$rs))->find();
        $kj_info=M('kanjia')->where(array('kj_id'=>$data['kj_id']))->find();
        // print_r($rs);die;
        if(!$bangkan_status){
            M('bangkan')->add($new_array);
            if($kanjia_info['shengyumoney']<=1){
                if($kj_info['status']==1){
                    $msg_array=array(
                        'par1'=>'1',
                        'par2'=>'午后奶茶一箱',
                        'mobile'=>$kanjia_info['mobile'],
                        'msgtype'=>'zjdx',
                        'msgtime'=>date('Y-m-d H:i:s'),
                    );
                    M('message')->add($msg_array);
                    M('kanjia')->where(array('kj_id'=>$data['kj_id']))->setField('status',2);
                    M('kanjia')->where(array('kj_id'=>$data['kj_id']))->setField('end_time',date('Y-m-d H:i:s'));
                    M('kanjia')->where(array('kj_id'=>$data['kj_id']))->setDec('shengyumoney',1);
                    M('kanjia')->where(array('kj_id'=>$data['kj_id']))->setInc('count',1);
                }
                $this->ajaxReturn(array('status'=>1,'info'=>'您的好友已经成功获得一箱午後奶茶，感谢您！3秒后可以进入商城获取福分买东西哦~','url'=>U('/Home')));
            }
            M('kanjia')->where(array('kj_id'=>$data['kj_id']))->setDec('shengyumoney',1);
            M('kanjia')->where(array('kj_id'=>$data['kj_id']))->setInc('count',1);
        }else{
            $this->ajaxReturn(array('status'=>0,'info'=>'您是老用户,只能发起活动哦~','url'=>U('/Home')));
        }
        //
        $this->ajaxReturn(array('status'=>1,'info'=>'恭喜你，成功助力您的好友，你获得了福分奖励，3秒后进入商城可以使用哦~','url'=>U('/Home')));
    }
    public function active(){
        $this->display();
    }
    public function faqi_reg(){
        if(!IS_AJAX)$this->error("非法操作");
        $data=I('post.');
        $yaoqing=M('kanjia')->where(array('kj_id'=>$data['kj_id']))->getfield('uid');
        //检验手机号码有没有注册
        $is_register=M('member')->where(array('mobile'=>$data['mobile'],'is_register'=>1))->find();
        if($is_register){
            $this->ajaxReturn(array('status'=>0,'info'=>'您是老用户,只能发起活动哦~','url'=>U('/Home')));
            // $this->ajaxReturn(array('status'=>0,'info'=>'该号码已经注册'));
        }
        //校验验证码
        $yzm=M('verifycode')->where(array('mobile'=>$data['mobile']))->order('createTime desc')->find();
        if($yzm['code']!=$data['yzm']){
            $this->ajaxReturn(array('status'=>0,'info'=>'验证码错误'));
        }
        //更改验证码状态
        M('verifycode')->where(array('mobile'=>$data['mobile']))->order('createTime desc')->setField('codestatus',1);
        //随机送福分
        $rand=mt_rand(1,50);
        $add_info['mobile']=$data['mobile'];
        $add_info['password']=md5($data['password']);
        $add_info['is_register']=1;
        $add_info['username']=$data['nickname'];
        $add_info['openid']=$data['openid'];
        $add_info['yaoqing']=$yaoqing;
        $add_info['score']=100;
        $add_info['img']="/Public/Home/images/tx/211274314672928.jpg";
        $rs=M('member')->add($add_info);
        if(!$rs){
            $this->ajaxReturn(array('status'=>0,'info'=>'网络错误，请稍后重试'));
        }
        //将用户注册进去
        $mscore = D('Home/MemberScore');
        $muid=(int)$rs;
        $resultr = $mscore->AddScoreRecord($muid,'注册赠送积分。',100);
        session("_uid", $rs);
        $user=M('member')->where(array('uid'=>$rs))->find();
        session('wxUserinfo', $user);
        $this->ajaxReturn(array('status'=>1,'info'=>'祝贺您，注册成功。关注公众号获取您的专属链接吧'));
    }
    public function active_faqi(){
        $uid=session("wxUserinfo.uid");
        // print_r($uid);die;
        if(empty($uid)){
            $this->success('您的登陆有效期已过，重新登陆方可参与活动',U('/Home/Public/login'));
            die;
        }
        //查一下这个人有没有未成功砍价的记录
        $kj_record=M('kanjia')->where(array('uid'=>$uid,'status'=>1,'type'=>3))->find();
        $openid=M('member')->where(array('uid'=>$kj_record['uid']))->getField('openid');
        $wx_id=M('wx_user')->where(array('openid'=>$openid))->getField('wx_id');

        // print_r($kj_record);die;
        if(empty($kj_record)){
            $new_array=array(
                'uid'=>$uid,
                'money'=>30,
                'shengyumoney'=>30,
                'count'=>0,
                'status'=>1,
                'time'=>time(),
                'type'=>3,
                'wx_id'=>$wx_id,
                );
            $add_status=M('kanjia')->add($new_array);
            echo "<script>window.location.href='".U('index')."?kj_id=".$add_status."'</script>";
        }else{
            echo "<script>window.location.href='".U('index')."?kj_id=".$kj_record['kj_id']."'</script>";
        }
        die;
    }
}
