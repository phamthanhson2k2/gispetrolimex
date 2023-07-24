<?php
	class router {
		
		function __construct(){
		}
		
		public static function load_module($name, $is_main = NULL){
			if(file_exists("module/$name")) {
				$files = glob("module/$name/*.{php,PHP}", GLOB_BRACE);
				foreach ($files as $file){
					include_once($file);
				}
			}
			
			$css = "";
			$js = "";
			if(file_exists("module/$name/js")){
				$files = glob("module/$name/js/*.{js,JS}", GLOB_BRACE);
				foreach ($files as $file){
					$js .= "<script type=\"text/javascript\" src=\"$file\"></script>\r\n";
				}
			}
			
			if(file_exists("module/$name/css")) {
				$files = glob("module/$name/css/*.{css,CSS}", GLOB_BRACE);
				foreach ($files as $file){
					$css .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$file\" />\r\n";
				}
			}
			
			$name = ucwords($name);
			$model = $name.'Model';
			$view = $name.'View';
			$control = $name.'Controller';
			
			$m_model = new $model();
			$m_controller = new $control($m_model);
			$m_view = new $view($m_controller, $m_model);
			if($is_main && isset($_GET["act"]) && !empty($_GET["act"]) && method_exists($m_controller, $_GET["act"])){
				$m_controller->{$_GET["act"]}();
			}
			return $m_view->output().$css.$js."\r\n";
		}
	}
?>