<?php
	class GoodsController{
		function Index(){
			/*******************************分页效果****************************************/
			//1.链接和选择数据库
			$link = mysqli_connect('localhost','root','','ty06project') or die("链接或者选择数据库失败");
			//2.设置字符集
			mysqli_set_charset($link,'utf8');
			
			//1.定义每页显示多少条
			$page = 12;
			//2求出总页数
				//2.1获取总条数
				//判断是否有分类
				if (!isset($_GET['id'])) {
					//没有分类
					$sql = "SELECT * FROM goods WHERE state = 1";
				}else{
					//y有分类
					$id = $_GET['id'];
					$sql = "SELECT * FROM goods WHERE state = 1 AND pid in(SELECT id FROM type WHERE `path` like '%{$id}%') or pid = {$id}";
				}
				$result = mysqli_query($link,$sql);
				$total = mysqli_num_rows($result);  
				//2.2求出总页数
				$pageAll = ceil($total / $page); 

			//3.必须获取当前页
			$dpage = isset($_GET['page'])?$_GET['page']:1;
			//4.处理上一页
			$prePage = $dpage-1<=1?1:($dpage-1);
			//5.处理下一页
			$nextPage = $dpage+1 >= $pageAll?$pageAll:($dpage+1);
			//6.通过页数 制定  limit条件  越过多少条
				$num = ($dpage-1)*$page;
			//7.拼接limit语句
				$limit = " LIMIT {$num},{$page}";
			/********************************分页效果结束****************************************/


			//查询数据
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				//判断是否点击分类
				if (!isset($_GET['id'])) {
					//查所有
					$sql = "SELECT * FROM goods WHERE state = :state ORDER BY id DESC {$limit}";
					$stmt = $pdo->prepare($sql);
					$state = 1;
					$stmt->bindParam('state',$state);
					
				}else{
					//条件查询
					//SELECT id FROM type WHERE path like :path  是模糊查询当前类id下的所有子类（不管几级）
					$sql = "SELECT * FROM goods WHERE state = :state AND pid in(SELECT id FROM type WHERE path like :path) or pid=:id ORDER BY id DESC {$limit}";
					$stmt = $pdo->prepare($sql);
					$state = 1;
					$id = $_GET['id'];
					$stmt->bindParam(':state',$state);
					$stmt->bindValue(':path','%'.$id.'%',PDO::PARAM_STR);
					$stmt->bindParam(':id',$id);

				}
				$stmt->execute();
				$goods = $stmt->fetchAll(2);
				// var_dump($goods);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
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

			//引入页面
			include './View/list.html';
		}

		//商品详情
		function info(){
			//判断是否点击商品
			if (!isset($_GET['id'])) {
				echo '<script>alert("请选择要查看的商品");location="./index.php?c=goods"</script>';
			}
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM goods WHERE id = ?";
				$stmt = $pdo->prepare($sql);
				$id = $_GET['id'];
				$stmt->bindparam(1,$id);
				$stmt->execute();
				$goodsinfo = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
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

			
			// var_dump($goodsinfo);
			include './View/goods_info.html';
		}
	}
	
