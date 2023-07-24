<?php
	class StationController {
		private $model;
		
		function __construct($model){
			$this->model = $model;
		}
		
		public function lst(){
			$this->model->get_list();
		}
		public function add(){ 
			$this->model->gen_form('', '', '', '', '', 0, 0, 0, 0);
		}
		public function edit(){ 
			$tid = (isset($_GET["tid"])&& is_numeric($_GET["tid"]))?$_GET["tid"]:0;
			$page = !isset($_GET['page'])||!is_numeric($_GET['page'])?1:$_GET['page'];
			
			if($tid >0)
			{
				$row = mysql_fetch_array($this->model->pro_tid($tid)); 
				$this->model->gen_form($row["tbl_tentram"], $row["tbl_diachi"], $row["tbl_sdt"], $row["tbl_kinhdo"], $row["tbl_vido"], $row["cty_ma"], $row["tbl_xaid"], $tid, $page);
			}
		}
		/*public function edit(){
			$this->model->gen_form();
		}*/
		public function save()
		{
			$this->model->save_pro();
			
		}
		public function delete(){
			if(isset($_GET['tid']) && is_numeric($_GET['tid'])){
				$this->model->del($_GET['tid']);
			}			
		}
		public function active(){
			if(isset($_GET['tid']) && is_numeric($_GET['tid'])){
				$this->model->act($_GET['tid']);
			}			
		}
	}
?>