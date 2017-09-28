<?php
	// 商品控制器
	class GoodsController{
		function Index(){
			$where = 'is_del = 0';
			//判断是否有搜索
			if (isset($_GET['s']) && $_GET['s'] == 'search') {
				$where .= ' AND name like %'.$_GET['name'].'%';
			}
			$mysql = new Model('goods');
			//分页
			$total = $mysql->total();
			$page = new Paging($mysql->where($where)->total(),5);
			// echo $mysql->sql;exit;
			// var_dump($_GET);
			//查所有分类
			$type = new Model('type');
			$AllType = $type->order("CONCAT(path,id) ASC")->select();
			$result = $mysql->limit($page->Page())->where($where)->select();
			include './View/goods/list.html';
		}

		//添加页面
		function add(){
			$mysql = new Model('type');
			$AllType = $mysql->order("CONCAT(path,id) ASC")->select();
			// var_dump($type);
			$result[0]['pic'] = '';
			include './View/goods/form.html';
		}

		//执行添加操作
		function do_add(){
			// var_dump($_FILES);
			// var_dump($_POST);
			// 判断是否输入内容
			if ($_POST['name'] == '' || $_POST['price'] == '' || !is_array($_FILES['pic'])) {
				echo '<script>alert("请填写内容");location="./index.php?c=goods&a=add"</script>';
			}
			//上传图片
			$upload = new Upload('pic','../public/uploads/goods');
			$pic = $upload->do_upload();
			// var_dump($pic);
			//添加信息
			$_POST['pic'] = $pic['name'];
			$mysql = new Model('goods');
			$result = $mysql->add($_POST);
			// echo $mysql->sql;exit;
			if ($result) {
				echo '<script>alert("添加商品成功！");location="./index.php?c=goods"</script>';
			}else{
				echo '<script>alert("添加商品失败！");location="./index.php?c=goods&a=add"</script>';
			}
		}

		//上下架
		function state(){
			$mysql = new Model('goods');
			$result = $mysql->update($_GET);
			echo $mysql->sql;
			header('location:./index.php?c=goods');
		}

		//修改页面
		function edit(){
			$mysql = new Model('goods');
			$result = $mysql->where('id = '.$_GET['id'])->select();
			//查所有分类
			$type = new Model('type');
			$AllType = $type->order("CONCAT(path,id) ASC")->select();
			// var_dump($result);
			include './View/goods/form.html';
		}

		//执行修改操作
		function do_update(){
			// var_dump($_POST);
			// 判断是否输入内容
			if ($_POST['name'] == '' || $_POST['price'] == '' || !is_array($_FILES['pic'])) {
				echo '<script>alert("请填写内容");location="./index.php?c=goods&a=edit&id='.$_GET['id'].'"</script>';
			}
			//上传图片
			$upload = new Upload('pic','../public/uploads/goods');
			$pic = $upload->do_upload();
			$_POST['pic'] = isset($pic['name'])?$pic['name']:'';
			// var_dump($pic);
			//判断是否修改图片
			if ($_POST['pic'] == '') {
				unset($_POST['pic']);
			}else{
				unlink($_POST['y_pic']);
			}
			$mysql = new Model('goods');
			$result = $mysql->where('id = '.$_GET['id'])->update($_POST);
			// echo $mysql->sql;exit;
			if ($result) {
				echo '<script>alert("修改商品成功！");location="./index.php?c=goods"</script>';
			}else{
				echo '<script>alert("修改商品成功！");location="./index.php?c=goods"</script>';
			}
		}

		//删除操作
		function del(){
			$mysql = new Model('goods');
			$edit = ['is_del'=>1];
			$result = $mysql->where('id = '.$_GET['id'])->update($edit);
			if ($result) {
				echo '<script>alert("删除商品成功！");location="./index.php?c=goods&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("删除商品失败！");location="./index.php?c=goods&page='.$_GET['page'].'"</script>';
			}
		}

		// 已删除的列表
		function del_list(){
			$where = 'is_del = 1';
			//判断是否有搜索
			if (isset($_GET['s']) && $_GET['s'] == 'search') {
				$where .= ' AND name like %'.$_GET['name'].'%';
			}
			$mysql = new Model('goods');
			//分页
			$total = $mysql->where('is_del = 1')->total();
			$page = new Paging($mysql->where($where)->total(),5);
			// echo $mysql->sql;exit;
			// var_dump($_GET);
			//查所有分类
			$type = new Model('type');
			$AllType = $type->order("CONCAT(path,id) ASC")->select();
			$result = $mysql->limit($page->Page())->where($where)->select();
			include './View/goods/del_list.html';
		}

		//永久删除方法
		function wipe(){
			$mysql = new Model('goods');
			$data = $mysql->where('id = '.$_GET['id'])->field('pic')->select();
			$result = $mysql->del();
			if ($result) {
				unlink('../public/uploads/goods/'.$data[0]['pic']);
				echo '<script>alert("永久删除商品成功！");location="./index.php?c=goods&a=del_list&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("永久删除商品失败！");location="./index.php?c=goods&a=del_list&page='.$_GET['page'].'"</script>';
			}
		}

		//还原操作
		function restore(){
			$mysql = new Model('goods');
			$edit = ['is_del'=>0];
			$result = $mysql->where('id = '.$_GET['id'])->update($edit);
			if ($result) {
				echo '<script>alert("还原商品成功！");location="./index.php?c=goods&a=del_list&page='.$_GET['page'].'"</script>';
			}else{
				echo '<script>alert("还原商品失败！");location="./index.php?c=goods&a=del_list&page='.$_GET['page'].'"</script>';
			}
		}

		//调用不存在的方法时
		function __call($classname,$args){
			echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./">返回首页</a>';exit;
		}

	}