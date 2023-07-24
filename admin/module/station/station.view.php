<?php
	class StationView {
		private $model;
		
		function __construct($controller, $model){
			$this->model = $model;
		}
		
		public function output(){
			$html = $this->model->get_html();
			return $html;
		}
	}
?>