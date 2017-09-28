<?php
	//友情链接
	class LinkController{
		//默认方法
		function Index(){
			$where = 'is_del = 0';
			//判断是否有搜索
			if (isset($_GET['s']) && $_GET['s'] == 'search') {
				$where .= ' AND name like %'.$_GET['name'].'%';
			}
			$mysql = new Model('link');
			$result = $mysql->where($where)->select();
			// var_dump($result);
			include './View/link/list.html';
		}

		//添加页面
		function add(){
			include './View/link/form.html';
		}

		//执行添加
		function do_add(){
			// var_dump($_POST);
			$mysql = new Model('link');
			$result = $mysql->add($_POST);
			if ($result) {
				echo '<script>alert("添加友情链接成功");location="./index.php?c=link"</script>';
			}else{
				echo '<script>alert("添加友情链接失败");location="./index.php?c=link"</script>';
			}
		}

		//修改页面
		function edit(){
			$mysql = new Model('link');
			$result = $mysql->where('id = '.$_GET['id'])->select();
			include './View/link/form.html';
		}

		//执行修改
		function do_update(){
			// var_dump($_GET['id']);
			// var_dump($_POST);
			if ($_POST['name'] == '') {
				echo '<script>alert("请输入内容");location="./index.php?c=link&a=edit&id='.$_GET['id'].'"</script>';
			}
			$mysql = new Model('link');
			$result = $mysql->update($_POST);
			if ($result) {
				echo '<script>alert("修改成功");location="./index.php?c=link"</script>';
			}else{
				echo '<script>alert("修改成功");location="./index.php?c=link"</script>';
			}
		}

		//删除方法
		function del(){
			// var_dump($_GET['id']);
			$mysql = new Model('link');
			$result = $mysql->del();
			if ($result) {
				echo '<script>alert("删除成功");location="./index.php?c=link"</script>';
			}else{
				echo '<script>alert("删除失败");location="./index.php?c=link"</script>';
			}
		}

		//显示操作
		function display(){
			// var_dump($_GET);exit;
			$mysql = new Model('link');
			$result = $mysql->update($_GET);
			// echo $mysql->sql;
			header('location:./index.php?c=link');
		}

		//调用不存在的方法时
		function __call($classname,$args){
			echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./index.php">返回首页</a>';exit;
		}
	}