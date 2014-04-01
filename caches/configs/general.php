<?php 

/**
 * 通用配置项
 *
 *
 */
return array(

	/* 数据库配置 */
    'DB_TYPE'               =>  '',		// 数据库类型
    'DB_HOST'               =>  '',		// 服务器地址
    'DB_NAME'               =>  '',		// 数据库名
    'DB_USER'               =>  '',		// 数据库用户名
    'DB_PWD'                =>  '',		// 数据库密码
    'DB_PORT'               =>  '',		// 端口
    'DB_PREFIX'             =>  '',		// 数据库表前缀
    'DB_CHARSET'            =>  'utf8',	// 数据库编码默认采用utf8
	
	/* COOKIE配置 */
	'COOKIE_EXPIRE'         =>  0,		// Cookie有效期
    'COOKIE_DOMAIN'         =>  '',		// Cookie有效域名
    'COOKIE_PATH'           =>  '/',	// Cookie路径
    'COOKIE_PREFIX'         =>  '',		// Cookie前缀
	
	/* SESSION设置 */
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
    'SESSION_OPTIONS'       =>  array(), // session 配置数组 支持type name id path expire domain 等参数
    'SESSION_TYPE'          =>  '', // session hander类型 默认无需设置 除非扩展了session hander驱动
    'SESSION_PREFIX'        =>  '', // session 前缀
	
	/* 默认认定 */
	'DEFAULT_M_LAYER'       =>  'model', // 默认的模型层名称,注:在此如果为“.”表示为公共模型，
    'DEFAULT_C_LAYER'       =>  'montroller', // 默认的控制器层名称
    'DEFAULT_V_LAYER'       =>  'themes', // 默认的视图层名称,
    'DEFAULT_LANG'          =>  'zh-cn', // 默认语言
    'DEFAULT_THEME'         =>  '',	// 默认模板主题名称
	'DEFAULT_APP'			=>	'demo',	// 默认项目名称
	'DEFAULT_CONFIG'		=>	'configs',	// 默认项目配置文件名称
    'DEFAULT_MODULE'        =>  'home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'index', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'DEFAULT_TIMEZONE'      =>  'PRC',	// 默认时区
	
	/* 系统变量名称设置 */
    'VAR_MODULE'            =>  'm',     // 默认模块获取变量
    'VAR_CONTROLLER'        =>  'c',    // 默认控制器获取变量
    'VAR_ACTION'            =>  'a',    // 默认操作获取变量
    'VAR_AJAX_SUBMIT'       =>  'ajax',  // 默认的AJAX提交变量
    'VAR_JSONP_HANDLER'     =>  'callback',

    'HTTP_CACHE_CONTROL'    =>  'private',  // 网页缓存控制
    'CHECK_APP_DIR'         =>  true,       // 是否检查应用目录是否创建
    'FILE_UPLOAD_TYPE'      =>  'Local',    // 文件上传方式
	
	/* URL设置 */
	'URL_MODEL'             =>  1,       // URL访问模式,可选参数0、1、2, 0 (普通模式); 1 (PATHINFO 模式); 2 (兼容模式);  默认为PATHINFO 模式
    'URL_PATHINFO_DEPR'     =>  '/',	// PATHINFO模式下，各参数之间的分割符号
);
?>