<?php 
/**
 + index.php
 + ===========================================
 + Copy right ? - 2014-2-24
 + -----------------------------------------------------------------------------
 + etPHP框架入口文件
 + ===========================================
 + @param 
 + @param 
 +
 + @create time	2014
 + @version	v1.0.0
 */
define('etPHP_PATH', dirname(__FILE__));
include etPHP_PATH . DIRECTORY_SEPARATOR . 'etPHP' . DIRECTORY_SEPARATOR  .'etPHP.php';

etPHP::run();


?>