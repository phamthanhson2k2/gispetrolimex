<?php
	class TypeofgasController
	{
		private $model;
		private $html;
		
		function __construct($model){
			$this->model = $model;
			$this->html = '';
		}
		
		public function get_html(){
			return $this->html;
		}
		
		public function lst(){
			general::get_instance()->set_title("Loại xăng dầu");
			$this->html = $this->model->get_list();
		}
		
		public function add(){
			$msg = '';
			$name = $_POST["txtName"];
			$dvt = $_POST["txtDVT"];
			$tid = $_POST["txtTram"];
			if(isset($name) && !empty($name)){
				if($this->model->add_lxd($name, $dvt, $tid)>0){
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Thêm mới loại xăng dầu thành công!
						</div>';
				}else{
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Thêm mới loại xăng dầu không thành công, vui lòng thử lại sau!
						</div>';
				}
			}
			
			
			$this->html = $this->model->get_list($msg);
		}
		
		public function update(){
			$msg = '';
			$name = $_POST["txtName"];
			$dvt = $_POST["txtDVT"];
			$tid = $_POST["txtTram"];
			if(isset($name) && !empty($name)){
				if($this->model->upd_loaixangdau($name, $dvt, $_GET['lid'])>0)
				{
					$this->model->upd_trambanle_loaixangdau($tid, $_GET['lid'], $_GET['tlid']);
					$msg = '<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Cập nhật loại xăng dầu thành công!
							</div>';
				}
				else
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Cập nhật loại xăng dầu không thành công, vui lòng thử lại sau!
						</div>';
			}
			$this->html = $this->model->get_list($msg);
		}
		
		public function delete(){
			$msg = '';
			if(isset($_GET['lid']) && is_numeric($_GET['lid']))
			{
				if($this->model->del_loaixangdau($_GET['lid'])>0)
				{
					$this->model->del_trambanle_loaixangdau($_GET['tlid']);
					$msg = '<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Đã xóa thông tin loại xăng dầu thành công!
							</div>';
				}
				else
					$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Xóa thông tin loại xăng dầu không thành công, vui lòng thử lại sau!
							</div>';
			}
			$this->html = $this->model->get_list($msg);
		}
	}
?>