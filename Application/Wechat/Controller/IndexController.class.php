<?php
namespace Wechat\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;

class IndexController extends CommonController{
    /**
     * 微信消息接口入口
     * 所有发送到微信的消息都会推送到该操作
     * 所以，微信公众平台后台填写的api地址则为该操作的访问地址
     */
    public function index($id = ''){
        define('APP_DEBUG', false);
        define('ENGINE_NAME','sae');
        //调试
        try{
            $appid = 'wx1b4f89570d3f4976'; //AppID(应用ID)
            $token = 'kenkenken'; //微信后台填写的TOKEN
            $crypt = 'vYJqlXzY8sWgw8QfiIVECnYSpCLI4Y0nRnSogB9fYP2'; //消息加密KEY（EncodingAESKey）
            
            /* 加载微信SDK */
            $wechat = new Wechat($token, $appid, $crypt);
            
            /* 获取请求信息 */
            $data = $wechat->request();

            if($data && is_array($data)){
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
                file_put_contents('./data.json', json_encode($data));

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
        } catch(\Exception $e){
            file_put_contents('./error.json', json_encode($e->getMessage()));
        }
        
    }

    /**
     * DEMO
     * @param  Object $wechat Wechat对象
     * @param  array  $data   接受到微信推送的消息
     */
    private function demo($wechat, $data){
        $wx_info=C('wx_info');
        $Auth=new WechatAuth($wx_info['AppID'],$wx_info['Secret'],S('access_token'));
        switch ($data['MsgType']) {
            case Wechat::MSG_TYPE_EVENT:
                switch ($data['Event']) {
                    case Wechat::MSG_EVENT_SUBSCRIBE:
                        //来源openid
                        $form_openid=$data['FromUserName'];
                        //获取来源者信息
                        $form=$Auth->userInfo($form_openid);
                        //保存关注者信息
                        if(!M('wx_user')->where(array('openid'=>$form['openid']))->Find()){
                            // M('wx_user')->where(array('openid'=>$form['openid']))->delete();
                            M('wx_user')->add($form);
                        }
                        $wechat->replyText('哟呵~主子终于等到你，还好我没放屁啊！/示爱/示爱/示爱
欢迎来到【壹易购物】王国游戏王国待会就更新啦，更多消息，请留意我们的微信公众号和新浪微博
请直接点击底部菜单，尽情购物吧！/玫瑰/玫瑰/玫瑰');
                        break;

                    case Wechat::MSG_EVENT_UNSUBSCRIBE:
                        //取消关注，记录日志
                        break;
                    //通过分享出去的扫码事件
                    case 'SCAN':
                            $wechat->replyText("点击下方菜单【免费奶茶】可以参与活动哦~");
                        break;
                    case "CLICK":
                            if($data['EventKey']=="联系我们"){
                                $wechat->replyText('在这个平台里，你的事就是我的事啦、/得意
那我将有什么事情还没解决的呢？/可爱 你可以在这里给我们发信息，我们会在工作时间回复您的。/亲亲也可以拨打电话：400-671-6080 /玫瑰/玫瑰/玫瑰');
                            }elseif($data['EventKey']=="naicha"){
                                 //检测此用户有没有注册
                                $openid=$data['FromUserName'];
                                $user_info=M('member')->where(array('openid'=>$openid))->find();
                                if(!$user_info){
                                    $Auth->sendText($openid,"您还未注册或未绑定微信 \n\n /玫瑰<a href='http://www.eyuanduobao.com/index.php/Home/Public/login'>请点击点击此处进行登陆</a>\n");
                                    exit();
                                }
                                //查一下这个人有没有未成功砍价的记录
                                $kj_record=M('kanjia')->where(array('uid'=>$user_info['uid'],'status'=>1,'type'=>3))->find();

                                $count=M('kanjia')->where(array('uid'=>$user_info['uid'],'shengyumoney'=>0,'type'=>3))->count();
                                if($count>=1){
                                    $Auth->sendText($openid,"您已经成功参与并曾成功获得".$count."箱午後奶茶，再接再厉哦~");
                                }
                                //查这个人的wx_id
                                $wx_id=M('wx_user')->where(array('openid'=>$openid))->getField('wx_id');
                                if(empty($wx_id)){
                                    $form=$Auth->userInfo($openid);
                                    //保存关注者信息
                                    if(!M('wx_user')->where(array('openid'=>$openid))->Find()){
                                        // M('wx_user')->where(array('openid'=>$form['openid']))->delete();
                                        $wx_id=M('wx_user')->add($form);
                                    }
                                }
                                if($kj_record){
                                    //查看kj_id
                                    $Auth->sendText($openid,"转发您的专属链接即可邀请好友帮你助力获取午後奶茶哦~");
                                    $wechat->replyNewsOnce(
                                        "邀请好友即可获得一箱奶茶！",//title
                                        "此链接为您的专属链接，转发邀请好友帮你获得奶茶一箱", //subtitle
                                        "http://www.eyuanduobao.com/index.php/Wechat/kanjia/index?kj_id=".$kj_record['kj_id'],//链接     
                                        "http://www.eyuanduobao.com/Public/images/wuhounaicha_banner.jpg"
                                    );   
                                }
                                else{
                                    $new_array=array(
                                        'uid'=>$user_info['uid'],
                                        'money'=>30,
                                        'shengyumoney'=>30,
                                        'count'=>0,
                                        'status'=>1,
                                        'time'=>time(),
                                        'type'=>3,
                                        'wx_id'=>$wx_id,
                                        );
                                    $add_status=M('kanjia')->add($new_array);
                                    if($add_status){
                                        // $wechat->replyText("您的kj_id=".$add_status);
                                        $Auth->sendText($openid,"转发您的专属链接即可邀请好友帮你助力获取午後奶茶哦~");
                                        $wechat->replyNewsOnce(
                                        "邀请好友即可获得一箱奶茶！",//title
                                        "此链接为您的专属链接，转发邀请好友帮你获得奶茶一箱", //subtitle
                                        "http://www.eyuanduobao.com/index.php/Wechat/kanjia/index?kj_id=".$add_status,//链接     
                                        "http://www.eyuanduobao.com/Public/images/wuhounaicha_banner.jpg"
                                    );   
                                    }else{
                                        $wechat->replyText("系统有误，请联系管理员");
                                    }
                                }
                                exit();
                            }
                            else{
                                $wechat->replyText("亲，想参与最新0元砍价活动。请点击下方菜单");
                            }
                            break;
                    default:
                        
                        $wechat->replyText("亲，想参与最新0元砍价活动。请点击下方菜单");
                        break;
                }
                break;

            case Wechat::MSG_TYPE_TEXT:
                switch ($data['Content']) {
                    case '联系我们':
                        $wechat->replyText('在这个平台里，你的事就是我的事啦、/得意
那我将有什么事情还没解决的呢？/可爱 你可以在这里给我们发信息，我们会在工作时间回复您的。/亲亲也可以拨打电话：400-671-6080 /玫瑰/玫瑰/玫瑰');
                        break;
                    case '注册':
                        $wechat->replyNewsOnce(
                            "点击注册送福气！",
                            "只需几步即可完成注册", 
                            // "http://www.eyuanduobao.com/index.php/Home/Public/reg",
                            "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b4f89570d3f4976&redirect_uri=http%3A%2F%2Fwww.eyuanduobao.com%2Findex.php%2FHome%2FPerson%2Fme&response_type=code&scope=snsapi_base&state=STATE",
                            "http://pic.qiantucdn.com/58pic/18/32/60/10c58PICXbP_1024.jpg"
                        );  
                        break;
                    case '活动':
                        $wechat->replyText("/玫瑰 点击下方菜单【免费奶茶】\n\n 免费品尝午后奶茶一箱，活动真实有效！");  
                        break;
                    case '投票':
                        $wechat->replyText("/玫瑰 点击下方菜单【免费奶茶】\n\n 免费品尝午后奶茶一箱，活动真实有效！");  
                        break;
                    case '砍价':
                        $wechat->replyText("/玫瑰 点击下方菜单【免费奶茶】\n\n 免费品尝午后奶茶一箱，活动真实有效！");  
                        break;
                    case '参与活动':
                        $wechat->replyText("/玫瑰 点击下方菜单【免费奶茶】\n\n 免费品尝午后奶茶一箱，活动真实有效！");  
                        break;
                    case '我要参与':
                        $wechat->replyText("/玫瑰 点击下方菜单【免费奶茶】\n\n 免费品尝午后奶茶一箱，活动真实有效！");  
                        break;
                    // case '图片':
                    //     $media_id = $this->upload('image');
                    //     $media_id = '1J03FqvqN_jWX6xe8F-VJr7QHVTQsJBS6x4uwKuzyLE';
                    //     $wechat->replyImage($media_id);
                    //     break;

                    // case '语音':
                    //     //$media_id = $this->upload('voice');
                    //     $media_id = '1J03FqvqN_jWX6xe8F-VJgisW3vE28MpNljNnUeD3Pc';
                    //     $wechat->replyVoice($media_id);
                    //     break;

                    // case '视频':
                    //     //$media_id = $this->upload('video');
                    //     $media_id = '1J03FqvqN_jWX6xe8F-VJn9Qv0O96rcQgITYPxEIXiQ';
                    //     $wechat->replyVideo($media_id, '视频标题', '视频描述信息。。。');
                    //     break;

                    // case '音乐':
                    //     //$thumb_media_id = $this->upload('thumb');
                    //     $thumb_media_id = '1J03FqvqN_jWX6xe8F-VJrjYzcBAhhglm48EhwNoBLA';
                    //     $wechat->replyMusic(
                    //         'Wakawaka!', 
                    //         'Shakira - Waka Waka, MaxRNB - Your first R/Hiphop source', 
                    //         'http://wechat.zjzit.cn/Public/music.mp3', 
                    //         'http://wechat.zjzit.cn/Public/music.mp3', 
                    //         $thumb_media_id
                    //     ); //回复音乐消息
                    //     break;

                    case '奶茶'://回复单条图文消息
                            //检测此用户有没有注册
                            $openid=$data['FromUserName'];
                            $user_info=M('member')->where(array('openid'=>$openid))->find();
                            if(!$user_info){
                                $Auth->sendText($openid,"您还未注册或未绑定微信 \n\n /玫瑰<a href='http://www.eyuanduobao.com/index.php/Home/Public/login'>请点击点击此处进行登陆</a>\n");
                                exit();
                            }
                            // $Auth->sendText($openid,$user_info['uid']);die;
                            //查一下这个人有没有未成功砍价的记录
                            $kj_record=M('kanjia')->where(array('uid'=>$user_info['uid'],'status'=>1,'type'=>3))->find();

                            $count=M('kanjia')->where(array('uid'=>$user_info['uid'],'shengyumoney'=>0,'type'=>3))->count();
                            if($count>=1){
                                $Auth->sendText($openid,"您已经成功参与并曾成功获得".$count."箱午後奶茶，再接再厉哦~");
                            }
                            //查这个人的wx_id
                            $wx_id=M('wx_user')->where(array('openid'=>$openid))->getField('wx_id');
                            if(empty($wx_id)){
                                $form=$Auth->userInfo($openid);
                                //保存关注者信息
                                if(!M('wx_user')->where(array('openid'=>$openid))->Find()){
                                    // M('wx_user')->where(array('openid'=>$form['openid']))->delete();
                                    $wx_id=M('wx_user')->add($form);
                                }
                            }
                            if($kj_record){
                                //查看kj_id
                                $Auth->sendText($openid,"转发您的专属链接即可邀请好友帮你助力获取午後奶茶哦~");
                                $wechat->replyNewsOnce(
                                    "邀请好友即可获得一箱奶茶！",//title
                                    "此链接为您的专属链接，转发邀请好友帮你获得奶茶一箱", //subtitle
                                    "http://www.eyuanduobao.com/index.php/Wechat/kanjia/index?kj_id=".$kj_record['kj_id'],//链接     
                                    "http://www.eyuanduobao.com/Public/images/wuhounaicha_banner.jpg"
                                );   
                            }
                            else{
                                $new_array=array(
                                    'uid'=>$user_info['uid'],
                                    'money'=>30,
                                    'shengyumoney'=>30,
                                    'count'=>0,
                                    'status'=>1,
                                    'time'=>time(),
                                    'type'=>3,
                                    'wx_id'=>$wx_id,
                                    );
                                $add_status=M('kanjia')->add($new_array);
                                if($add_status){
                                    // $wechat->replyText("您的kj_id=".$add_status);
                                    $Auth->sendText($openid,"转发您的专属链接即可邀请好友帮你助力获取午後奶茶哦~");
                                    $wechat->replyNewsOnce(
                                    "邀请好友即可获得一箱奶茶！",//title
                                    "此链接为您的专属链接，转发邀请好友帮你获得奶茶一箱", //subtitle
                                    "http://www.eyuanduobao.com/index.php/Wechat/kanjia/index?kj_id=".$add_status,//链接     
                                    "http://www.eyuanduobao.com/Public/images/wuhounaicha_banner.jpg"
                                );   
                                }else{
                                    $wechat->replyText("系统有误，请联系管理员");
                                }
                            }
                            exit();
                            
                        break;

                    // case '多图文':
                    //     $news = array(
                    //         "全民创业蒙的就是你，来一盆冷水吧！",
                    //         "全民创业已经如火如荼，然而创业是一个非常自我的过程，它是一种生活方式的选择。从外部的推动有助于提高创业的存活率，但是未必能够提高创新的成功率。第一次创业的人，至少90%以上都会以失败而告终。创业成功者大部分年龄在30岁到38岁之间，而且创业成功最高的概率是第三次创业。", 
                    //         "http://www.topthink.com/topic/11991.html",
                    //         "http://yun.topthink.com/Uploads/Editor/2015-07-30/55b991cad4c48.jpg"
                    //     ); //回复单条图文消息

                        $wechat->replyNews($news, $news, $news, $news, $news);
                        break;
                    
                    default:
                        $wechat->replyText("(●˘◡˘●) 想参与最新活动吗？\n\n  /玫瑰 免费奶茶\n\n点击下方菜单\n->[免费奶茶]参与活动吧！");
                        break;
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    /**
     * 资源文件上传方法
     * @param  string $type 上传的资源类型
     * @return string       媒体资源ID
     */
    private function upload($type){
        $appid     = 'wx58aebef2023e68cd';
        $appsecret = 'bf818ec2fb49c20a478bbefe9dc88c60';

        $token = session("token");

        if($token){
            $auth = new WechatAuth($appid, $appsecret, $token);
        } else {
            $auth  = new WechatAuth($appid, $appsecret);
            $token = $auth->getAccessToken();

            session(array('expire' => $token['expires_in']));
            session("token", $token['access_token']);
        }

        switch ($type) {
            case 'image':
                $filename = './Public/image.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'voice':
                $filename = './Public/voice.mp3';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;

            case 'video':
                $filename    = './Public/video.mp4';
                $discription = array('title' => '视频标题', 'introduction' => '视频描述');
                $media       = $auth->materialAddMaterial($filename, $type, $discription);
                break;

            case 'thumb':
                $filename = './Public/music.jpg';
                $media    = $auth->materialAddMaterial($filename, $type);
                break;
            
            default:
                return '';
        }

        if($media["errcode"] == 42001){ //access_token expired
            session("token", null);
            $this->upload($type);
        }

        return $media['media_id'];
    }

    /*构造菜单*/
    public function create_menu(){
        //https://api.weixin.qq.com/cgi-bin/menu/create?access_token=ACCESS_TOKEN
        //post
        //数据结构
        $array['button'][0]=array(
            'botton'=>true,
            'name'=>'壹易购物',
            'type'=>'view',
            'url'=>'http://www.eyuanduobao.com/index.php/home',
            );
        $array['button'][1]=array(
            'botton'=>true,
            'name'=>'免费奶茶',
            'type'=>'view',
            'url'=>'http://www.eyuanduobao.com/index.php/Wechat/Kanjia/active_faqi',
                // array(
                //         'type' => 'view',
                //         'name' => '测试',
                //         'url' => 'http://www.eyuanduobao.com/index.php/Wechat/Kanjia/active_faqi',
                //     ),
            );
         $array['button'][2]=array(
            'name'=>'我的',
            'sub_button'=>array(
                array(
                        'type' => 'view',
                        'name' => '个人中心',
                        'url' => 'http://www.eyuanduobao.com/index.php/Home/Person/me',
                    ),
                array(
                        'type' => 'view',
                        'name' => '购物记录',
                        'url' => 'http://www.eyuanduobao.com/index.php/Home/Person/miaosharecord',
                    ),
                array(
                        'type' => 'click',
                        'name' => '联系我们',
                        'key' => '联系我们',
                    ),
                ),
            );
        $array=json_encode($array,JSON_UNESCAPED_UNICODE);
        // print_r($array);die;
        //创建菜单
        $rs=post('https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.S('access_token'),$array);
        print_r($rs);
    }



    /*创建临时二维码*/
    public function create_qr($openid='',$type=1){
        //找到此用户的uid
        $uid=M('member')->where(array('openid'=>$openid))->limit(1)->getField('uid');
        $uid=$type.$uid;
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
        return ('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$rs['ticket']);
        // print_r($rs);
    }

    //获取菜单
    public function menu(){
        $wx_info=C('wx_info');
        $Auth=new WechatAuth($wx_info['AppID'],$wx_info['Secret'],S('access_token'));
        $rs=$Auth->menuGet();
        print_r($rs);

    }
    //删除菜单
    public function menudel(){
        $wx_info=C('wx_info');
        $Auth=new WechatAuth($wx_info['AppID'],$wx_info['Secret'],S('access_token'));
        $rs=$Auth->menuDelete();
        print_r($rs);

    }


    public function test($m=50000,$type=2){

        header("Content-type:text/html;charset=utf-8");
        set_time_limit (0);//   //设置程序最大执行时间为无限  0为无限制
        ini_set('max_execution_time', '0');//设置最大执行时间  0为不限时
        $area=M('kanjiarule')->where(array('type'=>$type))->order('kjr_yikan ASC')->select();
        //计算已砍比例
        $kanjia_info['money']=50000;
        $a=0;
        while($m>=10){
            $yikan=$kanjia_info['money']-$m;
            $yikan_bl=round(($yikan/$kanjia_info['money']*100),2);
            //找到它所在的区间
            foreach ($area as $key => $value) {
                if($yikan_bl<=$value['kjr_yikan']){
                    $min=$value['kjr_min'];
                    $max=$value['kjr_max'];
                    if($min>=0.01&&$max<0.1){
                        $min=(int)($min*100);
                        $max=(int)($max*100);

                        $add_money=mt_rand($min,$max)/100;
                        echo "区间1<br>";
                    }
                    elseif($min>=0.1&&$max<1){
                        $min=(int)($min*10);
                        $max=(int)$max;
                        $add_money1=mt_rand($min,9)/10;
                        $add_money2=mt_rand(10,$max*10)/100;
                        $add_money=$add_money1+$add_money2;
                        echo "区间2<br>";
                    }
                    elseif($min>=0.01&&$max>1){
                        $min=(int)($min);
                        $max=(int)($max);
                        $add_money1=mt_rand(0,$max);
                        $add_money2=mt_rand(1,99)/100;
                        $add_money=$add_money1+$add_money2;
                        echo "区间3<br>";
                    }
                    elseif($min>=0.1&&$max<=1){
                        $min=(int)($min*10);
                        $max=(int)($max*10);
                        $add_money2=mt_rand($min,$max)/10;
                        $add_money=$add_money2;
                        echo "区间4<br>";
                    }
                    elseif($min>=0.1&&$max>11){
                        $min=(int)($min*10);
                        $max=(int)($max);
                        $add_money1=mt_rand($min,9)/10;
                        $add_money2=mt_rand(0,$max);
                        $add_money=$add_money2;
                        echo "区间4<br>";
                    }
                    else{
                        $add_money1=mt_rand(0,99)/10;
                        $add_money2=mt_rand(1,99)/100;
                        $add_money=$add_money1+$add_money2;
                        echo "区间5<br>";
                    }
                    break;
                }
                else{
                    $add_money2=mt_rand(1,9)/100;
                    $add_money=$add_money2;
                    // echo "区间6<br>";
                }
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

     /*创建临时二维码*/
    public function create_qr111($openid='oyKgswI_fyh9dM5rdw6SAEy0dEUg',$type=1){
        //找到此用户的uid
        $uid=M('member')->where(array('openid'=>$openid))->limit(1)->getField('uid');
        $uid=$type.$uid;
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
        echo  ('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$rs['ticket']);
        // print_r($rs);
    }



}//end