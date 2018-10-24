<?php

//Autenticazione
session_start();
if(!isset($_SESSION['u_mail'])){
    http_response_code(403);
    return;
}
$mail = $_SESSION['u_mail'];

include_once 'db.inc.php';

//Router
$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
if(preg_match('/\/$/',@$_SERVER['PATH_INFO']))
    array_pop($request);

switch ($method) {
    case'GET':
        getUser($request);
    break;

    case 'POST':
        createUser();
    break;
}

function getUser($request){
    if(!isset($request[0])){
        http_response_code(400);
        return;
    }

    $camera = intval($request[0],10);

    $sql = "SELECT users_name, users_cog, users_room 
        FROM users 
        WHERE users_room=".$camera;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)<0){
        http_response_code(404);
        return;
    }

    $row = $result->fetch_assoc();
    $fetched=array($row);
    $obj = array('success'=>true,'Items'=>$fetched);
    echo(json_encode($obj));
    return;
}

function createUser($request){
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
	$cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
	$mail = mysqli_real_escape_string($conn, $_POST['mail']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    
    //Controlli sui dati
    if(empty($nome) || empty($cognome) || empty($mail) || empty($pwd) || empty($room)){
        http_response_code(400);
        return;
    }
    
    if(!preg_match("/^([a-zA-Z\s]*)|(\')$/", $nome) || !preg_match("/^([a-zA-Z\s]*)|(\')$/", $cognome)){
        $obj = array('success'=>false,'message'=>'I dati anagrafici non rispettano il formato richiesto');
        echo(json_encode($obj));
        return;
    }

    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $obj = array('success'=>false,'message'=>'Email non valida');
        echo(json_encode($obj));
        return;
    }

    $sql = "SELECT * FROM users WHERE users_mail='$mail'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
        $obj = array('success'=>false,'message'=>'Account già esistente');
        echo(json_encode($obj));
        return;
    }

    if(intval($room,10) <= 1 || intval($room,10) >90){
        $obj = array('success'=>false,'message'=>'Camera non valida');
        echo(json_encode($obj));
        return;
    }

    $sql = "SELECT * FROM users WHERE users_room='$room'";
	$result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        $obj = array('success'=>false,'message'=>'Camera già registrata');
        echo(json_encode($obj));
        return;
    };

    //Registrazione
    $hashed = password_hash($pwd, PASSWORD_DEFAULT);
	$sql = "INSERT INTO users (users_name, users_cog, users_mail, users_pwd, users_room) VALUES ('$nome', '$cognome', '$mail', '$hashed', '$room')";
    $result = mysqli_query($conn, $sql);
    if($result) echo(json_encode(array('success'=>true)));
    else http_response_code(500);
}
