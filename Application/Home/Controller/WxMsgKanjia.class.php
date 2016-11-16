<?php
namespace Home\Controller;
use Think\Controller;

 
class WxMsgKanjia
{
	/*****
	 * 	1001  放最前面，作为砍价关键字
	 * 
	 * *******/
	public function Kanjia($data, $Auth, $wechat, $WebDomain, $WebRoot)
	{
		//$wechat->replyText("当前活动已经结束，请留意最新中奖公告");
		//来源openid
        $form_openid=$data['FromUserName'];
		$mdb=D('Home/WxUser');

        $wx_id=$mdb->GetWxID($form_openid, $Auth);
		if($wx_id==-1)
		{
			$Auth->sendText($form_openid,"当前参与活动人数太多，请稍后重试...");
            exit();
		}
		          
        $len=strlen($data['EventKey']);
        if(!empty($data['EventKey']) && $len > 5){	
            $data['EventKey']=str_replace('qrscene_', '', $data['EventKey']);
            $uid=$data['EventKey'];
            $type=substr($data['EventKey'],4,2);
            $uid=substr($uid,6);
            $openid=M('member')->where(array('uid'=>$uid))->limit(1)->getField('openid');
            //找到这个砍价消息
            $D=M('kanjia');
            $kanjia_info=$D->where(array('uid'=>$uid,'type'=>$type))->find();
            if(empty($kanjia_info)){
                $wechat->replyText("系统错误，找不到此砍价信息！$uid | $type |");
                exit();
            }
			//获取砍价相关信息
			$mkjp=D('Home/Kanjia');
			$kjobject=$mkjp->GetByidPara($kanjia_info['kj_id']);
			$shengyuprizenum=(int)$kjobject["shengyuprizenum"];
			$prizenum=(int)$kjobject["prizenum"];
			if($shengyuprizenum<=0)
			{
				$wechat->replyText("当前活动已经结束，请留意最新中奖公告。".$shengyuprizenum);
                exit();
			}        
            $is_bangkan=M('bangkan')->where(array('wx_id'=>$wx_id))->find();
            if($is_bangkan){
                //判断是否注册用户
                //如果是注册用户可以再砍一次
                $is_register=M('member')->where(array('openid'=>$form_openid))->find();
                if(empty($is_register)){
                    $wechat->replyText("/玫瑰 注册成为会员并通过微信登陆即可帮ta再砍一刀哦！");
                    exit();
                }
                if($is_register['is_kan']){
                   $wechat->replyText("/玫瑰 1.关注微信\n/玫瑰 2.注册成为会员\n以上2种方法都可以帮ta砍一次哦~\n或点击右上角“...”->“发送给朋友”让您的小伙伴来帮忙吧~\nps：注册还可以免费抽iphone7哦~");
                   exit();
                }
                else{
                    M('member')->where(array('uid'=>$is_register['uid']))->setField('is_kan',1);
                }
            }
            //计算砍价金额
            $shengyumoney=$kanjia_info['shengyumoney'];
            if($shengyumoney==0)
			{
				$wechat->replyText("您的好友已经获得话费，您也快快点击下边菜单“免费话费”领取话费吧！！");
                exit();
			}                            
            $type=$kanjia_info['type'];
			$money=$kanjia_info['money'];			
            $mkj=D('Home/Kanjia');
			$add_money=$mkj->GetAddMoney($type, $money, $shengyumoney);
			
			
//          if($shengyumoney<=50){
//              $wechat->replyText("当前活动已经结束，请留意最新中奖公告");
//              exit();
//          }
			if($shengyumoney< $add_money)
			{
				$add_money=$shengyumoney;
			}
            //保存砍价记录
            if(empty($wx_id)){
                $wechat->replyText("当前参与活动人数太多，请稍后重试.");
                exit();
            }
            $bangkan_add=array(
                'wx_id'=>$wx_id,
                'kj_id'=>$kanjia_info['kj_id'],
                'bk_money'=>$add_money,
                'bk_time'=>time(),
            );
			//砍完了
			$ZhongPara=null;
			$ZhongJNum=0;
			if($add_money==$shengyumoney){
				$ZhongPara= $mkjp->GetZhongPara($type,$openid);//补充信息				
				$ZhongPara["kj_id"]=$kanjia_info['kj_id'];				 
				$ZhongPara["openid"]=$openid;				
				
				
			}
				
            //开启事务
            M()->startTrans();
            //保存帮砍信息
            $add_status=M('bangkan')->add($bangkan_add);
            //更新砍主信息
            $save_status=M('kanjia')->where(array('kj_id'=>$kanjia_info['kj_id']))->setField('shengyumoney',round($shengyumoney-$add_money,2));
			//添加中奖人	 更新中奖参数  剩余人数
			$add_ZhongParaStatus=TRUE;
			$save_kanjiaparastatus=TRUE;
			if($add_money==$shengyumoney){				
				$add_ZhongParaStatus=M('kanzhong')->add($ZhongPara);
				$ZhongJNum= $mkjp->GetZhongJ($type);
				$rszj=$prizenum-$ZhongJNum;
				if($rszj <0)
				{
					$rszj=0;
				}
				$save_kanjiaparastatus=M('kanjia_para')->where(array('kjcode'=>$type))->setField('shengyuprizenum',$rszj);				
			}
			
			//获取来源者信息
            $form=$Auth->userInfo($form_openid);
            $rs=$Auth->userInfo($openid);
			
            M('kanjia')->where(array('kj_id'=>$kanjia_info['kj_id']))->setINC('count',1);
            if($add_status&&$save_status && $add_ZhongParaStatus){
                M()->commit();
				
				//通知中奖人    KJNotify($username, $openid, $mobile, $goodsname) {
				if($add_money==$shengyumoney){		
					$wxm= new WxNotify();
					$result=$wxm->KJNotify($form['nickname'],$openid,'','10元话费');
				}
            }
            else{
                M()->rollback();
                $wechat->replyText("当前参与活动人数太多，请稍后重试..");
                exit();
            }
            
            //发送消息给砍主
            $Auth->sendText($openid,'您的好友“'.$form['nickname'].'”\n帮您砍下了'.$add_money.'元，快去答谢他（她）吧/示爱');
            $wechat->replyText("您刚刚帮助您的好友[".$rs['nickname']."]砍了".$add_money."元");
        }
        $wechat->replyText('哟呵~主子终于等到你，还好我没放屁啊！/示爱/示爱/示爱
欢迎来到【壹易购物】王国游戏王国待会就更新啦，更多消息，请留意我们的微信公众号
请直接点击底部菜单，尽情购物吧！/玫瑰/玫瑰/玫瑰');
		
	}
	
	/******参与活动*****/
	public function KanjiaCommin($data, $Auth, $wechat, $WebDomain, $WebRoot)
	{
//		logger("/**************1******************/");		
        $form_openid=$data['FromUserName'];
		$openid=$form_openid+'';
		$mdb=D('Home/WxUser');
        $wx_id=$mdb->GetWxID($form_openid, $Auth);
		if($wx_id==-1)
		{
			$Auth->sendText($form_openid,"当前参与活动人数太多，请稍后重试...");
            exit();
		}
		$mkjp=D('Home/Kanjia');
		
		$EventKey=$data['EventKey'];		 
        $len=strlen($data['EventKey']);
        if(!empty($data['EventKey']) && $len > 5)
        {
        	$type=substr($EventKey,4,2);
			$kjcode=$type;
			
            $uid=M('member')->where(array('openid'=>$form_openid))->limit(1)->getField('uid');			
			if(empty($uid))//没有注册
			{
            	vendor('Weixinpay.WxPayJsApiPay');
				$appid =  \WxPayConfig::APPID;
                
				$newspara=$mkjp->GetNewsPara('reg',$kjcode, $WebDomain ,$kj_id,$appid);
                $wechat->replyNewsOnce($newspara["title"],$newspara["discription"],$newspara["url"],$newspara["picurl"]);//发送活动
                exit;
			}
			
            //找到这个砍价消息
            $D=M('kanjia');
            $kanjia_info=$D->where(array('uid'=>$uid,'type'=>$type))->find();
            if(empty($kanjia_info))
            {
                 //添加砍价信息                
                $qr_url=$this->create_qr($openid,$kjcode);
				//保存砍价信息
				$mkj=D('Home/Kanjia');
				$kj_id=$mkj->Insert($uid, $wx_id, $qr_url ,$kjcode);
				 
                if($kj_id){
					$newspara=$mkjp->GetNewsPara('news',$kjcode, $WebRoot ,$kj_id);
                    $wechat->replyNewsOnce($newspara["title"],$newspara["discription"],$newspara["url"],$newspara["picurl"]);//发送活动
                }
                else{
                    $Auth->sendText($openid,"当前参与活动人数太多，请稍后重试");
                }
                exit();
            }
			else //发送原来砍价活动
			{		
				//获取砍价相关信息				
				$kjobject=$mkjp->GetKJPareBytype($kjcode);
				$shengyuprizenum=(int)$kjobject["shengyuprizenum"];
				$prizenum=(int)$kjobject["prizenum"];
				if($shengyuprizenum<=0)
				{
					$wechat->replyText("当前活动已经结束，请留意最新中奖公告。".$shengyuprizenum);
	                exit();
				}
				$kj_id=$kanjia_info["kj_id"];
				$newspara=$mkjp->GetNewsPara('news',$kjcode, $WebRoot ,$kj_id);
                $wechat->replyNewsOnce($newspara["title"],$newspara["discription"],$newspara["url"],$newspara["picurl"]);
                exit();				
			}
      }		
	}
	
	public function RegCommin($data, $Auth, $wechat, $WebDomain, $WebRoot)
	{
		 $form_openid=$data['FromUserName'];
		$openid=$form_openid+'';
		$mdb=D('Home/WxUser');
        $wx_id=$mdb->GetWxID($openid, $Auth);
		if($wx_id==-1)
		{
			$Auth->sendText($openid,"当前参与活动人数太多，请稍后重试...");
            exit();
		}
		vendor('Weixinpay.WxPayJsApiPay');
		$appid =  \WxPayConfig::APPID;
				
        $mkjp=D('Home/Kanjia');
        $newspara=array(
			'status'=> 0,
			'title'=>"点击注册",
			"discription"=>"只需几步即可完成注册,新鲜玩法，三级提成，坐享收益，一元实现你的汽车梦。",
			"url"=>"http://yiyigw.cn/index.php/Home/Public/reg",
			"picurl"=>"http://pic.qiantucdn.com/58pic/18/32/60/10c58PICXbP_1024.jpg"
		);
		//"url"="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=http%3A%2F%2F$WebRoot%2Findex.php%2FHome%2FPublic%2Freg&response_type=code&scope=snsapi_base&state=STATE",
        $wechat->replyNewsOnce($newspara["title"],$newspara["discription"],$newspara["url"],$newspara["picurl"]);//发送活动
        exit();	
	}
	
	public function KanjiaClick($data, $Auth, $wechat, $WebDomain, $WebRoot)
	{
		//判断是否已经注册
        $openid=$data['FromUserName'];
		//*保存砍主信息
        //找到砍主id
        $mdb=D('Home/WxUser');
        $wx_id=$mdb->GetWxID($openid, $Auth);
		if($wx_id==-1)
		{
			$Auth->sendText($openid,"当前参与活动人数太多，请稍后重试...");
            exit();
		}
		
		$posindex=stripos($data['EventKey'],"kj");		
	    if($posindex >= 0){
	    	$kjcode=str_replace("kj","",$data['EventKey']);
	    	$user_info=M('member')->where(array('openid'=>$openid))->find();
	        // $Auth->sendText($openid,$openid);
	        if(empty($user_info)){
//	            $back=$Auth->sendText($openid,"您还未注册/未绑定微信 \d 请点击下面链接进行注册或登陆绑定");
//	            if($back){
	            	vendor('Weixinpay.WxPayJsApiPay');
					$appid =  \WxPayConfig::APPID;
	                $mkjp=D('Home/Kanjia');
					$newspara=$mkjp->GetNewsPara('reg',$kjcode, $WebDomain ,$kj_id,$appid);
	                $wechat->replyNewsOnce($newspara["title"],$newspara["discription"],$newspara["url"],$newspara["picurl"]);//发送活动
	                exit;
//	            }
	        }
		
	    	try
			{
	                //判断砍主是否已经曾经参与
	                $kj_id=M('kanjia')->where(array('uid'=>$user_info['uid'],'type'=>$kjcode))->getField('kj_id');
	                if($kj_id>0){
	                	$mkjp=D('Home/Kanjia');
						$newspara=$mkjp->GetNewsPara('news',$kjcode, $WebRoot ,$kj_id);
	                    $wechat->replyNewsOnce($newspara["title"],$newspara["discription"],$newspara["url"],$newspara["picurl"]);
	                    exit();
	                }	               
	                
	                // 如果没有获取到该砍主的微信信息
	                $uid=$user_info['uid'];
	                $qr_url=$this->create_qr($openid,$kjcode);
					//保存砍价信息
					$mkj=D('Home/Kanjia');
					$kj_id=$mkj->Insert($uid, $wx_id, $qr_url ,$kjcode);
					 
	                if($kj_id){
	                  	$mkjp=D('Home/Kanjia');
						$newspara=$mkjp->GetNewsPara('news',$kjcode, $WebRoot ,$kj_id);
	                    $wechat->replyNewsOnce($newspara["title"],$newspara["discription"],$newspara["url"],$newspara["picurl"]);//发送活动
	                }
	                else{
	                    $Auth->sendText($openid,"当前参与活动人数太多，请稍后重试");
	                }
			}
			catch (Exception $e) {
				$Auth->sendText($openid,$e->getMessage());
			} 
	    } 
 
	}

	/*创建临时二维码*/
    public function create_qr($openid='',$type,$dotype='1001'){
        //找到此用户的uid
        $uid=M('member')->where(array('openid'=>$openid))->limit(1)->getField('uid');
        $uid=$dotype.$type.$uid;
        //https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN
        //{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
        $param=array(
            'expire_seconds'=>2592000,
            'action_name'=>'QR_LIMIT_STR_SCENE',
            'action_info'=>array(
                'scene'=>array(
                    'scene_str'=>$uid,
                    )
                ),
        );
        $param=json_encode($param);
        
		$wxmsg=new WxUserInfo();
		$access_token=$wxmsg->accessToken();		
        $rs=post('https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token,$param);
        $rs=json_decode($rs);
        //处理object
        $rs=object_array($rs);
        return ('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$rs['ticket']);
    } 

}
