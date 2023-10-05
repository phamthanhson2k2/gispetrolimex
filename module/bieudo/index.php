<?php

function __autoload($class_name)
{
	$file = "../../core/".$class_name.".php";
	include_once($file);
}
if(isset($_POST["cmbHuyen"]))
{
	$hid = (isset($_POST['cmbHuyen'])&& is_numeric($_POST['cmbHuyen'])&& $_POST['cmbHuyen']>0)?$_POST['cmbHuyen']:0;
	
	$query = db_helper::get_instance()->execute("SELECT count(*) as sl, cty_ten, cty_mst, h.name as huyen
			  FROM 	 trambanle t, congty ct, devvn_xaphuongthitran x, devvn_quanhuyen h , devvn_tinhthanhpho tt
			  WHERE	 t.cty_ma = ct.cty_ma
			  AND	 t.tbl_xaid = x.xaid 
			  AND	 x.maqh = h.maqh
			  AND 	 h.matp = tt.matp
			  AND 	 h.maqh = $hid
			  GROUP BY ct.cty_ten",0);
	
 	/*$query = db_helper::get_instance()->execute("SELECT * FROM chart_data WHERE yearid = '".$_POST["cmbHuyen"]."' ORDER BY id ASC",0);*/
	while($row = mysql_fetch_array($query))
	{
	  $output[] = array(
	   'cty_ten'   => $row["cty_ten"],
	   'cty_mst'   => floatval($row["sl"]));
	}
	 echo json_encode($output);
}

?>