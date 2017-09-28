<?php 
/*
	分页类。			by：康维			
	page方法返回limit中的两个参数（越过几条，显示几条）
	Example:$one = new Paging(m,n);
			$one->show();
																								2017年9月11日 23:20:17

*/
	class Paging{
		private $page;	//每页显示多少条
		private $total;	//总条数
		private $AllPage;	//总页数
		public $dpage;	//当前页
		public $num;	//越过多少条
		private $lastPage;	//上一页数组
		private $nextPage;	//下一页数组
		private $indexPage;	//首页数组
		private $endPage;	//尾页数组
		public $surl;	//url路径
		function __construct($total,$page='5'){
			//初始化每页显示多少条
			$this->page = $page;
			//初始化总条数
			$this->total = $total;
			//计算总页数
			$this->AllPage = ceil($this->total / $this->page);
			//当前页
			$this->dpage = isset($_GET['page'])?$_GET['page']:$_GET['page']=1;
			//调用处理页数操作
			$this->page();
		}
		//显示效果
		function show(){
			//拼接url地址
			$indexPage = http_build_query($this->indexPage);
			$lastPage =  http_build_query($this->lastPage);
			$nextPage = http_build_query($this->nextPage);
			$endPage = http_build_query($this->endPage);

			echo '&nbsp;<a href="?'.$indexPage.'">首页</a>&nbsp;&nbsp;
				<a href="?'.$lastPage.'">上页</a>&nbsp;&nbsp;
				'.$this->dpage.'/'.$this->AllPage.'页&nbsp;&nbsp;
				<a href="?'.$nextPage.'">下页</a>&nbsp;&nbsp;
				<a href="?'.$endPage.'">尾页</a>';
		}
		//处理页的操作
		function page(){
			//初始化url参数
			if (empty($_GET['page'])) {
				$this->lastPage['page']= $this->nextPage['page'] = 1;
			}else{
				$this->lastPage = $this->nextPage = $this->indexPage = $this->endPage = $_GET;
			}
			//处理上一页
			$this->lastPage['page'] = $this->dpage-1<=1?1:$this->dpage-1;
			//处理下一页
			$this->nextPage['page'] = $this->dpage+1>$this->AllPage?$this->AllPage:$this->dpage+1;
			//处理首页
			$this->indexPage['page'] = 1;
			//处理尾页
			$this->endPage['page'] = $this->AllPage;

			$this->num = ($this->dpage-1)*$this->page;
			return $this->num.','.$this->page;
		}
	}
 ?>