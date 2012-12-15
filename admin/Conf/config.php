<?php
$config	= array(
/*
 * 0:普通模式 (采用传统癿URL参数模式 )
 * 1:PATHINFO模式(http://<serverName>/appName/module/action/id/1/)
 * 2:REWRITE模式(PATHINFO模式基础上隐藏index.php)
 * 3:兼容模式(普通模式和PATHINFO模式, 可以支持任何的运行环境, 如果你的环境不支持PATHINFO 请设置为3)
 */
    'URL_MODEL'=>1,
    'DB_TYPE'               => 'mysql',     // 数据库类型
	'DB_HOST'               => 'localhost', // 服务器地址
	'DB_NAME'               => 'think-manager',          // 数据库名
	'DB_USER'               => 'seiven',      // 用户名
	'DB_PWD'                => 'chen18li',          // 密码
	'DB_PREFIX'             => 'hp_',    // 权限系统数据库表前缀

    'DB_LIKE_FIELDS'=>'title|remark',
	'APP_AUTOLOAD_PATH'=>'@.TagLib',
	'SESSION_AUTO_START'=>true,

	'VAR_PAGE'=>'pageNum',

);
/**
 * 权限管理系统需要配置
 */
$_manager_dbconfig = array(
	'RBAC_ROLE_TABLE'=>$config['DB_PREFIX'].'manager_role',
	'RBAC_USER_TABLE'=>$config['DB_PREFIX'].'manager_role_user',
	'RBAC_ACCESS_TABLE'=>$config['DB_PREFIX'].'manager_access',
	'RBAC_NODE_TABLE'=>$config['DB_PREFIX'].'manager_node',
	'RBAC_MUSER_TABLE'=>$config['DB_PREFIX'].'manager_user',
	'USER_AUTH_MODEL'=>'manager_user',	// 后台账户默认验证数据表模型
	'USER_AUTH_ON'=>true,
	'USER_AUTH_TYPE'=>1,		// 默认认证类型 1 登录认证 2 实时认证
	'USER_AUTH_KEY'=>'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'=>'administrator',
    'ADMIN_USER_NAME'=>'admin',// 超级管理员账户
	'AUTH_PWD_ENCODER'=>'md5',	// 用户认证密码加密方式
	'USER_AUTH_GATEWAY'=>'/Public/login',	// 默认认证网关
	'NOT_AUTH_MODULE'=>'Public',		// 默认无需认证模块
	'REQUIRE_AUTH_MODULE'=>'',		// 默认需要认证模块
	'NOT_AUTH_ACTION'=>'',		// 默认无需认证操作
	'REQUIRE_AUTH_ACTION'=>'',		// 默认需要认证操作
    'GUEST_AUTH_ON'=>false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'=>0,     // 游客的用户ID
);
/**
 * 后台dwz配置信息
 */
$_manager_system_config = array(
	'SITENAME'=>'后台管理系统',
	'COMPANY'=>'后台管理系统',
);
return array_merge($config,$_manager_system_config,$_manager_dbconfig);