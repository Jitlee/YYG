<?php
namespace Home\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
use Com\Jssdk;
 
class WxmsgController extends Controller {
    public function index()
    {
//      traceHttp();
		$token = 'token'; //微信后台填写的TOKEN
	        //调试
         
            if (isset($_GET['echostr'])) {
			    $this->valid();
			}else{
	            //$this->responseMsg();
	            vendor('Weixinpay.WxPayJsApiPay');
				$appid =  \WxPayConfig::APPID;
				$crypt = \WxPayConfig::APPSECRET;
	            
	            /* 加载微信SDK */
	            $wechat = new Wechat($token, $appid, $crypt);
	            
	            /* 获取请求信息 */
	            $data = $wechat->request();
				
	            if($data && is_array($data))
	            {
	                /**
	                 * 你可以在这里分析数据，决定要返回给用户什么样的信息
	                 * 接受到的信息类型有10种，分别使用下面10个常量标识
	                 * Wechat::MSG_TYPE_TEXT       //文本消息
	                 * Wechat::MSG_TYPE_IMAGE      //图片消息
	                 * Wechat::MSG_TYPE_VOICE      //音频消息
	                 * Wechat::MSG_TYPE_VIDEO      //视频消息
	                 * Wechat::MSG_TYPE_SHORTVIDEO //视频消息
	                 * Wechat::MSG_TYPE_MUSIC      //音乐消息
	                 * Wechat::MSG_TYPE_NEWS       //图文消息（推送过来的应该不存在这种类型，但是可以给用户回复该类型消息）
	                 * Wechat::MSG_TYPE_LOCATION   //位置消息
	                 * Wechat::MSG_TYPE_LINK       //连接消息
	                 * Wechat::MSG_TYPE_EVENT      //事件消息
	                 *
	                 * 事件消息又分为下面五种
	                 * Wechat::MSG_EVENT_SUBSCRIBE    //订阅
	                 * Wechat::MSG_EVENT_UNSUBSCRIBE  //取消订阅
	                 * Wechat::MSG_EVENT_SCAN         //二维码扫描
	                 * Wechat::MSG_EVENT_LOCATION     //报告位置
	                 * Wechat::MSG_EVENT_CLICK        //菜单点击
	                 */
	
	                //记录微信推送过来的数据
//	                file_put_contents('./data.json', json_encode($data));
	
	                /* 响应当前请求(自动回复) */
	                //$wechat->response($content, $type);
	
	                /**
	                 * 响应当前请求还有以下方法可以使用
	                 * 具体参数格式说明请参考文档
	                 * 
	                 * $wechat->replyText($text); //回复文本消息
	                 * $wechat->replyImage($media_id); //回复图片消息
	                 * $wechat->replyVoice($media_id); //回复音频消息
	                 * $wechat->replyVideo($media_id, $title, $discription); //回复视频消息
	                 * $wechat->replyMusic($title, $discription, $musicurl, $hqmusicurl, $thumb_media_id); //回复音乐消息
	                 * $wechat->replyNews($news, $news1, $news2, $news3); //回复多条图文消息
	                 * $wechat->replyNewsOnce($title, $discription, $url, $picurl); //回复单条图文消息
	                 * 
	                 */
	                
	                //执行Demo
	                $this->demo($wechat, $data);
                }
            }			
    }
	
	private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
		 
        $token = "token";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1($tmpStr );

//		logger("/**************$tmpStr******************/");
//		logger("/**************$signature******************/");
		
        if( $tmpStr == $signature )
        {
            return true;
        }else{
            	echo "$tmpStr == $signature"; 
            return false;			
        }
    }
	
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	ob_clean();
            echo $echoStr;
            exit;
        }
    }
		
	/**
     * DEMO
     * @param  Object $wechat Wechat对象
     * @param  array  $data   接受到微信推送的消息
     */
    private function demo($wechat, $data){
        vendor('Weixinpay.WxPayJsApiPay');
		$appid =  \WxPayConfig::APPID;
		$appsecret = \WxPayConfig::APPSECRET;
		$wxmsg=new WxUserInfo();
		$access_token=$wxmsg->accessToken();
		/*		*/
		$WebDomain="yiyigw.cn";
		$WebRoot="http://$WebDomain";
		 
		
		 
        $Auth=new WechatAuth($appid,$appsecret,$access_token);
		/*$wechat->replyText("亲，想参与最新0元砍价活动。请点击下方菜单");
		break;*/
		 $len=strlen($data['EventKey']);
		 $eventkey="";
        if(!empty($data['EventKey']) && $len > 4){
        		$eventkey=str_replace('qrscene_','',$data['EventKey']);
        		$eventkey=substr($eventkey,0,4);
		}
		$temp=$data['EventKey'];
//		logger("/**************eventkey=$eventkey***len=$len****temp=$temp***********/");	
		$replyText="嘿！一不小心我们就成为了微信好友啦，小易在这里恭候多时，从现在开始您可以随时随地享受1易购物微信用户专享服务！请直接点击底部菜单，畅享一元购！，最新活动:免费话费，请点击下方菜单开始";
        $bk1=new WxMsgKanjia();
        switch ($data['MsgType']) {
            case Wechat::MSG_TYPE_EVENT:
                switch ($data['Event']) {
                    case Wechat::MSG_EVENT_SUBSCRIBE:
	    				if($eventkey == '1001'){
							$bk1->Kanjia($data, $Auth, $wechat, $WebDomain, $WebRoot);
						}
						else if($eventkey == '7777'){
							$bk1->KanjiaCommin($data, $Auth, $wechat, $WebDomain, $WebRoot);
						}
						else if($eventkey == '7778'){	//注册时强制关注
							$wechat->replyText($replyText.'。');
							$bk1->RegCommin($data, $Auth, $wechat, $WebDomain, $WebRoot);
						}
						else
						{
							$wechat->replyText($replyText."。。");
						} 

                        break;

                    case Wechat::MSG_EVENT_UNSUBSCRIBE:
                        //取消关注，记录日志
                        break;
                    	
                    case 'SCAN'://通过分享出去的扫码事件
                    	if($eventkey == '1001'){
							$bk1->Kanjia($data, $Auth, $wechat, $WebDomain, $WebRoot);
						}
						else if($eventkey == '7777'){
							$bk1->KanjiaCommin($data, $Auth, $wechat, $WebDomain, $WebRoot);
						}
						else if($eventkey == '7778'){	//注册时强制关注
							$wechat->replyText($replyText.'。。。');
							$bk1->RegCommin($data, $Auth, $wechat, $WebDomain, $WebRoot);							
						}
                        break;
                    case "CLICK":
							$posindex=stripos($data['EventKey'],"kj");
	    					if($posindex >= 0){
								$bk1->KanjiaClick($data, $Auth, $wechat, $WebDomain, $WebRoot);
							}
                            break;
                    default:
                        $wechat->replyText($replyText.'');
                        break;
                }
                break;
            case Wechat::MSG_TYPE_TEXT:
                switch ($data['Content']) {
                    case '联系我们':
                        $wechat->replyText('在这个平台里，你的事就是我的事啦、/得意
那我将有什么事情还没解决的呢？/可爱 你可以在这里给我们发信息，我们会在工作时间回复您的。/亲亲/玫瑰/玫瑰/玫瑰');
                        break;
                    case '图文'://回复单条图文消息
                        break;
                        $wechat->replyNews($news, $news, $news, $news, $news);
                        break;                    
                    default:
                        $wechat->replyText("(●˘◡˘●) 想参与最新活动吗？\n\n /玫瑰 免费领取话费\n\n 点击下方菜单\n->[免费话费]参与活动吧！");
                        break;
                }
                break;
            default:
                $wechat->replyText("亲，我还不知道你说的啥呢？");
                break;
        }
    }
		
		
	/*构造菜单*/
    public function create_menu(){
		$wxmsg=new WxUserInfo();
		$access_token=$wxmsg->accessToken();		 
        //数据结构
		$WebRoot="http://yiyigw.cn";
        $array['button'][0]=array(
            'name'=>'发现壹易',
            'sub_button'=>array(
                	array(
                        'type' => 'view',
                        'name' => '一元易购 ',
                        'url' => "$WebRoot/index.php/Home",
                    ),
                    array(
                        'type' => 'view',
                        'name' => '了解易购 ',
                        'url' => "$WebRoot/index.php/Home/About/about",
                    ), 
                    array(
                        'type' => 'view',
                        'name' => '所有商品 ',
                        'url' => "$WebRoot/index.php/Home/Index/all",
                    ),  
                ), 
            );
        $array['button'][1]=array(
            	'name'=>'免费话费',
				'type' => 'click',
				'key' => 'kj91',
            );
			 
         $array['button'][2]=array(
            'name'=>'我的',
            'sub_button'=>array(
                array(
                        'type' => 'view',
                        'name' => '个人中心',
                        'url' => "$WebRoot/index.php/Home/Person/me",
                    ),
                array(
                        'type' => 'view',
                        'name' => '购物记录',
                        'url' => "$WebRoot/index.php/Home/Person/miaosharecord",
                    ),
                   
                    array(
                        'type' => 'view',
                        'name' => '了解易购',
                        'url' => "$WebRoot/index.php/Home/Problem/index",
                    ),
                     array(
                        'type' => 'view',
                        'name' => '邀请赚钱',
                        'url' => "$WebRoot/index.php/Home/Person/yaoqingmain",
                    ),
                ),
            ); 
		 
        $data=json_encode($array,JSON_UNESCAPED_UNICODE); 
		header("Content-Type: text/html; charset=UTF-8");
        $rs=post('https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token,$data);
        print_r($rs);
		exit;
    }

//array(
//                      'type' => 'click',
//                      'name' => '联系我们',
//                      'key' => "introduct",
//                  ),
    //获取菜单
    public function menu(){
        vendor('Weixinpay.WxPayJsApiPay');
		$appid =  \WxPayConfig::APPID;
		$appsecret = \WxPayConfig::APPSECRET;
		$wxmsg=new WxUserInfo();
		$access_token=$wxmsg->accessToken();
		 
        $Auth=new WechatAuth($appid,$appsecret,$access_token);
        $rs=$Auth->menuGet();
        print_r($rs); 
    }
    //删除菜单
    public function menudel(){
        vendor('Weixinpay.WxPayJsApiPay');
		$appid =  \WxPayConfig::APPID;
		$appsecret = \WxPayConfig::APPSECRET;
		$wxmsg=new WxUserInfo();
		$access_token=$wxmsg->accessToken();
		
        
        $Auth=new WechatAuth($appid,$appsecret,$access_token);
        $rs=$Auth->menuDelete();
        print_r($rs);
    }
		
   public function test($type){

        header("Content-type:text/html;charset=utf-8");
        set_time_limit (0);//   //设置程序最大执行时间为无限  0为无限制
        ini_set('max_execution_time', '0');//设置最大执行时间  0为不限时
        $map = array("type"=> $type);
        $area=M('kanjiarule')->where($map)->order('kjr_yikan ASC')->select();
		$dbjkp = M('kanjia_para');
		$kjpara= $dbjkp->where("kjcode='".$type."'")->find();
		
        //计算已砍比例
        $money=$kjpara["money"];
		$m=$money;
		 echo "总砍价金额".$kjpara["money"]."<br>";
        $a=0;
        while($m>=0.1){
            $yikan=$money-$m;
            $yikan_bl=round(($yikan/$money*100),2);
            //找到它所在的区间
            $mkj=D('Home/Kanjia');
			$add_money=$mkj->GetAddMoney($type, $money, $m);
			if($add_money>$m)
			{
				$add_money=$m;
			}
            $a++;
            echo "第 $a 刀<br>";
            echo "当前金额：$m <br>";
            echo "砍掉金额".$add_money."<br>";
            $m=round($m-$add_money,2);
            ob_flush();
            flush();
            echo "剩余金额".$m."<br>";
            echo "=============<br>";
        }
        echo "@@@@@@@@@@@@@<br>";
        echo "一共砍了 $a 刀<br>";
        echo "@@@@@@@@@@@@@<br>";
    }
		

}
 