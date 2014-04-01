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
		 * 
		 */
		
		// 项目路径
		$_app_path = _ET_APP_PATH_.DIRECTORY_SEPARATOR._ET_APP_NAME_.DIRECTORY_SEPARATOR;
		
		$_sys_config = C('general'); 
		// 判断项目是否存在
		if(is_dir($_app_path)) {
			/**
			 * 1.项目存在，检查项目下的配置文件
			 * 2.获取项目配置
			 */
			$_cls_param = F('param');
			//print_r(c2c_merge(array('general')));
			
			// 项目下默认的
			/*$_app_config = C('general','','','app');
			
			define("M", $_app_config['DEFAULT_MODULE'] ? $_app_config['DEFAULT_MODULE'] : $_sys_config['DEFAULT_MODULE']);
			define('C', $_app_config['DEFAULT_CONTROLLER'] ? $_app_config['DEFAULT_CONTROLLER'] : $_sys_config['DEFAULT_CONTROLLER']);
			define('A', $_app_config['DEFAULT_ACTION'] ? $_app_config['DEFAULT_ACTION'] : $_sys_config['DEFAULT_ACTION']);*/
			//$_config = array_merge($_app_config,$_sys_config);
			//print_r($_app_config);
			
		}else{
			exit('APPNAME does not exits.');
		}
		//$config = etPHP::load_sys_config('');
	}
	
	private function _load_controller($filename)
	{
		
	}
}
 ?>