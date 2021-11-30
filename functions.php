<?php
/// funcs
function isAuth($link){
	if(isset($_SERVER['HTTP_TOKEN'])) {
		$token = $_SERVER['HTTP_TOKEN'];
		$data = mysqli_query($link,"SELECT * FROM `token` WHERE `token` = '$token'");
		if(mysqli_num_rows($data)>0) return true;
	}
	return false;
}

function get_user_info($link,$name){
	echo "name: ".$name."<br>";
	$data = mysqli_query($link,"SELECT * FROM `users` WHERE `name` = '$name'");
	if(!$data) die(mysqli_error($link));
	$data = mysqli_fetch_assoc($data);
	echo json_encode($data);

}

function create_user($link,$name,$pass,$info){
	$data = mysqli_query($link,"INSERT INTO `users` (`id`,`name`, `password`, `info`) VALUES (NULL,'$name', '$pass', '$info')");
	if(!$data) die(mysqli_error($link));
	echo "User created";
	get_user_info($link,$name);

}

function delete_user($link,$name){
	$data = mysqli_query($link,"DELETE FROM `users` WHERE `name` = '$name'");
	if(!$data) die(mysqli_error($link));
	echo "User deleted";

}

function update_user($link,$name,$pass,$info){
	get_user_info($link,$name);
	$data = mysqli_query($link,"UPDATE `users` SET `password` = '$pass',`info` = '$info' WHERE `name` = '$name'");
	if(!$data) die(mysqli_error($link));
	echo "User updated";
	get_user_info($link,$name);

}


function auth_user($link,$name,$pass){
//	echo "name: ".$name."<br>";
	$data = mysqli_query($link,"SELECT `password` FROM `users` WHERE `name` = '$name'");
	if(!$data) die(mysqli_error($link));
	$data = mysqli_fetch_assoc($data);
	if($data["password"] == $pass) {	
		$r = [ "auth" => "authorized" ];
		$a_token = md5(now()+'sdfsdfgsdfsdf'+$name);
		$timestamp = time();
		$data = mysqli_query($link,"INSERT INTO `token` (`token`,`expdate`) VALUES ('$a_token','$timestamp'");
		if(!$data) die(mysqli_error($link));

	}
	else 
	{
		$r = [ "auth" => "auth_denied" ];
//		header('HTTP/1.1 401 Unauthorized');
		http_response_code(401);
	}
	echo json_encode($r);

}
?>
