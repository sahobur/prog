<?php

require "db.php";
require "functions.php";
echo "TEST";
//echo $db;
$q =  $_GET['q'];

$r = explode("/",$q);
//print_r($r);

switch($r[0]) {
	case "user":
		get_user_info($link,$r[1]);
		break;
	case "create":
		create_user($link,$r[1],$r[2],$r[3]);
		break;
	case "delete":
		delete_user($link,$r[1]);
		break;
	case "update":
		update_user($link,$r[1],$r[2],$r[3]);
		break;
	case "auth":
		auth_user($link,$r[1],$r[2]);
		break;
	default:
		die("Error reques");
}








