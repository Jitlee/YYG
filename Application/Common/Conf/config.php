<?php
return array(
 	//数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'yygdb', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'yyg_', // 数据库表前缀 
	//'配置项'=>'配置值'
	'LAYOUT_ON'=>	true, // 启用布局
	
	'VAR_SESSION_ID'			=> 'session_id', // 修复unloadfiy插件无法传递session_id的bug
);