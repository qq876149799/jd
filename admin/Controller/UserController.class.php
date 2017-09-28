<?php
	//用户操作
	class UserController{
		//等级数组
		const LEVEL = ['0'=>'普通会员','1'=>'普通管理员','2'=>'超级管理员','3'=>'禁用'];

		//查询所有用户
		function Index(){
			$where = 'is_del = 0';
			//判断是否有搜索
			if (isset($_GET['s']) && $_GET['s'] == 'search') {
				$where .= ' AND username like %'.$_GET['username'].'%';
			}
			$mysql = new Model('user');
			//分页
			$total = $mysql->total();
			$page = new Paging($mysql->where($where)->total(),5);
			// echo $mysql->sql;exit;
			// var_dump($_GET);
			$result = $mysql->limit($page->Page())->where($where)->select();
			include './View/user/list.html';
		}

		//添加页面
		function add(){
			include './View/user/form.html';
		}

		//执行添加操作
		function do_add(){
			// var_dump($_POST);
			// 判断是否输入内容
			if ($_POST['username'] == '') {
				echo  '<script>alert("请输入用户名");location="./index.php?c=user&a=add"</script>';
			}
			if ( $_POST['password'] == '') {
				echo  '<script>alert("请输入密码");location="./index.php?c=user&a=add"</script>';
			}
			if ( $_POST['repassword'] == '') {
				echo  '<script>alert("请输入重复密码");location="./index.php?c=user&a=add"</script>';
			}
			//判断两次密码是否一致
			if ($_POST['password'] != $_POST['repassword']) {
				echo '<script>alert("两次密码不一致");location="./index.php?c=user&a=add"</script>';
			}
			$_POST['password'] = md5($_POST['password']);
			$_POST['addtime'] = time();
			$mysql = new Model('user');
			$result = $mysql->add($_POST);
			if ($result) {
				echo '<script>alert("添加用户'.$_POST['username'].'成功！");location="./index.php?c=user"</script>';
			}else{
				echo '<script>alert("添加用户'.$_POST['username'].'失败！");location="./index.php?c=user&a=add"</script>';
			}
		}

		//执行删除操作
		function del(){
			$mysql = new Model('user');
			$edit = ['is_del'=>1];
			$result = $mysql->where('id = '.$_GET['id'])->update($edit);
			if ($result) {
				echo '<script>alert("删除用户成功！");location="./index.php?c=user&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("删除用户失败！");location="./index.php?c=user&page='.$_GET['page'].'"</script>';
			}
		}

		//修改页面
		function edit(){
			// var_dump($_GET);
			$mysql = new Model('user');
			$result = $mysql->where('id = '.$_GET['id'])->select();
			// echo $mysql->sql;
			// var_dump($result);
			include './View/user/form.html';
		}

		//执行修改操作
		function do_update(){
			// var_dump($_POST);
			$mysql = new Model('user');
			//判断内容是否为空
			if ($_POST['username'] == '') {
				echo '<script>alert("用户名不能为空");location="./index.php?c=user&a=edit&id='.$_GET['id'].'"</script>';
			}
			//判断是否修改密码
			if ($_POST['password'] == '' && $_POST['repassword'] == '') {
				//不修改密码则把数组中的密码项去掉
				unset($_POST['password']);
				unset($_POST['repassword']);
				// var_dump($_POST);exit;
				$result = $mysql->update($_POST);
			}else{
				//如果修改密码，则判断两次密码是否一致
				if ($_POST['password'] != $_POST['repassword']) {
					echo '<script>alert("两次密码不一致");location="./index.php?c=user&a=edit&id='.$_GET['id'].'"</script>';
				}
				$_POST['password'] = md5($_POST['password']);
				$result = $mysql->update($_POST);
			}
			//判断结果
			if ($result) {
				echo '<script>alert("修改用户'.$result[0]['username'].'的信息成功！");location="./index.php?c=user&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("修改用户'.$result[0]['username'].'的信息成功！");location="./index.php?c=user&page='.$_GET['page'].'"</script>';
			}
		}

		//用户详情页面
		function info(){
			// var_dump($_GET);
			//要查询单个用户在userinfo表中的数据
			$mysql = new Model('user');
			// SELECT user.id,userinfo.uid,username,name,sex,phone,email,pic,hobby,address FROM user,userinfo WHERE userinfo.uid = user.id and userinfo.uid='3';
			$result = $mysql->where('userinfo.uid = user.id AND userinfo.uid = '.$_GET['id'])->field('user.id,username,name,age,sex,phone,email,pic,hobby,address')->d_select('user','userinfo');
			// var_dump($result);
			if ($result) {
				//有值，定义字段
				$title = '查看用户详情';
				$action = 'update_info';
				$submit = '修改数据';
				//拿数据
				// var_dump($result);
			}else{
				//没值，那么重新查询拿到username
				$mysql= new Model('user');
				$result = $mysql->select();
				// echo $mysql->sql;
				//定义字段
				// echo '<script>alert("该用户没有详情，请添加")</script>';
				$title = '添加用户详情';
				$action = 'add_info';
				$submit = '添加数据';
			}
			//拼接头像路径
			$result[0]['pic'] = isset($result[0]['pic'])?'../public/uploads/head/'.$result[0]['pic']:'';
			include './View/user/user_info.html';
		}

		//执行添加用户详情
		function add_info(){
			//判断必填内容是否为空
			if ($_POST['name'] == '') {
				echo '<script>alert("请填写真实姓名");location="./index.php?c=user&a=info&id='.$_GET['id'].'&page='.$_GET['page'].'"</script>';
			}
			if ($_POST['address'] == '') {
				echo '<script>alert("请填写地址");location="./index.php?c=user&a=info&id='.$_GET['id'].'&page='.$_GET['page'].'"</script>';
			}
			if ($_POST['phone'] == '') {
				echo '<script>alert("请填写手机号码");location="./index.php?c=user&a=info&id='.$_GET['id'].'&page='.$_GET['page'].'"</script>';
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
				echo '<script>alert("添加用户'.$result[0]['username'].'的详细信息成功！");location="./index.php?c=user&a=info&id='.$_GET['id'].'&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("添加用户'.$result[0]['username'].'的详细信息失败！");location="./index.php?c=user&a=info&id='.$_GET['id'].'&page='.$_GET['page'].'"</script>';
			}
		}

		//执行修改用户详情
		function update_info(){	
			// var_dump($_GET);
			// var_dump($_FILES);
			$mysql = new Model('userinfo');
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
				echo '<script>alert("修改用户'.$result[0]['username'].'的详细信息成功！");location="./index.php?c=user&a=info&id='.$_GET['id'].'&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("修改用户'.$result[0]['username'].'的详细信息成功！");location="./index.php?c=user&a=info&id='.$_GET['id'].'&page='.$_GET['page'].'"</script>';
			}
		}

		//已删除的列表
		function del_list(){
			$where = 'is_del = 1';
			//判断是否有搜索
			if (isset($_GET['s']) && $_GET['s'] == 'search') {
				$where .= ' AND username like %'.$_GET['username'].'%';
			}
			$mysql = new Model('user');
			//分页
			$total = $mysql->where('is_del = 1')->total();
			$page = new Paging($mysql->where($where)->total(),5);
			// echo $mysql->sql;exit;
			// var_dump($_GET);
			$result = $mysql->limit($page->Page())->where($where)->select();
			include './View/user/del_list.html';
		}

		//永久删除方法
		function wipe(){
			error_reporting(E_ALL &~E_NOTICE);
			$mysql = new Model('user');
			$userinfo = new Model('userinfo');
			$m = $userinfo->where('uid = '.$_GET['id'])->field('pic')->select();
			// var_dump($m);
			$result = $mysql->where('id = '.$_GET['id'])->del();
			

			$result1 = $userinfo->where('pid = '.$_GET['id'])->del();
			if ($result) {
				if (!empty($m[0]['pic'])) {
					unlink('../public/uploads/head/'.$m[0]['pic']);
				}
				echo '<script>alert("永久删除用户成功！");location="./index.php?c=user&a=del_list&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("永久删除用户失败！");location="./index.php?c=user&a=del_list&page='.$_GET['page'].'"</script>';
			}
		}

		//还原用户
		function restore(){
			$mysql = new Model('user');
			$edit = ['is_del'=>0];
			$result = $mysql->where('id = '.$_GET['id'])->update($edit);
			if ($result) {
				echo '<script>alert("还原用户成功！");location="./index.php?c=user&a=del_list&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("还原用户失败！");location="./index.php?c=user&a=del_list&page='.$_GET['page'].'"</script>';
			}
		}
		
		//调用不存在的方法时
		function __call($classname,$args){
			echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./">返回首页</a>';exit;
		}
	}