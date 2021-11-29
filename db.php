<?php
$db = 	   "apiuser";
$db_host = "localhost";
$db_user = "apiuser";
$db_pass = "apiuser";


// connect db

$link = mysqli_connect($db_host,$db_user,$db_pass,$db);
if(!$link) die(mysqli_connect_error());
// else echo "DB Conn OK";


?>

