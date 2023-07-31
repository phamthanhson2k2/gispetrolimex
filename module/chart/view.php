<?php
	class ChartView
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
					</div>
					<div class="col-md-12">
						<div id="chart_area" style="width: 1000px; height: 620px;"></div>
					</div>	
				</div>
			</div>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script src="module/chart/js/chart.js"></script>
			';
			
		}
	}
?>