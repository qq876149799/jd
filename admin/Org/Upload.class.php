<?php
	class Upload{
		//成员属性
		public $pic;
		public $path;
		public $size;
		public $type;
		public $newImg='';
		public $newPath = '';
		public $pathInfo = array();
		//成员方法
		//构造方法  实现创建文件上传对象
		function __construct($pic,$path = './upload',$size = 500000,array $type = array('image/jpeg','image/png','image/gif')){
			$this->pic = $pic;
			$this->path = $path;
			$this->size = $size;
			$this->type = $type;
		}
		//执行文件上传
		public function do_upload(){
			if($this->fileError() !== true){
				return $this->fileError();
			}elseif($this->patternType() !== true){
				return $this->patternType();
			}elseif($this->patternSize() !== true){
				return $this->patternSize();
			}elseif($this->renameImg() !== true){
				return $this->renameImg();
			}else{
				//移动图片
				return $this->moveImg();
			}

		}

		//验证上传过程中是否有错误的方法
		protected function fileError(){
			if($_FILES[$this->pic]['error'] > 0){
				switch($_FILES[$this->pic]['error']){
					case 1:
						return '超过了pHP.ini配置文件中的upload_max_filesize设置的值';
					case 2:
						return '超过了HTML表单中设置的MAX_FILE_SIZE设置的值';
					case 3:
						return '只有部分文件被上传';
					case 4:
						return '没有文件上传';
					case 6:
						return '找不到临时目录';
					case 7:
						return '写入失败';
				}
			}
			return true;
		}
		//验证上传过程中类型是否符合要求
		protected function patternType(){
			if(!in_array($_FILES[$this->pic]['type'],$this->type)){
				return '类型不合法';
			}
			return true;
		}
		//验证上传过程中上传的图片大小是否符合
		protected function patternSize(){
			if($_FILES[$this->pic]['size'] > $this->size){
				return '文件上传过大';
			}
			return true;
		}
		//验证上传图片后保存的路径 和 图片重命名
		protected function renameImg(){
			do{
				//1.获取图片后缀
				$suffix = strrchr($_FILES[$this->pic]['name'],'.');
				//2.拼接图片名称
				$this->newName = md5(time().mt_rand(1,999).uniqid()).$suffix;
				//处理路径中最后的斜线
				$this->path = rtrim($this->path,'/').'/';
				// echo $this->path;
				//3.判断路径
				if(!file_exists($this->path)){
					mkdir($this->path,true);
				}
				//拼接完整的路径
				$this->newPath = $this->path.$this->newName;
			}while(file_exists($this->newPath));
			return true;
		}
		protected function moveImg(){
			//var_dump($_FILES);
			//echo $_FILES[$this->pic]['tmp_name'].'<br/>';
			//echo $this->newPath;exit;
			if(move_uploaded_file($_FILES[$this->pic]['tmp_name'],$this->newPath)){
				$this->pathInfo['pathInfo'] = $this->newPath;
				$this->pathInfo['path'] = $this->path;
				$this->pathInfo['name'] = $this->newName;
				return $this->pathInfo;
			}else{
				return false;
			}
		}
	}