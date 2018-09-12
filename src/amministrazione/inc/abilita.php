<?php 

if( isset($_POST['submit']) ) {

    include_once '../../inc/db.inc.php';

    $mail = mysqli_real_escape_string($conn, $_POST['mail']);

    if(empty($mail)){
        header("Location: ../admin.php?error=invalid");
        exit();
    }
    else{
        mysqli_query($conn, "UPDATE users SET abilitato=1 WHERE users_mail='$mail'");
    }
}

header("Location: ../admin.php");

?>