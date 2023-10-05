<?php
//database_connection.php
#$connect = new mysqli("mysql:host=localhost;dbname=testing", "root", "");
$connect = new PDO("mysql:host=localhost;dbname=gis_petrolimex", 'root', 'vertrigo');
?>