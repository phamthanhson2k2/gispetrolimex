<?php
	class ChangepwdController {
		
		private $model;
		private $message;
		private $security;
		function __construct($model)
		{
			$this->model = $model;
			$this->message = "";
			$this->security = new security();
		}
		
		function get_message()
		{
			return $this->message;
		}
		
		function get_tab_info_active()
		{
			if(isset($_GET["act"]) && $_GET["act"] == "password")
				return "";
			else
				return "active";
		}
		
		function get_tab_pwd_active()
		{
			if(isset($_GET["act"]) && $_GET["act"] == "password")
				return "active";
			else
				return "";
		}
		
		function update()
		{
			if(isset($_POST["txtFullname"]) && !empty($_POST["txtFullname"]) &&
				isset($_POST["txtEmail"]) && !empty($_POST["txtEmail"]))
			{
				$num = $this->model->update_acc($_POST["txtFullname"], $_POST["txtEmail"], $_SESSION["USR_ID"]);
				if($num == 1)
					$this->message = '<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span></button>
					  <b>Thông báo!</b> Cập nhật thông tin tài khoản thành công!</div>';
				else if($num == 0)
					$this->message = '<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
						<b>Thông báo!</b> Thông tin không có gì cập nhật!</div>';
				else
					$this->message = '<div class="alert alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span></button>
						  <b>Lỗi!</b> Lỗi, thông tin chưa được cập nhật, vui lòng xem lại!</div>';
			}
		}
		
		function password()
		{
			if(isset($_POST["txtCurPass"]) && isset($_POST["txtNewPass"]) && !empty($_POST["txtCurPass"]) && !empty($_POST["txtNewPass"]))
			{
				if($this->model->get_curpass($_SESSION["USR_ID"]) == $_POST["txtCurPass"])
				{
					$num = $this->model->change_password($_POST["txtNewPass"], $_SESSION["USR_ID"]);
					if($num == 1)
						$this->message = '<div class="alert alert-success alert-dismissible" role="alert">
									  	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									      <span aria-hidden="true">&times;</span></button>
									  	  <b>Thông báo!</b> Đã đổi mật khẩu thành công!</div>';
					else if($num == 0)
						$this->message = '<div class="alert alert-warning alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span></button>
										<b>Thông báo!</b> Mật khẩu không có gì thay đổi</div>';
					else
						$this->message = '<div class="alert alert-danger alert-dismissible" role="alert">
									  	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									  	  <span aria-hidden="true">&times;</span></button>
									  	  <b>Lỗi!</b> Lỗi, vui lòng kiểm tra lại!</div>';
				}
				else
				{
					$this->message = '<div class="alert alert-danger alert-dismissible" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									  <span aria-hidden="true">&times;</span></button>
									  <b>Lỗi!</b> Mật khẩu không khớp vui lòng kiểm tra lại!</div>';
				}
			}
		}
	}
?>