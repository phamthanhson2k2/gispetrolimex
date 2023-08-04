<?php
class HomeView
{
	private $controller;
	private $model;
	private $uti;

	function __construct($controller, $model)
	{
		$this->controller = $controller;
		$this->model = $model;
		$this->uti = utility::get_instance();
	}

	function output()
	{
		$html = '';
		$html .= '
			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
     		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css" integrity="sha512-vJfMKRRm4c4UupyPwGUZI8U651mSzbmmPgR3sdE3LcwBPsdGeARvUM5EcSTg34DK8YIRiIo+oJwNfZPMKEQyug==" crossorigin="anonymous" />
			<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
			
				
			<div class="panel panel-content-cont container">
				<div class="header-content-cont">
					<h1 style="font-size:18px; margin-top:10px; padding-left:10px;">TRẠM BÁN LẺ</h1>
				</div>
				<div class="panel-body">
					<div class="row" style="padding-bottom:15px;">
						<div class="col-md-2">
							<label class="form-label">Chọn Công ty</label>				
						</div>
						<div class="col-md-6">
							' . $this->controller->process_get_congty() . '					
						</div>
					</div>
					<div class="col-md-12">
						<div id="data"></div>
						<div id="map"></div>
						
					</div>	
				</div>
			</div>

			<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        		crossorigin=""></script>
    		<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
			<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
			<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

			<!-- Load Esri Leaflet from CDN -->
			<script src="https://unpkg.com/esri-leaflet@2.4.1/dist/esri-leaflet.js"
				integrity="sha512-xY2smLIHKirD03vHKDJ2u4pqeHA7OQZZ27EjtqmuhDguxiUvdsOuXMwkg16PQrm9cgTmXtoxA6kwr8KBy3cdcw=="
				crossorigin=""></script>

			<!-- Load Esri Leaflet Geocoder from CDN -->
			<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
				integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
				crossorigin="">
			<script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
				integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
				crossorigin=""></script>
			<script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
			';
		return $html;
	}
}
?>