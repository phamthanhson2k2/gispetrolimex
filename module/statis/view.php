<?php
	class StatisView
	{
		private $controller;
		private $model;
		private $gen;
		
		function __construct($controller, $model)
		{
			$this->controller = $controller;
			$this->model = $model;
			$this->gen = general::get_instance();
		}
		
		function output()
		{
			return '<link rel="stylesheet" type="text/css" href="module/statis/css/statis.css" />
			<div class="panel panel-content-cont">
				<div class="header-content-cont">
					<h1 style="font-size:18px; margin-top:10px; padding-left:10px;">THỐNG KÊ</h1>
				</div>
				<div class="panel-body">
					<div class="row" style="padding-bottom:15px;">
						<div class="col-md-6">
							<label class="control-label">Chọn Quận/Huyện</label>
							'.$this->controller->process_get_huyen().'
						</div>
						<div class="col-md-6">
							<label class="control-label">Chọn Công ty đầu mối</label>
							'.$this->controller->process_get_cty().'
						</div>
						
					</div>
					
					<div class="row">
						'.$this->controller->process_get_table().'
					</div>
					
					
					
				</div>
			</div>
			';
			
		}
	}
?>