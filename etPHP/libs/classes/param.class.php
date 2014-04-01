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
 	private $_cfg_data;
 	function __construct()
 	{
 		//$_config_data = C('general');
 		$this->_cfg_data = $_cfg_data = c2c_merge('general');
 		
 		// 最后URL参数存放的变量
 		$last_url_params = array();
 		
 		switch ($_cfg_data['URL_MODEL'])
 		{
 			default:
 			case 1 :
 				$_path_info = $_SERVER['PATH_INFO'];
 				if(!empty($_path_info)) {
 					/**
 					 * 这种方式表示使用PATH_INFO的方式来处理URL
 					 * 这里将PATH_INFO的东西进行处理
 					 * 例如URL:http://localhost:8080/m/c/a/other_params
 					 */
 					$url_params = explode($_cfg_data['URL_PATHINFO_DEPR'], $_path_info);
 					$url_params = array_filter($url_params);
 					$_len = count($url_params);
 					$last_url_params = array(
 						'm' => $url_params[1] ? $url_params[1] : $_cfg_data['DEFAULT_MODULE'],
 						'c' => $url_params[2] ? $url_params[2] : $_cfg_data['DEFAULT_CONTROLLER'],
 						'a' => $url_params[3] ? $url_params[3] : $_cfg_data['DEFAULT_ACTION']
 					);
 					// 处理URL中的其它参数
 					// array_shift 返回数组中的第一个元素，并删除自身
 					for ($i = 4 ; $i < $_len ; $i += 2) {
 						$last_url_params[$url_params[$i]] = ($i + 2) == $_len ? array_shift(explode("~", $url_params[$i+1])) : $url_params[$i+1];
 					}
 				} else {
 					$last_url_params = array(
 						'm' => $_cfg_data['DEFAULT_MODULE'],
 						'c' => $_cfg_data['DEFAULT_CONTROLLER'],
 						'a' => $_cfg_data['DEFAULT_ACTION']
 					);
 				}
 				break;
 			case 0 :
 				exit('I\'m sorry!This method is not implemented.');
 				break;
 			case 2 :
 				exit('I\'m sorry!This method is not implemented.');
 				break;
 		}
		
 		// 合并GET的参数
 		$_GET = array_merge($_GET, $last_url_params);
 	}
 	
 	function m() {
 		return $_GET['m'] ? $_GET['m'] : $this->_cfg_data['DEFAULT_MODULE'];
 	}
 	
 	function c() {
 		return $_GET['c'] ? $_GET['c'] : $this->_cfg_data['DEFAULT_CONTROLLER'];
 	}
 	
 	function a() {
 		return $_GET['a'] ? $_GET['a'] : $this->_cfg_data['DEFAULT_ACTION'];
 	}
 }
 ?>