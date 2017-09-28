<?php
	class IndexController{
		function Index(){
			//分类
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM type WHERE display = ?";
				$stmt = $pdo->prepare($sql);
				$display = 1;
				$stmt->bindparam(1,$display);
				$stmt->execute();
				$sanji = $Type = $AllType = $stmt->fetchAll(2);
			} catch (PDOException $e) {
				file_put_contents('./errors.txt',$e->getMessage(),FILE_APPEND);
			}
			
			//商品
			try {
				$dsn = 'mysql:host=localhost;dbname=ty06project;charset=utf8';
				$pdo = new PDO($dsn,'root','');
				$sql = "SELECT * FROM goods WHERE state = ?";
				$stmt = $pdo->prepare($sql);
				$state = 1;
				$stmt->bindParam(1,$state);
				$stmt->execute();
				$result = $stmt->fetchAll(2);
				// var_dump($result);
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
			include './View/index.html';
		}
	}