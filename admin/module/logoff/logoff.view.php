<?php
	class LogoffView {
	
		function __construct($controller, $model){
		}
		
		function output(){
			session_destroy();
			setcookie('USR', '', time()-3600);
			general::get_instance()->set_title('Đăng xuất...');
			$html = '<meta http-equiv="refresh" content="0; url=.">';
			return $html;
		}
	}
?>