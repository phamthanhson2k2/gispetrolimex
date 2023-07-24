<?php
	spl_autoload_register(function($class){
		$fname = $class.'.php';
		if(file_exists('core/'.$fname)){
			include_once('core/'.$fname);
		}
	});
	
	date_default_timezone_set(config::get_instance()->get_timezone());
	if(config::get_instance()->get_debug()!= "on")
		error_reporting(0);
	
	session_start();
	if(!isset($_SESSION['CART']))
		$_SESSION['CART'] = new cart();
	
	$CONTENT = "";
	if(isset($_GET['m']) && !empty($_GET['m'])){
		$CONTENT = router::load_module($_GET['m'], true);
	}else{
		$CONTENT = router::load_module('home', true);
	}
	
	$TITLE = general::get_instance()->get_title();
	$DESCRIPTION = general::get_instance()->get_description();
	$KEYWORD = general::get_instance()->get_keyword();
	$FOOTER = general::get_instance()->get_footer();
	$TAG = general::get_instance()->get_tag();
	$TEL = general::get_instance()->get_tel();
	$HEADING = general::get_instance()->get_heading();
	$BASE = utility::get_base_url();
	$PATH = str_replace('template.tpl','', config::get_instance()->get_template());
	
	include_once($PATH.'template.tpl');
?>