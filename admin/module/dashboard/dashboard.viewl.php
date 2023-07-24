<?php
	class DashBoardView {
		private $model;
		private $contoller;
		
		function __construct($controller, $model){
			$this->contoller = $controller;
			$this->model = $model;
		}
		
		public function output(){
			$html = '<h2 class="sub-header">CHÀO MỪNG BẠN ĐẾN VỚI HỆ THỐNG QUẢN TRỊ PETROLIMEX MAP!</h2>';
			//$html .= $this->model->get_new_order();
			//$html .= '<h2 class="sub-header">Top sản phẩm được xem nhiều</h2>';
			//$html .= $this->model->get_hot_product();
			return $html;
		}
	}
?>