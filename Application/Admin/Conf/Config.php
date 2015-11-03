<?php
return array(
	//'配置项'=>'配置值'
	
	'TMPL_PARSE_STRING' => array( // 模板相关的配置
		'__STATIC__' 	=> __ROOT__ . '/Public/Static',
		'__IMG__'		=> __ROOT__ . '/Public/' . MODULE_NAME . '/images',
		'__CSS__'		=> __ROOT__ . '/Public/' . MODULE_NAME . '/css',
		'__JS__'			=> __ROOT__ . '/Public/' . MODULE_NAME . '/js',
	),
	
	'SESSION_PREFIX'		=> 'admin_', // SESSION前缀配置
	'COOKIE_PREFIX'		=> 'admin_', // COOKIE前缀配置
	'VAR_SESSION_ID'		=> 'session_id', // 修复unloadfiy插件无法传递session_id的bug
	
);