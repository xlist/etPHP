<?php
/**
 + application.class.php
 + ===========================================
 + Copy right ? - 2014
 + -------------------------------------------
 + 框架程序基本应用程序.
 + ===========================================
 + @param 
 + @param 
 + @author	xlist
 + @mail		xlist@sina.cn
 + @version	v1.0.0
 + -------------------------------------------
 +
 + @create time		2014-2-18
 + @modify time	variable
 +
 + -------------------------------------------
 */
 
class application{
	private $_cfg_data;
	/**
	 * 构造函数	
	 * @version	1.0
	 * @return		unknown
	 */
	public function __construct()
	{
		/**
		 * 1.通过_ET_APP_PATH_确定项目路径
		 * 2.通过项目路径确定项目配置文件
		 * 3.通过项目配置文件分析项目相关配置来确定项目M、V、C走向
		 * 
		 * 如果，项目配置文件为空使用系统默认配置项，来解析项目。
		 * 
		 * 后期，可以自动生存一个简单的项目架构。
		 *
		 */
		$this->_cfg_data = c2c_merge('general');
		// 判断项目是否存在
		if(is_dir(_ET_PROJECT_PATH)) {
			/**
			 * 1.项目存在，检查项目下的配置文件
			 * 2.获取项目配置
			 */
			$_cls_param = F('param');
			define("_M_", $_cls_param->m());
			define("_C_", $_cls_param->c());
			define("_A_", $_cls_param->a());
			self::init();
		}else{
			exit('APPNAME does not exits.');
		}
	}
	private function init()
	{
		$controller = self::_load_controller();
		if (method_exists($controller, _A_)) {
			if (preg_match("/^[_]/i", _A_)) {
				exit('Action is protected.');
			} else {
				call_user_func(array($controller, _A_));
			}
		} else {
			exit('Action does not exist.');
		}
	}
	private function _load_controller($filename = '', $m = '')
	{
		if (empty($filename)) $filename = _C_;
		if (empty($m)) $m = _M_;
		$path = _ET_PROJECT_PATH . $m . DIRECTORY_SEPARATOR . $this->_cfg_data['DEFAULT_C_LAYER'] . DIRECTORY_SEPARATOR . $filename . '.php';
		
		if(file_exists($path)) {
			$classname = $filename;
			include $path;
			
			if (class_exists($classname)) {
				return new $classname;
			} else {
				exit('Controller does not exist.');
			}
		} else {
			exit('Controller does not exist.');
		}
		
	}
}
 ?>