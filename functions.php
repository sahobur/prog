<?php
/// funcs
function isAuth($link){
	echo "chek auth\n";
//	print_r($_SERVER);die();
	if(isset($_SERVER['HTTP_TOKEN'])) {
		$token = $_SERVER['HTTP_TOKEN'];
		echo "HTTP_TOKEN: ".$token."\n";
		$data = mysqli_query($link,"SELECT `token` FROM `token`");
		//		echo "mysql err: ";
		$rz = mysqli_fetch_assoc($data);
		print_r($rz);
//		echo "db token: ".$rz["token"]."\n";

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
//	echo "1 sql pass\n";
	if(!$data) die(mysqli_error($link));
	$data = mysqli_fetch_assoc($data);
	$pwd  = $data['password'];
	if($pwd == $pass) {	
		$r = [ "auth" => "authorized" ];
		$a_token = md5(time().'sdfsdfgsdfsdf'.$name);
		$timestamp = time();
		echo $a_token."\n";
		$data = mysqli_query($link,"INSERT INTO `token` (`token`,`expdate`) VALUES ('$a_token','$timestamp')");
		if(!$data) die(mysqli_error($link));

		 $r = [ "auth" => "authorized" ];
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
