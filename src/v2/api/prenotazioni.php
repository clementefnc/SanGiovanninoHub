<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

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

if(!isset($request[0])){
    http_response_code(400);
    return;
}

switch ($method) {
    case 'PUT':
        switch($request[0]){
            case 'lavatrice':
                prenota($request,'prenotazioni','',$conn,$mail);  
            break;

            case 'asciugatrice':
                prenota($request,'asciugatrice','a_',$conn,$mail);  
            break;
        }
    break;

    case 'DELETE':
        switch($request[0]){
            case 'lavatrice':
                rimuovi($request,'prenotazioni','',$conn,$mail);  
            break;

            case 'asciugatrice':
                rimuovi($request,'asciugatrice','a_',$conn,$mail);  
            break;
        }
    break;

    case 'GET':
        switch($request[0]){
            case 'lavatrice':
                richiedi($request,'prenotazioni','',$conn);  
            break;

            case 'asciugatrice':
                richiedi($request,'asciugatrice','a_',$conn);  
            break;

        }
    break;
}

//Handler
function richiedi($request,$table,$prefix,$conn){
    $fetched = [];

    if(!isset($request[3])){
        http_response_code(400);
        return ;
    }

    foreach($request as $arg){
        $args[] = mysqli_real_escape_string($conn,$arg); 
    }

    $sql = "SELECT ".$prefix."ora, users_name, users_cog, users_room 
            FROM users,".$table." 
            WHERE ".$prefix."anno=".$args[1]
            ." AND ".$prefix."mese=".$args[2]
            ." AND ".$prefix."giorno=".$args[3]
            ." AND "."users.users_mail = $table.$prefix"."email";
            

    if(isset($args[4]))
        $sql .= " AND ".$prefix."ora=".$args[4];

    $result = mysqli_query($conn, $sql);

    while($row = $result->fetch_assoc()) {
        $fetched[]=$row;
    }
    $obj = array('success'=>true,'Items'=>$fetched,'Table'=>$table,'Prefix'=>$prefix);
    echo(json_encode($obj));

}

function prenota($request,$table,$prefix,$conn,$mail){

    if(!isset($request[4])){
        http_response_code(400);
        return ;
    }

    foreach($request as $arg){
        $args[] = mysqli_real_escape_string($conn,$arg); 
    }

    //Controlla che l'ora sia libera
    $sql = "SELECT *
            FROM ".$table." 
            WHERE ".$prefix."anno=".$args[1]
            ." AND ".$prefix."mese=".$args[2]
            ." AND ".$prefix."giorno=".$args[3]
            ." AND ".$prefix."ora=".$args[4];

    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check>0){
        $obj = array('success'=>false,'message'=>'Ora già prenotata');
        echo(json_encode($obj));
        return;
    }

    //Controlla il numero di prenotazioni
    $sql = "SELECT COUNT(*) AS cnt
            FROM ".$table." 
            WHERE ".$prefix."anno=".$args[1]
            ." AND ".$prefix."mese=".$args[2]
            ." AND ".$prefix."giorno=".$args[3]
            ." AND ".$prefix."email="."'$mail'";

    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check>0){
        $row = $result->fetch_assoc();
        if (intval($row['cnt'],10) >= 2) {
            $obj = array('success'=>false,'message'=>'Numero massimo di prenotazioni raggiunto');
            echo(json_encode($obj));
            return;
        }}

    //Prenota
    $sql = "INSERT INTO ".$table." (
        ".$prefix."email,
        ".$prefix."giorno,
        ".$prefix."mese,
        ".$prefix."anno,
        ".$prefix."ora) 
        VALUES ('$mail','$args[3]','$args[2]','$args[1]','$args[4]')";
    if(mysqli_query($conn, $sql)) echo(json_encode(array('success'=>true)));
    else http_response_code(500);
    
}

function rimuovi($request,$table,$prefix,$conn,$mail){
    $fetched = [];
    
    if(!isset($request[4])){
        http_response_code(400);
        return ;
    }

    if(ePrimaDiOra($request[3],$request[2],$request[1],$request[4])){
        $obj = array('success'=>false,'message'=>'Non puoi sprenotare un turno passato.');
        echo(json_encode($obj));
        return;
    }
    
    foreach($request as $arg){
        $args[] = mysqli_real_escape_string($conn,$arg); 
    }

    $sql = "SELECT *
            FROM ".$table." 
            WHERE ".$prefix."anno=".$args[1]
            ." AND ".$prefix."mese=".$args[2]
            ." AND ".$prefix."giorno=".$args[3]
            ." AND ".$prefix."ora=".$args[4]
            ." AND ".$prefix."email="."'$mail'";

    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if($check<=0){
        $obj = array('success'=>false,'message'=>'Biricchino non è la tua ora');
        echo(json_encode($obj));
        return;
    }

    $sql = "DELETE FROM ".$table." 
    WHERE ".$prefix."anno=".$args[1]
    ." AND ".$prefix."mese=".$args[2]
    ." AND ".$prefix."giorno=".$args[3]
    ." AND ".$prefix."ora=".$args[4];

    if(mysqli_query($conn, $sql))   echo(json_encode(array('success'=>true)));
    else http_response_code(500);
        
}

function ePrimaDiOra($g,$m,$a,$hh){

    date_default_timezone_set("Europe/Rome");
    setlocale(LC_TIME, array('it_IT.UTF-8','it_IT@euro','it_IT','italian'));

    $giornoAttuale = intval(strftime("%d"),10);
    $meseAttuale = intval(strftime("%m"),10);
    $annoAttuale = intval(strftime("%Y"),10);
    $oraAttuale = intval(strftime("%H"),10);

    $GAttuale = $annoAttuale * 10000 + $meseAttuale * 100 + $giornoAttuale;
    $GSprenotazione = $a * 10000 + $m * 100 + $g;

    //se l'argomento è prima di ora return true
    if($GSprenotazione<$GAttuale) return true;
    else if($GSprenotazione>$GAttuale) return false;
    else {
        //controllo orario
        if($hh<=$oraAttuale) return true;
        else return false;
    }

}

?>