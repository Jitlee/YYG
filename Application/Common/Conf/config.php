<?php
return array(
 	//数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'hdm191601457.my3w.com', // 服务器地址
    'DB_NAME'   => 'hdm191601457_db', // 数据库名
    'DB_USER'   => 'hdm191601457', // 用户名
    'DB_PWD'    => 'ABCabc123', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'yyg_', // 数据库表前缀 
	//'配置项'=>'配置值'
	'LAYOUT_ON'=>	true, // 启用布局
	
	'VAR_SESSION_ID'			=> 'session_id', // 修复unloadfiy插件无法传递session_id的bug
	
	'URL_PARAMS_BIND'       	=>  true, // URL变量绑定到操作方法作为参数
	'URL_PARAMS_BIND_TYPE'		=> 1,  // 设置参数绑定按照变量顺序绑定
	'QQ_AUTH'                 => array(
		'APP_ID'         => '101269538', //你的QQ互联APPID
		'APP_KEY'   	 => '9ecd278b8df0e59695e75d48c2f0718e',		
		'SCOPE'          => 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol',		
		'CALLBACK'       => 'http://yyg.ritacc.net',
	)
	
);