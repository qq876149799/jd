<?php 
	class LoginController{

		//登录页面
		function login(){
			if (empty($_SESSION['admin']['user']) || $_SESSION['admin']['login'] != 'true') {
				include './View/login.html';
			}else{
				header('location:./index.php');
			}
		}

		//登录方法
		function do_login(){
			if (!empty($_SESSION['admin']['user']) && $_SESSION['admin']['login'] == 'true') {
				include './index.php';
			}
			var_dump($_POST);
			var_dump($_SESSION);
			
			// var_dump($_POST);exit;
			//判断是否输入值
			if (empty($_POST['password'])) {
				echo 1111;
				echo '<script>alert("请输入密码");location="./View/login.html"</script>';
			}
			if ($_POST['username'] == '') {
				echo 2222;
				echo '<script>alert("请输入用户名");location="./View/login.html"</script>';
			}
			
			//判断管理员是否存在
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM user WHERE username = ?";
				$stmt = $pdo->prepare($sql);
				$stmt->bindparam(1,$_POST['username']);
				$stmt->execute();
				$user = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				echo $e->getMessage();
				file_put_contents('./log/error.txt',time().' ---- '.$e->getMessage,FILE_APPEND);
			}
			//判断输入是否正确
			if (is_array($stmt->fetchAll(2))) {
				//判断等级
				if ($user[0]['level'] != 2 || $user[0]['level'] != 1) {
					echo '<script>alert("权限不足，请联系管理员！");location="./View/login.html"</script>';
				}
				//判断密码
				if ($user[0]['password'] != md5($_POST['password'])) {
					echo '<script>alert("密码错误");location="./View/login.html"</script>';
				}
				//SESSION数组
				$_SESSION['admin']['login'] = 'true';
				$_SESSION['admin']['user'] = $_POST['username'];
				if ($user[0]['level'] == 1) {
					$_SESSION['admin']['level'] = '普通管理员';
				}
				if ($user[0]['level'] == 2) {
					$_SESSION['admin']['level'] = '超级管理员';
				}
				$_SESSION['admin']['last_login'] = $user[0]['last_login'];
				//统计登录次数
				$login_info['login_num']=$user[0]['login_num']+1;
				//保存登录时间
				$login_info['last_login'] = time();
				//将登录次数存入SESSION和表中
				$_SESSION['admin']['login_num'] = $login_info['login_num'];
				$mysql = new Model('user');
				$mysql->where('id = '.$user[0]['id'])->update($login_info);
				header('location:./index.php?c=index');
			}else{
				echo '<script>alert("此账户不存在");location="./index.php?c=login&a=login"</script>';
			}
		}

		//退出登录
		function logout(){
			//清除客户端的cookie
			setcookie(session_name(),'',time(),'/');
			//清除客户端的session信息
			$_SESSION['admin'] = array();
			header('location:./View/login.html');
		}
	}