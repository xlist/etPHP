<?php 
/**
 + common.func.php
 + ===========================================
 + Copy right ? - 2014-2-24
 + -----------------------------------------------------------------------------
 + etPHP框架公共函数库
 + ===========================================
 + @param 
 + @param 
 +
 + @create time	2014
 + @version	v1.0.0
 */

/**
 * 读取配置文件或配置项
 * @param	string	$file	配置文件
 * @param	string	$key	配置项
 * @param	string	$default默认配置项
 * @param	string	$type	系统或应用配置文件
 * 					sys		系统配置文件（默认）
 * 					app		应用配置文件
 * @version	1.0
 * @return		unknown
 */
function C($file, $key = '', $default = '' ,$type = 'sys') {
	if(empty($file) || empty($type)) return false;
	if($type == 'sys'){
		return etPHP::load_sys_config($file, $key, $default);
	}elseif ($type == 'app'){
		return etPHP::load_app_config($file, $key, $default);
	}
}

/**
 * 导入类库
 * @param	string	$file	类名	，无需要扩展名（.class.php）
 * @param	string	$type		类型
 * @version	1.0
 * @return	Object OR Boolean 
 */
function F($file = '', $type = 'sys', $initialize = 1)
{
	if(empty($file) || empty($type)) return false;
	if($type == 'sys'){
		return etPHP::load_sys_class($file, $initialize);
	}elseif ($type == 'app'){
		return etPHP::load_app_class($file, $initialize);
	}
}

/**
 * 合并配置文件,解决项目配置文件需要覆盖或合并时，可调用该函数。
 * 
 * 注：如果项目配置文件中的某项为空，不覆盖在主配置文件中的项。
 * 如果项目配置文件中的某项在主配置文件中不存在，则合并该项，并在函数调用结束返回。
 * 
 * 产生的新的配置文件是一个临时的配置文件，故:只在调用该函数的地方有效。
 * @param	array	$_a_config	需要与后一个参数进行合并。
 * @param	string	$_m_config	该参数为空，表示是与系统配置文件进行覆盖。
 * @param	int		$type		是否合并不存在的项
 * 						1		合并
 * 						0		不合并
 * @version	1.0
 * @return		new a ConfigFiles to array. 
 */
function c2c_merge($_a_config, $_m_config = NULL, $type = 1)
{
	if(empty($_m_config)) $_m_config = 'general';
	
	
	$_m_config_data = C($_m_config);
	//如果主配置为空直接返回。
	if(!isArray($_m_config_data)) $_m_config_data = C($_m_config, '', '', 'app');
	
	if(!isArray($_m_config_data)) return false;
	if(is_string($_a_config)) $_a_config = array($_a_config);
	
	foreach ($_a_config as $_k => $_v){
		$_a_config_data = C($_v, '', '', 'app');
		///print_r($_a_config_data);
		foreach ($_a_config_data as $_key => $_val) {
			if(in_array($_key, $_m_config_data)){
				$_m_config_data[$_key] = $_val;
			} else {
				if($type) $_m_config_data[$_key] = $_val;
			}
		}
	}
	
	return $_m_config_data;
}

/**
 * 判断是否是数组.
 * 是数组返回	true,
 * 不是数组返回	false.
 * @param	arrag	$array	数组
 * @version	1.0
 * @return	true OR false
 */
function isArray($array)
{
	if(is_array($array) && count($array) > 0) return true;
	return false;
}

?>