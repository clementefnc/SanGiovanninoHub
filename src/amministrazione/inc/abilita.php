<?php 

if( isset($_POST['abilita']) ) {

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

else if ( isset($_POST['cancella']) ) {
	include_once '../../inc/db.inc.php';

    $mail = mysqli_real_escape_string($conn, $_POST['mail']);

    if(empty($mail)){
        header("Location: ../admin.php?error=invalid");
        exit();
    }
    else{
        mysqli_query($conn, "DELETE FROM users WHERE users_mail='$mail'");
    }
}

header("Location: ../admin.php");

?>