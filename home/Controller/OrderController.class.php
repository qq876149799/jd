<?php
	//订单控制器
	class OrderController{
		function is_login(){
			//判断是否登录
			if(empty($_SESSION['user'])){
				//没有登录信息
				echo '<script>alert("请登录后再进行操作");location="./index.php?c=user&a=login"</script>';
			}
		}



		//结算订单
		function jiesuan(){
			$this->is_login();
			// var_dump($_POST);
			if (!isset($_POST['id'])) {
				//没值则结算所有
				$_POST['id'] = array();
				foreach ($_SESSION['cart'] as $value) {
					$_POST['id'][] = $value['id'];
				}
			}
			include './View/order_jiesuan.html';
		}

		//生成订单
		function do_add(){
			$this->is_login();
			
			//生成订单ID号
			$_POST['id'] = date('YmdHis',time()).mt_rand(10,99);
			$time = time();
			// var_dump($_POST);
			
			// 制作orders所需数组
			$orders = array(
				'id'=>$_POST['id'],
				'uid'=>$_POST['uid'],
				'linkman'=>$_POST['linkman'],
				'address'=>$_POST['address'],
				'phone'=>$_POST['phone'],
				'postcode'=>$_POST['postcode'],
				'total'=>$_POST['total'],
				'status'=>$_POST['status'],
				'addtime'=>$time
				);

			//写入order表
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "INSERT INTO orders(id,uid,linkman,address,phone,postcode,total,`status`,addtime) VALUES(:id,:uid,:linkman,:address,:phone,:postcode,:total,:status,:addtime)";
				$stmt = $pdo->prepare($sql);
				$is_del = 0;
				$result = $stmt->execute($orders);
				// echo $sql;
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}


			//制作订单详情表所需数组
				//拆分商品id
			$a = explode(',',$_POST['goodsid']);
			foreach ($a as $val) {
				$info[] = array(
					'oid'=>$_POST['id'],
					'gid'=>$val,
					'gname'=>$_SESSION['cart'][$val]['name'],
					'price'=>$_SESSION['cart'][$val]['price'],
					'gnum'=>$_SESSION['cart'][$val]['gnum'],
					'uid'=>$_SESSION['user']['id'],
					'addtime'=>$time
					);
			}
			// var_dump($info);
			

			// 循环写入orderinfo表
			foreach ($info as $value) {
				try {
					$sql = "INSERT INTO orderinfo(`oid`,gid,gname,price,gnum,uid,addtime) VALUES(:oid,:gid,:gname,:price,:gnum,:uid,:addtime)";
					$stmt = $pdo->prepare($sql);
					$result1 = $stmt->execute($value);
				} catch (PDOException $e) {
					file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
				}
			}
			// var_dump($result);exit;

			//处理订单提交结果
			if ($result && $result1) {
				//删除购物车商品
				foreach ($a as $val) {
					unset($_SESSION['cart'][$val]);
				}
				header('location:./View/order_jump.html');
			}else{
				echo '<script>alert("订单提交失败");location="./index.php?c=cart"</script>';
			}
			
		}

		//支付操作
		function to_pay(){
			// var_dump($_GET);
			//修改订单状态
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "UPDATE orders SET `status`= ? WHERE id={$_GET['id']}";
				$stmt = $pdo->prepare($sql);
				$status = 1;
				$stmt->bindParam(1,$status);
				$result = $stmt->execute();
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			if ($result) {
				header('location:./View/to_pay.html');
			}else{
				echo '<script>alert("支付失败");location="./index.php?c=user&a=order"</script>';
			}
		}

		//确认收货操作
		function confirm(){
			var_dump($_GET);
			//修改订单状态
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "UPDATE orders SET `status`= ? WHERE id={$_GET['id']}";
				$stmt = $pdo->prepare($sql);
				$status = 3;
				$stmt->bindParam(1,$status);
				$result = $stmt->execute();
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			if ($result) {
				echo '<script>alert("收货成功");location="./index.php?c=user&a=order"</script>';
			}else{
				echo '<script>alert("收货失败");location="./index.php?c=user&a=order"</script>';
			}
		}
	}