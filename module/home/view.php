<?php
	class HomeView
	{
		private $controller;
		private $model;
		
		function __construct($controller, $model)
		{
			$this->controller = $controller;
			$this->model = $model;
			$this->uti = utility::get_instance();
		}
		
		function output()
		{
			$html = '';
			//$product_1 = $this->model->get_product_1();
			$html .='
			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
     		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css" integrity="sha512-vJfMKRRm4c4UupyPwGUZI8U651mSzbmmPgR3sdE3LcwBPsdGeARvUM5EcSTg34DK8YIRiIo+oJwNfZPMKEQyug==" crossorigin="anonymous" />
			<link href="module/home/css/home.css" rel="stylesheet">
			
				<div class="container">
					<div id="map"></div>
				</div>
			
			<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        		crossorigin=""></script>
    		<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
   			<script src="module/home/js/home.js"></script>
			';
			return $html;
		}
	}
?>