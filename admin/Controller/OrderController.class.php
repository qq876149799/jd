<?php
	class OrderController{
		function Index(){
			$order = new Model('orders');
			//分页
			$total = $order->where('is_del = 0')->total();
			$result = $order->field('user.username,orders.id,orders.status,orders.total,orders.linkman')->where('orders.uid = user.id and orders.is_del = 0')->d_select('orders','user');
			// var_dump($result);
			// echo $order->sql;exit;
			
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

			
			include './View/order/list.html';
		}

		//操作状态页面
		function edit(){
			// var_dump($_GET);
			$mysql = new Model('orders');
			$result = $mysql->where('id = '.$_GET['id'])->select();
			// var_dump($result);
			include './View/order/form.html';
		}

		//执行修改状态
		function do_update(){
			// var_dump($_POST);
			$mysql = new Model('orders');
			$result = $mysql->update($_POST);
			// echo $mysql->sql;exit;
			if ($result) {
				echo '<script>alert("操作成功");location="./index.php?c=order"</script>';
			}else{
				echo '<script>alert("操作失败");location="./index.php?c=order&aedit"</script>';
			}
		}

		//删除订单
		function del(){
			$mysql = new Model('orders');
			$update = array(
				'is_del'=>1,
				'status'=>4
				);
			$result = $mysql->where('id = '.$_GET['id'])->update($update);

			if ($result) {
				echo '<script>alert("操作成功");location="./index.php?c=order"</script>';
			}else{
				echo '<script>alert("操作失败");location="./index.php?c=order"</script>';
			}
		}

		//订单详情
		function info(){
			$mysql = new Model('orders');
			// $result = $mysql->where('id = '.$_GET['id'])->select();
			// var_dump($result);
			// $mysql = new Model('orders');
			$sql = "SELECT orderinfo.price,orderinfo.gid,orderinfo.gname,orderinfo.oid,orderinfo.gnum,goods.pic FROM (orders LEFT JOIN orderinfo ON orders.id=orderinfo.oid) LEFT JOIN goods ON orderinfo.gid=goods.id WHERE orderinfo.oid = {$_GET['id']}";
			$result = $mysql->query($sql);
			// var_dump($result);
			include './View/order/info.html';
		}

		//订单回收站
		function del_list(){
			$mysql = new Model('orders');
			//分页
			$total = $mysql->where('is_del = 1')->total();
			$page = new Paging($mysql->where('is_del = 1')->total(),5);
			$result = $mysql->limit($page->Page())->where('is_del = 1')->select();
			// var_dump($result);
			include './View/order/del_list.html';
		}

		//永久删除方法
		function wipe(){
			var_dump($_GET);
			$order = new Model('orders');
			$info = new Model('orderinfo');
			$result = $order->where('id = '.$_GET['id'])->del();
			$result1 = $info->where('oid like '.$_GET['id'])->del();
			if ($result && $result1) {
				echo '<script>alert("永久删除订单成功");location="./index.php?c=order&a=del_list"</script>';
			}else{
				echo '<script>alert("永久删除订单失败");location="./index.php?c=order&a=del_list"</script>';
			}
		}
		
		//调用不存在的方法
		function __call($classname,$args){
			echo '<font color="deepred" size="15px">404NotFound<br>该页面不存在</font><br><a href="./">返回首页</a>';exit;
		}

	}