<?php

	//注册机
	include './Model.class.php';
	include '../../public/config.php';
	$test = new Model('user');

	for ($i=19; $i < 50; $i++) { 
		$data = ['username'=>'test'.$i++,'password'=>md5('123456'),'addtime'=>time(),'level'=>'1'];
		$test->add($data);
	}