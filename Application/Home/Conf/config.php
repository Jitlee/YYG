<?php
return array(
	//'配置项'=>'配置值'
	
	
	//'配置项'=>'配置值'
	
	'SESSION_PREFIX'			=> 'user_', // SESSION前缀配置
	'COOKIE_PREFIX'				=> 'user_', // COOKIE前缀配置
	
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
		'__FONT_ICON__'		=> 'http://at.alicdn.com/t/font_1448212068_2954175.css',
	),
);