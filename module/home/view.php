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
	function get_icon($icon_pic){
		$icon_string = '
		 new L.Icon({
			iconUrl: \''.$icon_pic.'\',
			shadowUrl: \'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png\',
			iconSize: [32, 32],
			iconAnchor: [32, 16],
			popupAnchor: [-3, -76],
			shadowSize: [41, 41]
		})
		';
		return $icon_string;
	}

	function output()
	{
		$html = '';
		$include_scripts = '
			<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
     		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css" integrity="sha512-vJfMKRRm4c4UupyPwGUZI8U651mSzbmmPgR3sdE3LcwBPsdGeARvUM5EcSTg34DK8YIRiIo+oJwNfZPMKEQyug==" crossorigin="anonymous" />
			<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />
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
			
			$result_cty = $this->controller->process_get_congty();
			$cmbview = $result_cty[0];

			$func = '<script>
				function change_cb_cty(url) {
					url=url+\'/\'+document.getElementById(\'cmbCongTy\').value;
					window.location= url;
				}</script>';

			$render_view= $func.'
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
							' .$cmbview. '
						</div>
					</div>
					<div class="col-md-12">
						<div id="data"></div>
						<div id="map"></div>
						
					</div>	
				</div>
			</div>
			';

			$cid = 0;
			if(isset($_GET["cid"])){
				$cid = $_GET["cid"];
			}
			else {
				$cid = 0;
			}
			$string_script = '<br><script>
			const map = L.map("map").setView([10.0338, 105.7867], 10);
			var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
				attribution: \'&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors\'
				});
			
			osm.addTo(map);

			// Creating scale control
			var scale = L.control.scale().addTo(map);

			//var geocodeService = L.esri.Geocoding.geocodeService();
			// map.on(\'click\', function (e) {
			// geocodeService.reverse().latlng(e.latlng).run(
			// 	function (error, result) {
			// 		if (error) {
			// 			return;
			// 		}
			// 		L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
			// 	});
			// });
			
			setInterval(function () {
				map.invalidateSize();
			}, 100);

			';
			$layers = '';
			if($cid == 0) {
				// all stations of companies
				$all_tbl = $this->controller->process_get_cty_trambanle();
				$tbl_count = 0;
				$cty_ten = '';
				$trambl = '';
				$output_tbl = '';
				$cty_ma = '';
				$overlay_map = '
				var overlayMaps = {';
				foreach ($all_tbl as $row) {
					if (empty($cty_ten)) {
						$cty_ma = $row["cty_ma"];
						$trambl = 'var cty_'.$cty_ma.' = L.layerGroup([';
						$kinh_vi_do = '['.$row["tbl_kinhdo"].', '.$row["tbl_vido"].']';
						$trambl.= 'L.marker('.$kinh_vi_do.', { icon: '.$this->get_icon($row["cty_logo"]).'}).bindTooltip("'.$row["tbl_tentram"].'", { permanent: true, direction:  \'right\' }),';
						$tbl_count = 1;
					}
					elseif (strcmp($cty_ten, $row['cty_ten']) != 0){
						if ($tbl_count > 0) {
							$trambl = rtrim($trambl, ',');
						}
						$trambl .= ']);';
						$output_tbl .= $trambl. ' cty_'.$cty_ma.'.addTo(map); ';
						$overlay_map.= '"'.$cty_ten.'": '.'cty_'.$cty_ma.',';
						// begin new company
						$cty_ma = $row["cty_ma"];
						$trambl = 'var cty_'.$cty_ma.' = L.layerGroup([';
						$kinh_vi_do = '['.$row["tbl_kinhdo"].', '.$row["tbl_vido"].']';
						$trambl.= 'L.marker('.$kinh_vi_do.', { icon: '.$this->get_icon($row["cty_logo"]).'}).bindTooltip("'.$row["tbl_tentram"].'", { permanent: true, direction:  \'right\' }),';
						$tbl_count = 1;
					} else { //stations of the same company
						$kinh_vi_do = '['.$row["tbl_kinhdo"].', '.$row["tbl_vido"].']';
						$trambl.= 'L.marker('.$kinh_vi_do.', { icon: '.$this->get_icon($row["cty_logo"]).'}).bindTooltip("'.$row["tbl_tentram"].'", { permanent: true, direction:  \'right\' }),';
						$tbl_count += 1;
					}
					$cty_ten = $row['cty_ten'];
				}
				if ($tbl_count > 0) {
					$trambl = rtrim($trambl, ',');
				}
				$trambl .= ']);';
				$output_tbl .= $trambl. '  cty_'.$cty_ma.'.addTo(map); ';
				$overlay_map .= '"'.$cty_ten.'": '.'cty_'.$cty_ma.',';
				$overlay_map .='};';
				$base_map = '
					var baseMaps = {
						"Bản đồ nền": osm
					};';
				$layers .= $output_tbl.$base_map.$overlay_map.'L.control.layers(baseMaps, overlayMaps).addTo(map);';
			} else {
				$arr_tbl = $this->controller->get_trambanle_of_congty($cid);
				
				$trambl = 'var petrolStations = L.layerGroup([';
				$count = 0;
				$cty_ten = 'Petrolimex';
				foreach ($arr_tbl as $row) {
					$count += 1;
					$cty_ten = $row['cty_ten'];
					$kinh_vi_do = '['.$row["tbl_kinhdo"].', '.$row["tbl_vido"].']';
					$trambl.= 'L.marker('.$kinh_vi_do.', { icon: '.$this->get_icon($row["cty_logo"]).'}).bindTooltip("'.$row["tbl_tentram"].'", { permanent: true, direction:  \'right\' }),';
				}
				if ($count > 0) {
					$trambl = rtrim($trambl, ',');
				} else {

				}
				$trambl .= ']);';

				$layers = $trambl. '
				petrolStations.addTo(map);
				var baseMaps = {
					"Bản đồ nền": osm
				};

				var overlayMaps = {
					"'.$cty_ten.'": petrolStations,
					//"PvOil": pvoilStations
				};

				L.control.layers(baseMaps, overlayMaps).addTo(map);
				';
			}
			$search = '
			var searchControl = L.esri.Geocoding.geosearch({position: "topright"}).addTo(map); 
			var results = L.layerGroup().addTo(map);
			searchControl.on("results", function (data) {
				results.clearLayers();
				for (var i = data.results.length - 1; i >= 0; i--) {
				  results.addLayer(L.marker(data.results[i].latlng));
				}
			  })
			';
			$string_script .= $layers.$search.'</script>';

			$html .= $include_scripts.$render_view.$string_script;
		return $html;
	}
}
?>