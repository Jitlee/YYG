
 


function initconfig()
{	
	wx.config({
	      debug: false,
	      appId: 		signPackage.appId,
	      timestamp: 	signPackage.timestamp,
	      nonceStr: 	signPackage.nonceStr,
	      signature: 	signPackage.signature,
	      jsApiList: [
	        'checkJsApi',
	        'onMenuShareTimeline',
	        'onMenuShareAppMessage',
	        'onMenuShareQQ',
	        'onMenuShareWeibo'
	      ]
 	});
}
 

$(document).ready(function(){ 
	
	initconfig();
 
	
 
	wx.ready(function () { 	
	  var defultimg='http://www.eyuanduobao.com/Public/logo.jpg?ee20160502';
	  if(shareData.imgUrl=='')
	  {
	  	shareData.imgUrl=defultimg;
	  }
	  wx.onMenuShareAppMessage(shareData);
	  wx.onMenuShareQQ(shareData);
	  wx.onMenuShareWeibo(shareData);
	  wx.onMenuShareTimeline(shareData);
	  
	});
	
	wx.error(function (res) {
	  alert("error:"+res.errMsg);
	}); 
 
});