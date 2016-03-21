<?php
return array(
 	//数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'yyg.ritacc.net', // 服务器地址
    'DB_NAME'   => 'yyg', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'ABCabc123', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'yyg_', // 数据库表前缀 
	//'配置项'=>'配置值'
	'LAYOUT_ON'=>	true, // 启用布局
	'URL_CASE_INSENSITIVE' => FALSE,	//忽略大小写
	
	'VAR_SESSION_ID'			=> 'session_id', // 修复unloadfiy插件无法传递session_id的bug
	
	'URL_PARAMS_BIND'       	=>  true, // URL变量绑定到操作方法作为参数
	'URL_PARAMS_BIND_TYPE'		=> 1,  // 设置参数绑定按照变量顺序绑定
	'SHOW_PAGE_TRACE'		=>FALSE,
	'OAUTH'                 => array(
        'QQ_APPKEY'         => '101269538',
        'QQ_APPSECRETKEY'   => '9ecd278b8df0e59695e75d48c2f0718e',
        'QQ_SCOPE'          => 'get_user_info,get_repost_list,add_idol,add_t,del_t,add_pic_t,del_idol',
        'QQ_CALLBACK'       => 'http://yyg.ritacc.net/index.php/Home/Public/auth',
        
        'WEIBO_APPKEY'      => '3125608124',
        'WEIBO_APPSECRETKEY'=> 'e85df87aaf5d7587f8cb1194606577ec',
        'WEIBO_SCOPE'       => '',
        'WEIBO_CALLBACK'    => 'http://yyg.ritacc.net/index.php/Home/Public/weiboauth',
    ),
    'MSG'					=> array(
    	'accountsid'       	=> '518e36828e6e1f087b8ffe24f1b03f43',
    	'token'           	=> '3fb2cc004c2fe2f8addfae9902d9944e',
    	'templateId'        => '21529',
    	'appId'           	=> '683db6ebec8247d18897833d97cfce07',
	),
	'jubaopay'					=> array(
    	'partnerid'       	=> '16030746521135666706',
    	'returnURL'           	=> 'http://www.eyuanduobao.com/index.php/P/back',
    	'callBackURL'        => 'http://www.eyuanduobao.com/index.php/P/notify',
	),
		
);