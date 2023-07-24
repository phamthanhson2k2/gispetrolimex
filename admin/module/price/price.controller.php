<?php
	class PriceController
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
			general::get_instance()->set_title("Giá bán");
			$this->html = $this->model->get_list();
		}
		
		public function add(){
			$msg = '';
			$cty = $_POST["txtCongTy"];
			$loai = $_POST["txtLoai"];
			$ngayban = $_POST["dtpinput2"];
			$giaban = $_POST["txtPrice"];
			
			$date = strtotime($ngayban);
			$date = date('Y-m-d H:i:s', $date);
			
			if(isset($giaban) && !empty($giaban)){
				if($this->model->add_thoidiem($date, $cty, $loai, $giaban)>0){
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Thêm mới giá bán thành công!
						</div>';
				}else{
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Thêm mới giá bán không thành công, vui lòng thử lại sau!
						</div>';
				}
			}
			
			
			$this->html = $this->model->get_list($msg);
		}
		
		public function update(){
			$msg = '';
			
			$cty = $_POST["txtCongTy"];
			$loai = $_POST["txtLoai"];
			$ngayban = $_POST["dtpinput2"];
			$giaban = $_POST["txtPrice"];
			
			if(isset($giaban) && !empty($giaban)){
				if($this->model->upd_thoidiem($ngayban, $_GET['tdid'])>0)
				{
					$this->model->upd_giaban($cty, $loai, $giaban, $_GET['gb']);
					$msg = '<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Cập nhật giá bán cho loại xăng dầu thành công!
					</div>';
				}
				else
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					Cập nhật giá bán cho loại xăng dầu không thành công, vui lòng thử lại sau!
					</div>';
			}
			$this->html = $this->model->get_list($msg);
		}
		
		public function delete(){
			$msg = '';
			if(isset($_GET['tdid']) && is_numeric($_GET['tdid']))
			{
				if($this->model->del_thoidiem($_GET['tdid'])>0)
				{
					$this->model->del_giaban($_GET['gb']);
					$msg = '<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Đã xóa thông tin giá bán thành công!
							</div>';
				}
				else
					$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Xóa thông tin giá bán không thành công, vui lòng thử lại sau!
							</div>';
			}
			$this->html = $this->model->get_list($msg);
		}
	}
?>