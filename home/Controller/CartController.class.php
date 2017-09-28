<?php
	//购物车控制器
	class CartController{
		function Index(){
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
			include './View/cart.html';
		}

		//加入购物车
		function add(){	
			// var_dump($_GET);
			if (!empty($_GET['id'])) {

				//有值说明添加购物
				if (!empty($_SESSION['cart'][$_GET['id']])) {
					//设置了，说明第二次进来
					$_SESSION['cart'][$_GET['id']]['gnum'] +=1;
					header('location:./index.php?c=cart&a=index');exit;
				}
				//从数据库中拿商品
				try {
					$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
					$pdo = new PDO($dsn,'root','');
					//通过SQL语句查询出你要添加商品的所有信息
					$sql="SELECT * FROM goods WHERE id=:id";
					$stmt=$pdo->prepare($sql);
					$gid = $_GET['id'];
					$stmt->bindParam(':id',$gid);
					$stmt->execute();
					$result = $stmt->fetchAll(2);
				} catch (PDOException $e) {
					file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
				}
				if ($result) {
					// var_dump($result);
					//查到东西，说明商品存在，存入SESSION
					$_SESSION['cart'][$_GET['id']] = $result[0];
					//购买数量
					$_SESSION['cart'][$_GET['id']]['gnum'] = 1;
				}
				// var_dump($_SESSION);
				echo '<script>alert("添加购物车成功");location="./index.php?c=cart"</script>';
			}else{
				//没值说明没有添加购物车
				include './View/cart.html';
			}
		}

		//加减操作
		function yunsuan(){
			if(isset($_GET['id']) && $_GET['gnum']){
				//实现数量的更改
				//先查询库存
				try {
					$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
					$pdo = new PDO($dsn,'root','');
					//通过SQL语句查询出你要添加商品的所有信息
					$sql="SELECT num FROM goods WHERE id=:id";
					$stmt=$pdo->prepare($sql);
					$gid = $_GET['id'];
					$stmt->bindParam(':id',$gid);
					$stmt->execute();
					//商品总库存
					$result = $stmt->fetchAll(2)[0]['num'];
				} catch (PDOException $e) {
					file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
				}

				$_SESSION['cart'][$_GET['id']]['gnum']+=$_GET['gnum'];
				if($_SESSION['cart'][$_GET['id']]['gnum'] <= 1){
					$_SESSION['cart'][$_GET['id']]['gnum'] = 1;
				}
				if ($_SESSION['cart'][$_GET['id']]['gnum'] > $result) {
					$_SESSION['cart'][$_GET['id']]['gnum'] = $result;
					echo '<script>alert("购买数量超过最大库存");location="./index.php?c=cart"</script>';exit;
				}
				header('location:./index.php?c=cart');
			}
			
		}

		//清空购物车
		function clear(){
			unset($_SESSION['cart']);
			header('location:./index.php?c=cart');
		}

		//删除购物车
		function del(){
			if (!isset($_GET['id'])) {
				echo '<script>alert("请选择要删除的商品");location="./index.php?c=cart"</script>';
			}
			unset($_SESSION['cart'][$_GET['id']]);
			header('location:./index.php?c=cart');
		}
	}