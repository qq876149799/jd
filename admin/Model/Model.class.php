<?php
/** ******************************************************************************
 * Model 2.1 数据库类，该类可以对数据库中的内容进行增删改查                      *
 * *******************************************************************************
 * $Author: 康维                                                                 *
 * $Date: 2017年9月7日 22:59:21                                                  * 
 * *******************************************************************************/
	class Model{
		protected $host;
		protected $user;
		protected $pwd;
		protected $charset;
		protected $dbName = DBNAME;
		protected $tableName;
		protected $link;	//连接数据库后的对象
		public $sql;		//存储sql语句，用来排错
		public $field = array();		//存储字段
		protected $pk;		//存储主键
		protected $con = ['where','order','limit','field'];		//条件
		protected $Sfield;		//存储要查询的字段
		protected $where;	//存储where条件
		protected $limit;	//存储limit条件
		protected $order;	//存储order条件

		function __construct($tablename = ''){
			$this->host = HOST;
			$this->user = USER;
			$this->pwd = PWD;
			$this->charset = CHARSET;
			if ($tablename == '') {
				//表名没有传入，有可能是继承关系
				$this->tableName = strtolower(substr(get_class($this),0,-5));
			}else{
				$this->tableName = $tablename;
			}
			//调用连接数据库的方法
			$this->link = $this->connect();
			$this->field = $this->getField();
		}

		//连接数据库
		protected function connect(){
			$link = @mysqli_connect($this->host,$this->user,$this->pwd,$this->dbName);
			if (mysqli_connect_errno($link)) {
				echo '数据库连接失败，请检查配置文件';
			}
			mysqli_set_charset($link,$this->charset);
			return $link;
		}

		//获取所有字段
		function getField(){
			$sql = "DESC {$this->tableName}";
			$result = $this->query($sql);
			// var_dump($result);
			for ($i=0; $i < count($result); $i++) { 
				if ($result[$i]['Key'] == 'PRI') {
					//保存主键
					$this->pk = $result[$i]['Field'];
					$this->field[] = $result[$i]['Field']; 
				}else{
					$this->field[] = $result[$i]['Field']; 
				}
			}
			return $this->field;
		}

		//增加数据
		function add($data){
			// var_dump($data);
			//过滤字段
			$keys = $vals = '';
			//判断要插入的数据的字段是否合法
			foreach ($data as $key => $value) {
				if (in_array($key,$this->field)) {
					$keys .= '`'.$key.'`,';
					$vals .= '\''.$value.'\',';
				}
			}
			//去除最后的逗号
			$keys = rtrim($keys,',');
			$vals = rtrim($vals,',');
			$sql = "INSERT INTO {$this->tableName}($keys) VALUES($vals)";
			// echo $sql;exit;
			$this->sql = $sql;
			return $this->execute($sql);
		}

		//删除数据
		function del($where=''){
			//判断是否有where条件
			if (!empty($where)) {
				$where = ' WHERE '.$where;
			}else{
				//为空，则判断get数组里是否有删除
				if (!empty($_GET)) {
					//遍历get数组
					foreach ($_GET as $k => $v) {
						if ($this->pk == $k) {
							$val =$v;
						}
					}
					$where = 'WHERE '.$this->pk.'='.$val;
				}else{
					return false;
				}
			}

			$sql = "DELETE FROM {$this->tableName} {$where}";
			// echo $sql;exit;
			$this->sql = $sql;
			return $this->execute($sql);
		}

		//修改数据
		function update($data){
			// var_dump($data);
			//过滤数据字段并拼接数据
			$cons = '';
			foreach ($data as $key => $value) {
				if (in_array($key,$this->field)) {
					//拼接数据
					$cons .= '`'.$key.'`=\''.$value.'\',';
				}
			}
			//去掉最后逗号
			$cons = rtrim($cons,',');
			// echo $cons;
			// 判断where条件
			if (!empty($this->where)) {
				$where = 'WHERE '.$this->where;
			}else{
				//没有where条件 则从get数组中获取
				// var_dump($_GET);
				if (!empty($_GET)) {
					//遍历get数组
					foreach ($_GET as $k => $v) {
						if ($this->pk == $k) {
							$val =$v;
						}
					}
					$where = 'WHERE '.$this->pk.'='.$val;	
				}else{
					return false;
				}
			}
			$sql = "UPDATE {$this->tableName} SET {$cons} {$where}";
			// echo $sql;exit;
			$this->sql = $sql;
			return $this->execute($sql);
		}

		//查询数据
		function select(){
			//初始化条件
			$where = $limit = $order = $Sfield = '';
			//拼接条件
			if (!empty($this->where)) {
				// 拼接查询条件的引号
				$arr = explode(' ',$this->where);
				$arr[count($arr)-1] = '\''.$arr[count($arr)-1].'\'';
				// var_dump($arr);
				$this->where = implode(' ',$arr);
				$where = ' WHERE '.$this->where;
			}
			if(!empty($this->limit)){
				$limit = ' LIMIT '.$this->limit;
			}
			if(!empty($this->order)){
				$order = ' ORDER BY '.$this->order;
			}
			//判断是否查询指定字段
			if (!empty($this->Sfield)) {
				$Sfield = $this->Sfield[0];
			}else{
				$Sfield = implode(',',$this->field);
			}

			$sql = "SELECT {$Sfield} FROM {$this->tableName} {$where} {$order} {$limit}";
			$this->sql = $sql;
			return $this->query($sql);
		}

		//多表联查
		function d_select($tabname1,$tabname2){
			//初始化条件
			$where = $limit = $order = $Sfield = '';
			//拼接条件
			if (!empty($this->where)) {
				// 拼接查询条件的引号
				$arr = explode(' ',$this->where);
				$arr[count($arr)-1] = $arr[count($arr)-1];
				// var_dump($arr);
				$this->where = implode(' ',$arr);
				$where = ' WHERE '.$this->where;
			}
			if(!empty($this->limit)){
				$limit = ' LIMIT '.$this->limit;
			}
			if(!empty($this->order)){
				$order = ' ORDER BY '.$this->order;
			}
			//判断是否查询指定字段
			if (!empty($this->Sfield)) {
				$Sfield = $this->Sfield[0];
			}else{
				$Sfield = implode(',',$this->field);
			}
			$sql = "SELECT {$Sfield} FROM {$tabname1},{$tabname2} {$where} {$order} {$limit}";
			// echo $sql;exit;
			$this->sql = $sql;
			return $this->query($sql);
		}

		//统计总条数
		function total(){
			$where = '';
			//检测是否有where条件
			if (!empty($this->where)) {
				// 拼接查询条件的引号
				$arr = explode(' ',$this->where);
				$arr[count($arr)-1] = $arr[count($arr)-1];
				// var_dump($arr);
				$this->where = implode(' ',$arr);
				$where = ' WHERE '.$this->where;
			}
			
			$sql = "SELECT COUNT(*) as total FROM {$this->tableName} {$where}";
			// echo $sql;exit;
			$this->sql = $sql;
			$total = $this->query($sql);
			return $total[0]['total'];
		}

		//调用不存在的方法  用于limit  where order field
		function __call($name,$vals){
			if(in_array($name,$this->con) && !empty($vals)){
				//判断where条件
				if ($name == 'where') {
					$this->where = $vals[0];
					// echo $this->where;
				}
				//判断order条件
				if ($name == 'order') {
					$this->order = $vals[0];
				}
				//判断字段条件
				if ($name == 'field') {
					$this->Sfield = $vals;
				}
				//判断limit条件
				if ($name == 'limit') {
					if (count($vals)>1) {
						$this->limit = $vals[0].','.$vals[1];
					}else{
						$this->limit = $vals[0];
					}
				}
			}
			return $this;
		}

		//用于发送查询语句并返回值
		function query($sql){
			$result = mysqli_query($this->link,$sql);
			$arr = array();
			if ($result && mysqli_num_rows($result)) {
				while ($row = mysqli_fetch_assoc($result)) {
					$arr[] = $row;
				}
			}
			return $arr;
		}

		//用于发送增删改语句并返回值
		function execute($sql){
			$result = mysqli_query($this->link,$sql);
			if ($result && mysqli_affected_rows($this->link)) {
				return  mysqli_insert_id($this->link)?mysqli_insert_id($this->link):mysqli_affected_rows($this->link);
			}else{
				return false;
			}
		}

		//类的使用方法  echo对象即可出现
		function __toString(){
			$manual = <<<EOF
			<span style="color:red"><b>Model 2.0 数据库操作类</b></span><br>
				<span style="color:blue">实例化对象时可直接连接到数据库、获取到所有字段名（注意配置文件）</span><br>
				<span style="color:green">Example</span>:<br>
		1、添加<br>
		\$data = array('username'=>'强强','passwd'=>123456,'addtime'=>\$time,'memeda'=>'heiehi');
		　　　//自动排除表字段中没有的字段<br/>
		\$result = \$test->add(\$data);　　　//添加成功返回id，失败返回false<br><br>
		2、修改<br>
		\$data = array('username'=>'测试','passwd'=>1234566,'addtime'=>\$time,['id'=>35]);　　　//如没有传id条件，则自动从get中获取id条件<br>
		\$result = \$test->update(\$data);　　　//成功返回true，失败返回false<br><br>
		3、查询<br>
		\$test->[where()]->[order()]->[limit()]->select();　　　//where直接输入条件即可，自动拼接where 关键字<br><br>
		4、删除<br>
		\$test->del([id=1]);　　　//使用时必须传入删除条件，否则会删除整个表中的数据<br>如没有输入where条件会自动调取get中的id值，如get中也没有id值，则删除整张表中的所有数据<br>
		5、获取字段<br>
		\$test->field();　　　//实例化对象时自动获取表内字段（除主键外）<br>
		\$test->pk();　　　//获取主键
EOF;
			return $manual;
		}
	}
