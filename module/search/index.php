<?php

function __autoload($class_name)
{
	$file = "../../core/".$class_name.".php";
	include_once($file);
}

$tid = (isset($_POST['tid'])&& is_numeric($_POST['tid'])&& $_POST['tid']>0)?$_POST['tid']:0;
if (isset($_POST['query']))
{
	$inpText = $_POST['query'];
	$congty = db_helper::get_instance()->execute("SELECT * FROM trambanle WHERE tbl_tentram LIKE '%".$inpText."%'", 0);
	while($row = mysql_fetch_array($congty))
	{
		echo '<a href="tim-kiem/'.$row['tbl_matram'].'" class="list-group-item list-group-item-action border-1">' . $row['tbl_tentram'] . '</a>';	
	}
}

?>