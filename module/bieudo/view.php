<?php
	class BieudoView
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
			$soluong = $this->controller->process_soluong();
			$cty = $this->controller->process_cty();
			return '<link rel="stylesheet" type="text/css" href="module/statis/css/statis.css" />
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
			  google.charts.load("current");
			  google.charts.setOnLoadCallback(drawVisualization);
		
			  function drawVisualization() {
				var wrapper = new google.visualization.ChartWrapper({
				  chartType: "ColumnChart",
				  dataTable: [			
								["", "'.$cty.'",],
								["", '.$soluong.',]
							],
				  options: {"title": "Countries"},
				  containerId: "chart_area"
				});
				wrapper.draw();
			  }
			</script>
			
			
			
			<div class="panel panel-content-cont">
				<div class="header-content-cont">
					<h1 style="font-size:18px; margin-top:10px; padding-left:10px;">BIỂU ĐỒ TRẠM BÁN LẺ</h1>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div id="chart_area" style="width: 1000px; height: 620px;"></div>
					</div>	
				</div>
			</div>
			';
			
		}
	}
?>