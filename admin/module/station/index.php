<?php
	// PHP __autoload function
	function __autoload($class_name)
	{
		$file = "../../../core/".$class_name.".php";
		include_once($file);
	}	
	
	//$matp = (isset($_POST['matp'])&& is_numeric($_POST['matp'])&& $_POST['matp']>0)?$_POST['matp']:0;
	$maqh = (isset($_POST['maqh'])&& is_numeric($_POST['maqh'])&& $_POST['maqh']>0)?$_POST['maqh']:0;
	$xaid = (isset($_POST['xid'])&& is_numeric($_POST['xid'])&& $_POST['xid']>0)?$_POST['xid']:0;

	$ward = db_helper::get_instance()->execute("SELECT xaid, name
									  FROM devvn_xaphuongthitran
									  WHERE maqh = $maqh
									  ORDER BY name ASC", 0);
	while($row = mysql_fetch_array($ward))
	{
		echo '<option value="'.$row["xaid"].'">'.$row["name"].'</option>';
	}
	
?>


