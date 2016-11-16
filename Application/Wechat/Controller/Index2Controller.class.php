<?php
namespace Wechat\Controller;
use Think\Controller;
use Com\Wechat;
use Com\WechatAuth;
class Index2Controller extends Common2Controller{

    public function index2()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            ob_clean();
            echo $echoStr;
            exit;
        }
    }
    private function checkSignature()
    {

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];    
                
        $token = 'maimaimai';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 微信消息接口入口
     * 所有发送到微信的消息都会推送到该操作
     * 所以，微信公众平台后台填写的api地址则为该操作的访问地址
     */
    public function index(){
        $token = 'maimaimai'; //微信后台填写的TOKEN
        /* 加载微信SDK */
        $wechat = new Wechat($token);
        /* 获取请求信息 */
        $data = $wechat->request();
        if($data && is_array($data)){

           $wx_info=C('wx_info2');
           $Auth=new WechatAuth($wx_info['AppID'],$wx_info['Secret'],S('access_token2'));
           switch ($data['MsgType']) {
                 case Wechat::MSG_TYPE_EVENT:
                 switch ($data['Event']) {
                      case Wechat::MSG_EVENT_SUBSCRIBE:
                          // 来源openid
                          $form_openid=$data['FromUserName'];
                          //获取来源者信息
                          $form=$Auth->userInfo($form_openid);

                          $old_wx['nickname'] = $form['nickname'];
                          $old_wx['sex'] = $form['sex'];
                          $old_wx['city'] = $form['city'];
                          $old_wx['province'] = $form['province'];
                          $result= M('wx_user')->where($old_wx)->find();
                           //判断
                         if($result)
                         {
                              $form['yyg_openid'] = $result['openid'];
                         }
                         $db = M('wx_jzq_user')->where(array('openid'=>$form['openid']))->Find();
                         if(!$db){
                             M('wx_jzq_user')->where(array('openid'=>$form['openid']))->delete();
                             M('wx_jzq_user')->add($form);
                         }
                         $wechat->replyText("欢迎！发送<查询>可以查询邀请送红包活动信息");
                       }
                       break;
                 case Wechat::MSG_TYPE_TEXT:
                 switch ($data['Content']) {
                   case '查询':
                    $re = M('wx_jzq_user')->where(array('openid'=>$form['openid']))->Find();
                    if($re['openid']=!null&&$re['yyg_openid']=!null)
                    {
                        $m =M('wx_user')->where(array('openid'=>$re['yyg_openid']))->find();
                        if($m['fahongbao']!=0)
                        {
                          $wechat->replyText("明天准备收红包");
                          break;
                        }
                        else{
                          $wechat->replyText("邀请人数不足,请努力");
                          break;
                        }
                    }
                    else
                    {
                        $form_openid=$data['FromUserName'];
                  //获取来源者信息
                        $form=$Auth->userInfo($form_openid);

                        $old_wx['nickname'] = $form['nickname'];
                        $old_wx['sex'] = $form['sex'];
                        $old_wx['city'] = $form['city'];
                        $old_wx['province'] = $form['province'];
                         //判断
                         $result= M('wx_user')->where($old_wx)->find();

                         if($result)
                         {
                              $form['yyg_openid'] = $result['openid'];
                         }
                         $db = M('wx_jzq_user')->where(array('openid'=>$form['openid']))->Find();
                         if(!$db){
                             M('wx_jzq_user')->where(array('openid'=>$form['openid']))->delete();
                             M('wx_jzq_user')->add($form);
                         }
                         if($db['yyg_openid']==null)
                         {
                            $wechat->replyText("请再次查询");
                            break;
                         }
                       break;
                    }

                    
                 }
                 break;

        }
    }
}
}



                // *
                //  * 你可以在这里分析数据，决定要返回给用户什么样的信息
                //  * 接受到的信息类型有10种，分别使用下面10个常量标识
                //  * Wechat::MSG_TYPE_TEXT       //文本消息
                //  * Wechat::MSG_TYPE_IMAGE      //图片消息
                //  * Wechat::MSG_TYPE_VOICE      //音频消息
                //  * Wechat::MSG_TYPE_VIDEO      //视频消息
                //  * Wechat::MSG_TYPE_SHORTVIDEO //视频消息
                //  * Wechat::MSG_TYPE_MUSIC      //音乐消息
                //  * Wechat::MSG_TYPE_NEWS       //图文消息（推送过来的应该不存在这种类型，但是可以给用户回复该类型消息）
                //  * Wechat::MSG_TYPE_LOCATION   //位置消息
                //  * Wechat::MSG_TYPE_LINK       //连接消息
                //  * Wechat::MSG_TYPE_EVENT      //事件消息
                //  *
                //  * 事件消息又分为下面五种
                //  * Wechat::MSG_EVENT_SUBSCRIBE    //订阅
                //  * Wechat::MSG_EVENT_UNSUBSCRIBE  //取消订阅
                //  * Wechat::MSG_EVENT_SCAN         //二维码扫描
                //  * Wechat::MSG_EVENT_LOCATION     //报告位置
                //  * Wechat::MSG_EVENT_CLICK        //菜单点击
                 

                // //记录微信推送过来的数据
                // file_put_contents('./data.json', json_encode($data));

                // /* 响应当前请求(自动回复) */
                // //$wechat->response($content, $type);

                // /**
                //  * 响应当前请求还有以下方法可以使用
                //  * 具体参数格式说明请参考文档
                //  * 
                //  * $wechat->replyText($text); //回复文本消息
                //  * $wechat->replyImage($media_id); //回复图片消息
                //  * $wechat->replyVoice($media_id); //回复音频消息
                //  * $wechat->replyVideo($media_id, $title, $discription); //回复视频消息
                //  * $wechat->replyMusic($title, $discription, $musicurl, $hqmusicurl, $thumb_media_id); //回复音乐消息
                //  * $wechat->replyNews($news, $news1, $news2, $news3); //回复多条图文消息
                //  * $wechat->replyNewsOnce($title, $discription, $url, $picurl); //回复单条图文消息
                //  * 
                //  */
                
                // //执行Demo
                // $this->demo($wechat, $data);   
