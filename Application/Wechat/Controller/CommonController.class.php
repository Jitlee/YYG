<?php
namespace Wechat\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
class CommonController extends Controller {
	 protected function _initialize(){
        //S('access_token',null);
        //如果没有access_token
        if((S('at_time')+7200)<=time()){
            $wx_info=C('wx_info');
            $Auth=new WechatAuth($wx_info['AppID'],$wx_info['Secret']);
            //获取access_token
            $access_token=$Auth->getAccessToken();
            if(!empty($access_token['access_token'])){
                //保存到缓存7198秒
                S('access_token',$access_token['access_token'],7198);
                S('at_time',time());
            }
            else{
                $this->error('获取信息失败，请通知管理员');
            }
        }
        if(empty(S('access_token'))){
            $wx_info=C('wx_info');
            $Auth=new WechatAuth($wx_info['AppID'],$wx_info['Secret']);
            //获取access_token
            $access_token=$Auth->getAccessToken();
            if(!empty($access_token['access_token'])){
                //保存到缓存7198秒
                S('access_token',$access_token['access_token'],7198);
                S('at_time',time());
            }
            else{
                $this->error('获取信息失败，请通知管理员');
            }
        }
    }
	
}