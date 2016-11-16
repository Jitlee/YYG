<?php
return array(
	//'配置项'=>'配置值'
	
	
	//'配置项'=>'配置值'
	
	'SESSION_PREFIX'			=> 'user_', // SESSION前缀配置
	'COOKIE_PREFIX'				=> 'user_', // COOKIE前缀配置
	'LAYOUT_ON'=>false,
	'TMPL_PARSE_STRING' 		=> array( // 模板相关的配置
		'__IE10_BUG__'			=> 'http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js',
		'__B_CSS__'				=> '//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css',
		'__B_JS__'				=> '//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js',
		'__JQ__'				=> '//cdn.bootcss.com/jquery/1.11.3/jquery.min.js',
		'__STATIC__' 			=> __ROOT__ . '/Public/Static',		
		'__HOME__'				=> __ROOT__ . '/Public/' . MODULE_NAME,
		'__IMG__'				=> __ROOT__ . '/Public/' . MODULE_NAME . '/images',
		'__CSS__'				=> __ROOT__ . '/Public/' . MODULE_NAME . '/css',
		'__JS__'				=> __ROOT__ . '/Public/' . MODULE_NAME . '/js',
		'__KO__'				=> __ROOT__ . '/Public/' . MODULE_NAME . '/js/knockout-3.4.0.js',
		'__FONT_ICON__'		=> '//at.alicdn.com/t/font_1460524976_6031203.css',
		'__PING__'		=> 'https://one.pingxx.com/lib/pingpp_one.js',
	),
	//壹易购物
	'wx_info'=>array(
			'AppID'=>'wx1b4f89570d3f4976',
			'Secret'=>'5baecf3ae0ccafd7e65fd5dd619f0a46',
			'token'=>'m4t00gepo2rsj5pkoxje3qyfiroocwvy',
		),
	//聚众圈
	'wx_info2'=>array(
			'AppID'=>'wx43771b034931df41',
			'Secret'=>'ad0ad509ad207d202c09dcd2144176a9',
			'token'=>'maimaimai',
		),
	'SHOW_PAGE_TRACE' =>false,
	
);