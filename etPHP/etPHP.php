<?php 
/**
 + etPHP.php
 + ===========================================
 + Copy right ? - 2014-2-20
 + -----------------------------------------------------------------------------
 + etPHP框架入口文件
 + ===========================================
 + @param 
 + @param $GLOBALS
 +
 + @create time	2014
 + @version	v1.0.0
 */

// 运行时间
define('_ET_BGTIME_', microtime(TRUE));
// 运行内存
define('_ET_MEMORY_USE_', function_exists('memory_get_usage') ? memory_get_usage() : 0);




// 框架版本
define('_ET_VERSION_', '1.0');
// 框架路径
define('_ET_PATH_', dirname(__FILE__) . DIRECTORY_SEPARATOR);
// 缓存目录
define('_ET_CACHE_', _ET_PATH_ . '..' . DIRECTORY_SEPARATOR . 'caches' . DIRECTORY_SEPARATOR);
// 是否开启调试
defined('_ET_DEBUG_') or define('_ET_DEBUG_', FALSE);
// 定义项目默认目录
defined('_ET_APP_PATH_') or define('_ET_APP_PATH_', dirname(__FILE__));
// 定义项目默认名字
defined('_ET_APP_NAME_') or define('_ET_APP_NAME_', etPHP::load_sys_config('general','DEFAULT_APP'));

// 加载系统函数库
etPHP::load_sys_func('common');


class etPHP
{
	public static function run()
	{
		return self::load_sys_class('application');
	}
	
	/**
	 * 导入类库
	 * @param	string	$classname	类名
	 * @param	string	$path		路径
	 * @param	int		$initialize	是否初始化
	 * @version	1.0
	 * @return		unknown
	 */
	private static function _load_class($classname, $path = NULL, $initialize = 1)
	{
		static $classes = array();
		if(empty($path)) $path = 'libs' . DIRECTORY_SEPARATOR . 'classes';
		
		$key = md5($path . $classname);
		
		if(isset($classes [$key])){
			if(!empty($classes[$key])){
				return $classes [$key];
			}else{
				return true;
			}
		}
		$_path = _ET_PATH_ . $path . DIRECTORY_SEPARATOR . $classname . '.class.php';
		if(file_exists($_path)) {
			include $_path;
			$name = $classname;
			if($initialize) {
				$classes [$key] = new $name;
			} else {
				$classes [$key] = true;
			}
			return $classes [$key];
		}else{
			return false;
		}
	}
	/**
	 * 加载系统级类库
	 * @param	string	$clsname	类或 
	 * @param	int		$initialize	是否初始化
	 * @version	1.0
	 * @return		unknown
	 */
	public static function load_sys_class($clsname, $initialize = 1)
	{
		return self::_load_class($clsname, NULL, $initialize);
	}
	
	public static function load_app_class($clsname, $initialize = 1) {
		//return self::_load_class($clsname, $initialize);
	}
	
	/**
	 * 加载配置文件
	 * @param	string	$file	文件名	 
	 * @param	string	$key	要获取的配置项
	 * @param	string	$default	默认配置项，当获取配置项目失败时该值发现变化
	 * @param	string	$ext	扩展名
	 * @version	1.0
	 * @return		unknown
	 */
	private static function _load_config($file, $key = '', $default = '', $ext = '')
	{
		static $configs = array();
		
		if (empty($ext)) $ext = '.php';
		$file .= $ext;
		if (isset($configs[$file])) {
			if (empty($key)) {
				return $configs[$file];
			} elseif (isset($configs[$file][$key])) {
				return $configs[$file][$key];
			} else {
				return $default;
			}
		}
		
		if(file_exists($file)){
			$configs [$file] = include $file;
		}
		
		if(empty($key)){
			return $configs [$file];
		} elseif (isset($configs[$file][$key])) {
			return $configs[$file][$key];
		} else {
			return $default;
		}
		
	} 
	/**
	 * 加载系统级配置文件
	 * @param	string	$cfgname	配置文件名	 
	 * @param	string	$key		配置项
	 * @param	string	$default	默认配置项
	 * @param	string	$ext		配置文件后缀
	 * @version	1.0
	 * @return		unknown
	 */
	public static function load_sys_config($cfgname, $key = '', $default = '' , $ext = '')
	{
		
		$_path = _ET_CACHE_ . 'configs' . DIRECTORY_SEPARATOR . $cfgname.$ext;
		return self::_load_config($_path, $key, $default, $ext);
	}
	
	/**
	 * 加载模块级配置文件
	 * @param		 
	 * @param		
	 * @version	1.0
	 * @return		unknown
	 */
	public static function load_app_config($cfgname, $key = '', $default = '', $ext = '')
	{
		$_confg_data = C('general');
		$_module = $_confg_data['DEFAULT_MODULE'];
		$_config_name = $_confg_data['DEFAULT_CONFIG'];
		$_path = _ET_APP_PATH_.DIRECTORY_SEPARATOR._ET_APP_NAME_.DIRECTORY_SEPARATOR.$_module.DIRECTORY_SEPARATOR.$_config_name.DIRECTORY_SEPARATOR.$cfgname;
		return self::_load_config($_path, $key, $default, $ext);
	}
	/**
	 * 加载函数库
	 * @param	string	$func	函数库文件路径
	 * @version	1.0
	 * @return		unknown
	 */
	private static function _load_func($func, $ext = '.func.php')
	{
		static $funcs = array();
		if(empty($ext)) $ext = '.func.php';
		$func .= $ext;
		$key = md5($func);
		if (isset($funcs[$key])) return true;
		if (file_exists($func)) {
			include $func;
		} else {
			$funcs[$key] = false;
			return false;
		}
		$funcs[$key] = true;
		return true;
	}
	/**
	 * 加载系统函数库文件
	 * @param	string	$func	函数库文件名称
	 * @param	string	$ext	后缀
	 * @version	1.0
	 * @return		unknown
	 */
	public static function load_sys_func($func, $ext = '')
	{
		$_path = _ET_PATH_ . 'libs' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . $func;
		return self::_load_func($_path, $ext); 
	}
	/**
	 * 加载应用级函数库文件
	 * @param		 
	 * @param		
	 * @version	1.0
	 * @return		unknown
	 */
	public static function load_app_func($fuc, $ext = '')
	{
		
		
	}
}

?>