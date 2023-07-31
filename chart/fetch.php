<?php

//fetch.php

include('database_conection.php');

if(isset($_POST["year"]))
{
 $query = "
 SELECT * FROM chart_data 
 WHERE year = '".$_POST["year"]."' 
 ORDER BY id ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'month'   => $row["month"],
   'profit'  => floatval($row["profit"])
  );
 }
 echo json_encode($output);
}

?>