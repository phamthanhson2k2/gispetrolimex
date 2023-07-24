<?php
	class SettingView {
	
		function __construct($controller, $model){
		}
		
		function output(){
			general::get_instance()->set_title('Cài đặt');
			$html = '<h1 class="sub-header">Cài đặt</h1>';
			return $html;
		}
	}
?>