<?php
	class CompanyController
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
			general::get_instance()->set_title("Danh sách Công ty");
			$this->html = $this->model->get_list();
		}
		
		public function add(){
			//$msg = '';
			$name = $_POST["txtName"];
			$add = $_POST["txtAdd"];
			$phone = $_POST["txtPhone"];
			$email = $_POST["txtEmail"];
			$tax = $_POST["txtTax"];
			$logo = $_POST["txtImage"];
			/*if(isset($_POST['txt-name']) && !empty($_POST['txt-name'])){
				if($this->model->add_cat($name, $add, $phone, $email, $tax, $logo)>0){
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Thêm mới thông tin công ty thành công!
						</div>';
				}else{
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Thêm mới thông tin công ty không thành công, vui lòng thử lại sau!
						</div>';
				}
			}
			*/
			
			if(@$_FILES['txtImg']['type'] != '')
			{
				$uploaddir = '../logo/'; 
				$ext = explode('.',$_FILES['txtImg']['name']);
				if($ext[1]=='gif' || $ext[1]=='GIF'|| $ext[1]=='jpg' || $ext[1]=='JPG' || $ext[1]=='png' || $ext[1]=='PNG')
				{
					//$id="img";
					$save_name = 'logo/';
					$filename=str_replace(' ', '-', $_FILES['txtImg']['name']);
					$uploadfile = $uploaddir . $filename;

					$size=round(filesize($_FILES['txtImg']['tmp_name'])/1000,2);
					 if (move_uploaded_file($_FILES['txtImg']['tmp_name'], $uploadfile)) 
						{ 
							$this->model->add_cat($name, $add, $phone, $email, $tax, $save_name.$filename);
							$this->message = '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Thông báo!</b> Đã thêm mới thông tin công ty thành công!</div>';
						} 
					else 
						{ 
							$this->message = '<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Lỗi!</b> Có lỗi xảy ra không thể thêm!</div>';
						} 
				}
				else 
				{
					$this->message = '<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Thông báo!</b> File logo không đúng chuẩn, vui lòng kiểm tra lại!</div>';
				} 	
			}	
			
			$this->html = $this->model->get_list();
		}
		
		public function update(){
			/*$msg = '';
			if(isset($_POST['txt-name']) && !empty($_POST['txt-name'])){
				if($this->model->upd_cat($_GET['uid'], $_POST['txt-name'])>0)
				$msg = '<div class="alert alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Cập nhật danh mục thành công!
						</div>';
				else
				$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  Cập nhật danh mục không thành công, vui lòng thử lại sau!
						</div>';
			}*/
			$name = $_POST["txtName"];
			$add = $_POST["txtAdd"];
			$phone = $_POST["txtPhone"];
			$email = $_POST["txtEmail"];
			$tax = $_POST["txtTax"];
			$logo = $_POST["txtImage"];
			if($_POST["txtImage"] != $_POST["txt-img-edit"])
			//if(@$_FILES['txtImg']['type'] != $_POST["txt-img-edit"])
			{
				$uploaddir = '../logo/'; 
				$ext = explode('.',$_FILES['txtImg']['name']);
				if($ext[1]=='gif' || $ext[1]=='GIF'|| $ext[1]=='jpg' || $ext[1]=='JPG' || $ext[1]=='png' || $ext[1]=='PNG')
				{
					$save_name = 'logo/';
					$filename=str_replace(' ', '-', $_FILES['txtImg']['name']);
					$uploadfile = $uploaddir . $filename;

					$size=round(filesize($_FILES['txtImg']['tmp_name'])/1000,2);
					 if (move_uploaded_file($_FILES['txtImg']['tmp_name'], $uploadfile)) 
						{ 
							$this->model->upd_cat_img_edit($name, $add, $phone, $email, $tax, $save_name.$filename, $_GET['cid']);
							$this->message = '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Thông báo!</b> Cập nhật thông tin công ty thành công!</div>';
						} 
					else 
						{ 
							$this->message = '<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Lỗi!</b> Có lỗi xảy ra không thể cập nhật!</div>';
						} 
				}
				else 
				{
					$this->message = '<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Thông báo!</b> File ảnh không đúng chuẩn, vui lòng kiểm tra lại!</div>';
				}	
			}
			else
			{
				$this->model->upd_cat_img($name, $add, $phone, $email, $tax, $_GET['cid']);
				$this->message = '<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><b>Thông báo!</b> Cập nhật thông tin công ty thành công!</div>';
			}
			$this->html = $this->model->get_list();
		}
		
		public function delete(){
			$msg = '';
			if(isset($_GET['cid']) && is_numeric($_GET['cid'])){
				if($this->model->del_cat($_GET['cid'])>0)
					$msg = '<div class="alert alert-success alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Đã xóa thông tin công ty thành công!
							</div>';
				else
					$msg = '<div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  Xóa thông tin công ty không thành công, vui lòng thử lại sau!
							</div>';
			}
			$this->html = $this->model->get_list($msg);
		}
	}
?>