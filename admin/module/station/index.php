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
	/*Ajax chọn tỉnh load huyện và xã phường thị trấn*/
	//Chọn tỉnh hiện thị Huyện/Thành Phố
	/*
	$district = db_helper::get_instance()->execute("SELECT maqh, name
									  FROM devvn_quanhuyen
									  WHERE matp = $matp
									  ORDER BY name ASC", 0);

	while($row = mysql_fetch_array($district))
	{
		echo '<option value="'.$row["maqh"].'">'.$row["name"].'</option>';
	}*/
	//Chọn Huyện/Thành phố hiện Xã/Phường/Thị trấn
	$ward = db_helper::get_instance()->execute("SELECT xaid, name
									  FROM devvn_xaphuongthitran
									  WHERE maqh = $maqh
									  ORDER BY name ASC", 0);
	while($row = mysql_fetch_array($ward))
	{
		//if($row["xaid"] == $xaid)
			//echo '<option value="'.$row["xaid"].'" selected="selected">'.$row["name"].'</option>';
		//else
			echo '<option value="'.$row["xaid"].'">'.$row["name"].'</option>';
	}
	/*End Ajax load tỉnh huyện xã phường thị trấn*/
	
?>


