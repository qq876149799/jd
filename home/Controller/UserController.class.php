<?php
	//用户控制器
	class UserController{
		function is_login(){
			//判断是否登录
			if(empty($_SESSION['user'])){
				//没有登录信息
				echo '<script>alert("请登录后再进行操作");location="./index.php?c=user&a=login"</script>';
			}
		}

		//默认方法
		function Index(){
			$this->is_login();
			$info = $this->info();

			//友情链接
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM link WHERE display = ?";
				$stmt = $pdo->prepare($sql);
				$display = 1;
				$stmt->bindParam(1,$display);
				$stmt->execute();
				$linklist = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}

			// var_dump($info);
			include './View/userinfo.html';
		}

		//登陆方法
		function login(){
			error_reporting(E_ALL &~E_NOTICE);
			// var_dump($_SESSION);exit;
			if (isset($_SESSION['user']) && $_SESSION['user']['login'] == 'true') {
				header('location:./index.php');
				// echo '<script>location="./index.php"</script>';
			}

			//友情链接
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM link WHERE display = ?";
				$stmt = $pdo->prepare($sql);
				$display = 1;
				$stmt->bindParam(1,$display);
				$stmt->execute();
				$linklist = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}


			include './View/login.html';
		}

		//执行登录
		function do_login(){
			// var_dump($_POST);exit;
			//判断是否输入内容
			if ($_POST['username'] == '') {
				echo '<script>alert("请输入用户名");location="./index.php?c=user&a=login"</script>';
			}
			if ($_POST['password'] == '') {
				echo '<script>alert("请输入密码");location="./index.php?c=user&a=login"</script>';
			}
			//判断是否可以登录
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM user WHERE is_del = ? AND username = ? ";
				$stmt = $pdo->prepare($sql);
				$is_del = 0;
				$stmt->bindParam(1,$is_del);
				$stmt->bindParam(2,$_POST['username']);
				$stmt->execute();
				$result = $stmt->fetchAll(2);
				// var_dump($result);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			if (!$result) {
				echo '<script>alert("用户名不存在");location="./index.php?c=user&a=login"</script>';
			}else{
				//判断密码是否正确
				if ($result[0]['password'] != md5($_POST['password'])) {
					echo '<script>alert("密码错误，请重新输入");location="./index.php?c=user&a=login"</script>';
				}else{
				//保存session数组
				$_SESSION['user']['login'] = 'true';
				$_SESSION['user']['username'] = $_POST['username'];
				$_SESSION['user']['id'] = $result[0]['id'];
				//统计登录次数
				$login_info['login_num']=$result[0]['login_num']+1;
				//保存登录时间
				$login_info['last_login'] = time();
				//将登录次数存入SESSION和表中
				$_SESSION['user']['login_num'] = $login_info['login_num'];
				include '../admin/Model/Model.class.php';
				$mysql = new Model('user');
				$mysql->where('id = '.$result[0]['id'])->update($login_info);
				// var_dump($_SERVER['HTTP_REFERER']);exit;
				header('location:./index.php');
				// var_dump($_SERVER['HTTP_REFERER']);
				// var_dump($_SESSION);
				}
			}
		}
		
		//登出操作
		function logout(){
			//清除客户端的cookie
			setcookie(session_name(),'',time(),'/');
			//清除客户端的session信息
			$_SESSION['user'] = array();
			header('location:./index.php');
		}

		//注册页面
		function reg(){
			include './View/reg.html';
		}

		//执行注册
		function do_reg(){
			unset($_POST['yz_code']);
			unset($_POST['phone_code']);
			//判断是否同意协议
			if (!isset($_POST['xieyi']) || $_POST['xieyi'] != 'on') {
				echo '<script>alert("请同意用户注册协议");location="./index.php?c=user&a=reg"</script>';
			}
			unset($_POST['xieyi']);
			//判断是否输入内容
			if ($_POST['username'] == '') {
				echo '<script>alert("请填写用户名");location="./index.php?c=user&a=reg"</script>';
			}
			if ($_POST['password'] == '' || $_POST['repassword'] == '') {
				echo '<script>alert("请填写密码");location="./index.php?c=user&a=reg"</script>';
			}
			//判断用户名是否重复
			//查询数据库中是否有该数据
			$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
			$pdo = new PDO($dsn,'root','');
			try {
				$sql = "SELECT * FROM user WHERE username = ?";
				$stmt = $pdo->prepare($sql);
				$display = 1;
				$stmt->bindParam(1,$_POST['username']);
				$stmt->execute();
				$result = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			if (!empty($result)) {
				echo '<script>alert("用户名已存在");location="./index.php?c=user&a=reg"</script>';
			}
			//判断两次密码是否一致
			if ($_POST['password'] != $_POST['repassword']) {
				echo '<script>alert("两次密码不一致");location="./index.php?c=user&a=reg"</script>';
			}
			$password = md5($_POST['password']);
			unset($_POST['repassword']);
			
			//存入数据库
			if ($_POST['phone'] == '') {
				unset($_POST['phone']);
			}
			// var_dump($_POST);
			try {
				$sql = "INSERT INTO user(username,password,level,addtime) VALUES(:username,:password,:level,:addtime)";
				$stmt = $pdo->prepare($sql);
				$level = 0;
				$time = time();
				$stmt->bindParam('username',$_POST['username']);
				$stmt->bindparam('password',$password);
				$stmt->bindParam('level',$level);
				$stmt->bindParam('addtime',$time);
				$result = $stmt->execute();
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			if ($result) {
				echo '<script>alert("注册成功");location="./index.php?c=user&a=login"</script>';
				// header('location:');
			}
		}

		//用户个人信息
		function info(){
			$this->is_login();
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM userinfo WHERE uid = ?";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(1,$_SESSION['user']['id']);
				$stmt->execute();
				$info = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			return $info;
			// var_dump($info);
			// include './View/userinfo.html';
		}

		//添加用户信息
		function add(){
			include '../admin/Model/Model.class.php';
			include '../admin/Org/Upload.class.php';
			//判断必填内容是否为空
			if ($_POST['name'] == '') {
				echo '<script>alert("请填写真实姓名");location="./index.php?c=user&a=info"</script>';
			}
			if ($_POST['address'] == '') {
				echo '<script>alert("请填写地址");location="./index.php?c=user&a=info"</script>';
			}
			if ($_POST['phone'] == '') {
				echo '<script>alert("请填写手机号码");location="./index.php?c=user&a=info"</script>';
			}
			// var_dump($_GET);
			// var_dump($_FILES);
			$mysql = new Model('userinfo');
			//上传头像操作
			$upload = new Upload('pic','../public/uploads/head');
			$result = $upload->do_upload();
			//拼接条件
			if ($_POST['age'] == '') {
				unset($_POST['age']);
			}
			if ($_POST['email'] == '') {
				unset($_POST['email']);
			}
			$_POST['hobby'] = isset($_POST['hobby'])?implode(',',$_POST['hobby']):'';
			$_POST['uid'] = $_GET['id'];
			$_POST['pic'] = isset($result['name'])?$result['name']:'';
			// var_dump($_POST);
			//执行添加
			$result = $mysql->add($_POST);
			// echo $mysql->sql;exit;
			if ($result) {
				echo '<script>alert("添加用户详细信息成功！");location="./index.php?c=user&a=info"</script>';
			}else{
				echo '<script>alert("添加用户详细信息失败！");location="./index.php?c=user&a=info"</script>';
			}
		}

		//修改用户信息
		function do_update(){
			include '../admin/Model/Model.class.php';
			include '../admin/Org/Upload.class.php';
			$mysql = new Model('userinfo');
			// var_dump($_POST);
			// var_dump($_FILES);
			//上传头像操作
			$upload = $pic = new Upload('pic','../public/uploads/head');
			$result = $upload->do_upload();
			//拼接条件
			if ($_POST['age'] == '') {
				unset($_POST['age']);
			}
			if ($_POST['email'] == '') {
				unset($_POST['email']);
			}
			$_POST['hobby'] = isset($_POST['hobby'])?implode(',',$_POST['hobby']):'';
			// $_POST['uid'] = $_GET['id'];
			$_POST['pic'] = isset($result['name'])?$result['name']:'';
			
			//判断是否修改头像
			if ($_POST['pic'] == '') {
				unset($_POST['pic']);
			}else{
				unlink($_POST['y_pic']);
			}
			// var_dump($_POST);exit;
			//执行修改
			$result = $mysql->where('uid = '.$_GET['id'])->update($_POST);
			// echo $mysql->sql;exit;
			if ($result) {
				echo '<script>alert("修改详细信息成功！");location="./index.php?c=user"</script>';
			}else{
				echo '<script>alert("修改详细信息成功！");location="./index.php?c=user"</script>';
			}
		}

		//用户订单
		function order(){
			//判断是否登录
			$this->is_login();
			include '../admin/Model/Model.class.php';
			$mysql = new Model('orders');
			$sql = "SELECT orders.uid,orders.linkman,orders.addtime,orders.status,orders.total,orderinfo.gid,orderinfo.gname,orderinfo.oid,orderinfo.gnum,goods.pic FROM (orders LEFT JOIN orderinfo ON orders.id=orderinfo.oid) LEFT JOIN goods ON orderinfo.gid=goods.id WHERE orders.uid = {$_SESSION['user']['id']} AND orders.is_del = 0 ORDER BY addtime DESC;";
			$result = $mysql->query($sql);
			// echo $mysql->sql;
			// var_dump($result);
			

			//友情链接
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM link WHERE display = ?";
				$stmt = $pdo->prepare($sql);
				$display = 1;
				$stmt->bindParam(1,$display);
				$stmt->execute();
				$linklist = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}


			include './View/order.html';
		}

		//订单详情页
		function orderinfo(){
			// var_dump($_GET);
			//查orders表
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM orders WHERE id = ?";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(1,$_GET['id']);
				$stmt->execute();
				$order = $stmt->fetchAll(2);
				// var_dump($order);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			include '../admin/Model/Model.class.php';
			$mysql = new Model('orders');
			$sql = "SELECT orders.uid,orders.linkman,orders.addtime,orders.status,orders.total,orderinfo.gid,orderinfo.gname,orderinfo.oid,orderinfo.gnum,goods.pic,goods.price FROM (orders LEFT JOIN orderinfo ON orders.id=orderinfo.oid) LEFT JOIN goods ON orderinfo.gid=goods.id WHERE orders.id = {$_GET['id']} ORDER BY addtime DESC;";
			$result = $mysql->query($sql);
			// var_dump($result);

			include './View/order_info.html';
		}

		//申请友情链接
		function link(){
			// var_dump($_POST);
			$_POST['display'] = 0;
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "INSERT INTO link(name,address,display) VALUES(:name,:address,:display)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute($_POST);
				$result = $stmt->rowCount();
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			//判断结果
			if ($result) {
				echo '<script>alert("申请成功！请等待管理员审核");location="./index.php"</script>';
			}else{
				echo '<script>alert("申请失败！请联系管理员");location="./index.php"</script>';
			}
		}
	}