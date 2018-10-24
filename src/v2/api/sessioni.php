<?php

session_start();
include_once 'db.inc.php';

//Router
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        login($_POST['mail'],$_POST['pwd'],$conn);
    break;

    case 'DELETE':
        logout();
    break;
}

function login($mail,$pwd,$conn){
    $mail = mysqli_real_escape_string($conn,$mail);
    $pwd = mysqli_real_escape_string($conn,$pwd);

    if(empty($mail) || empty($pwd)){
        http_response_code(400);
        return;
    }

    $sql = "SELECT * FROM users WHERE users_mail='$mail' AND abilitato=1";
	$result = mysqli_query($conn, $sql);
	$check = mysqli_num_rows($result);
	if($check < 1){
        http_response_code(404);
        return;
    }

    $row = mysqli_fetch_assoc($result);
	if(empty($row)){
        return;
    }

	$hashed = password_verify($pwd, $row['users_pwd']);
	if($hashed == true){
        $_SESSION['u_name'] = mysqli_real_escape_string($conn,$row['users_name']);
		$_SESSION['u_cog'] = mysqli_real_escape_string($conn,$row['users_cog']);
		$_SESSION['u_mail'] = mysqli_real_escape_string($conn,$row['users_mail']);
        $_SESSION['u_room'] = mysqli_real_escape_string($conn,$row['users_room']);
            
        $obj = array('success'=>true);
        echo(json_encode($obj));
        return;
    }

    http_response_code(403);
    return;
    
}

function logout(){
    session_unset();
    session_destroy();

    $obj = array('success'=>true);
    echo(json_encode($obj));
    return;
}
    
    