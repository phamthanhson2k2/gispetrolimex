<?php
	class PriceView
	{
		private $controller;
		
		function __construct($controller, $model){
			$this->controller = $controller;
		}
		
		public function output(){
			return $this->controller->get_html();
		}
	}
?>