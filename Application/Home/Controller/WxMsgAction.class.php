<?php
namespace Home\Controller;
use Think\Controller;
 
class WxMsgController extends Controller {
        public function index()
        {
            traceHttp();
			define("TOKEN", "weixin");
			//$wechatObj = new wechatCallbackapiTest();
			if (isset($_GET['echostr'])) {
			    $this->valid();
			}else{
			    $this->responseMsg();
			}
        }
		
	    public function valid()
	    {
	        $echoStr = $_GET["echostr"];
	        if($this->checkSignature()){
	            echo $echoStr;
	            exit;
	        }
	    }
		
        public function responseMsg()
        {
        		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

		        if (!empty($postStr)){
		        	logger($postStr);
		            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		            $fromUsername = $postObj->FromUserName;
		            $toUsername = $postObj->ToUserName;
		            $keyword = trim($postObj->Content);
					$EventKey= trim($postObj->EventKey);
		            $time = time();
		            $textTpl = "<xml>
		                        <ToUserName><![CDATA[%s]]></ToUserName>
		                        <FromUserName><![CDATA[%s]]></FromUserName>
		                        <CreateTime>%s</CreateTime>
		                        <MsgType><![CDATA[%s]]></MsgType>
		                        <Content><![CDATA[%s]]></Content>
		                        <FuncFlag>0</FuncFlag>
		                        </xml>";
					$contentStr=" ";
					if (!empty($EventKey)){
						switch($EventKey)
						{
							case "introduct": //简介
								$contentStr="关于简介，它。。。。";
								break;
							case "MGOOD":
								$contentStr="感谢您的支持，我们一定会做得更好。";
								break;
							default:
								$contentStr="需然不知道你说的是什么，相信它一定是对的。\n";
						}
					}
					else
				 	{
				 		$contentStr="您说的是：".$keyword;
				 	}
		            //$contentStr=$contentStr.$fromUsername.$toUsername;
		            
	                $msgType = "text";
	                //$contentStr = date("Y-m-d H:i:s",time());
	                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
	                echo $resultStr;
		             
		        }else{
		            echo "";
		            exit;
		        }
        }

        private function checkSignature()
        {
           $signature = $_GET["signature"];
	        $timestamp = $_GET["timestamp"];
	        $nonce = $_GET["nonce"];
			//define("TOKEN", "weixin");
	        $token = "weixin";
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

}
 