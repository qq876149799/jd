<?php
	//分类控制器
	class TypeController{
		function Index(){
			$mysql = new Model('type');
			$result = $mysql->order("CONCAT(path,id) ASC")->select();
			// var_dump($result);
			include './View/type/list.html';
		}

		//显示操作
		function display(){
			// var_dump($_GET);exit;
			$mysql = new Model('type');
			$result = $mysql->update($_GET);
			// echo $mysql->sql;
			header('location:./index.php?c=type');
		}

		//添加页面
		function add(){
			if (!empty($_GET['pid'])) {
				$pid = $_GET['pid'];
				$mysql = new Model('type');
				$result = $mysql->where('id = '.$_GET['pid'])->select();
				// var_dump($result);
				$path = $result[0]['path'].$pid.',';
				$title = '添加子分类';
			}else{
				$pid = '0';
				$path = '0,';
			}
			include './View/type/form.html';
		}

		//执行添加操作
		function do_add(){
			//拼接路径
			if ($_POST['pid'] != '0') {
				//$path = $_POST['pid'].','.$_POST['path'];
				// echo $path;exit;
			}
			// var_dump($_POST);exit;
			$mysql = new Model('type');
			$result = $mysql->add($_POST);
			if ($result) {
				echo '<script>alert("添加分类成功");location="./index.php?c=type"</script>';
			}else{
				echo '<script>alert("添加分类失败");location="./index.php?c=type"</script>';
			}
		}

		//删除操作
		function del(){
			// var_dump($_GET);
			$mysql = new Model('type');
			$result = $mysql->where('pid = '.$_GET['id'])->select();
			if (empty($result)) {
				$result = $mysql->del();
				if ($result) {
					echo '<script>alert("删除成功");location="./index.php?c=type"</script>';
				}else{
					echo '<script>alert("删除失败");location="./index.php?c=type"</script>';
				}
			}else{
				echo '<script>alert("请先删除所有子类");location="./index.php?c=type"</script>';
			}
		}

		//修改页面
		function  edit(){
			$mysql = new Model('type');
			$result = $mysql->where('id = '.$_GET['id'])->select();
			// var_dump($result);
			include './View/type/form.html';
		}
		//执行修改操作
		function do_update(){
			if ($_POST['name'] == '') {
				echo '<script>alert("请输入内容");location="./index.php?c=type&a=edit&id='.$_GET['id'].'"</script>';
			}
			$mysql = new Model('type');
			$result = $mysql->update($_POST);
			if ($result) {
				echo '<script>alert("修改成功");location="./index.php?c=type"</script>';
			}else{
				echo '<script>alert("修改成功");location="./index.php?c=type"</script>';
			}
		}

		//调用不存在的方法时
		function __call($classname,$args){
			echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./">返回首页</a>';exit;
		}
	}