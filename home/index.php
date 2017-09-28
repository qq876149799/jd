<?php
	session_start();
	//设置时区
	date_default_timezone_set('PRC');

	//引入配置文件
	include '../public/config.php';

	function __autoload($classname){
		if (substr(strtolower($classname),-10) == 'controller') {
			if (file_exists('./Controller/'.$classname.'.class.php')) {
				include './Controller/'.$classname.'.class.php';
			}else{
				echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./index.php">返回首页</a>';exit;
			}
			
		}else if(substr(strtolower($classname),-5) == 'model'){
			if (file_exists('./Model/'.$classname.'.class.php')) {
				include './Model/'.$classname.'.class.php';
			}else{
				echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./index.php">返回首页</a>';exit;
			}
		}else{
			if (file_exists('./Org/'.$classname.'.class.php')) {
				include './Org/'.$classname.'.class.php';
			}else{
				echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./index.php">返回首页</a>';exit;
			}
		}
	}


	//获取类名
	$class = !empty($_GET['c'])?$_GET['c']:'index';
	//获取方法名
	$func = !empty($_GET['a'])?$_GET['a']:'index';


	//拼接类名
	$class = ucfirst(strtolower($class)).'Controller';
	// echo $class;
	//拼接方法名
	$func = ucfirst(strtolower($func));
	// echo $func;

	$con = new $class;

	$result = $con->$func();