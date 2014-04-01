<?php
/**
 + param.class.php
 + ===========================================
 + Copy right ? - 2014
 + -------------------------------------------
 + 参数处理类，解决M\C\A，
 + 安全过滤_GET、$_POST，支持不同模式的URL对框架的支持。
 + ===========================================
 + @param 
 + @param 
 + @author	xlist
 + @mail		xlist@sina.cn
 + @version	v1.0.0
 + -------------------------------------------
 +
 + @create time		2014-2-20
 + @modify time	variable
 +
 + -------------------------------------------
 */
 class param
 {
 	function __construct()
 	{
 		//$_config_data = C('general');
 		$_cfg_data = c2c_merge('general');
 		
 		switch ($_cfg_data['URL_MODEL'])
 		{
 			default:
 			case 0 :
 				echo 1;
 				break;
 			case 1 :
 				$_path_info = $_SERVER['PATH_INFO'];
 				if(empty($_path_info)) exit('PATH_INFO Unable to your server.Please check your server configuration and try again.');
 				$_p = explode($_cfg_data['URL_PATHINFO_DEPR'], $_path_info);
 				
 				/*if (empty($m)) $m = $_cfg_data['DEFAULT_MODULE'];
 				if (empty($c)) $c = $_cfg_data['DEFAULT_CONTROLLER'];
 				if (empty($a)) $a = $_cfg_data['DEFAULT_ACTION'];*/
 				echo count($_p);
 				unset($_p[0]);
 				print_r($_p);
 				if(count($_p) <= 2){
 					echo 1;
 				}
 				echo $_path_info;
 				break;
 			
 				
 		}
 	}
 	private function tagMatch()
 	{
 		
 	}
 }
 ?>