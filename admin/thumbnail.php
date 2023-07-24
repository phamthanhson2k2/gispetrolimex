<?php
	if(isset($_GET['p']) && isset($_GET['w']) && isset($_GET['h']))
	{
		$p = $_GET['p'];
		$w = $_GET['w'];
		$h = $_GET['h'];
		include_once("../core/utility.php");
		utility::create_thumbnail($p, $w, $h);
	}
?>