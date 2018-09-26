<?php 

session_start();

if(isset($_POST['change'])){

    include_once 'db.inc.php';

    $old = mysqli_real_escape_string($conn, $_POST['old_pwd']);
    $new = mysqli_real_escape_string($conn, $_POST['new_pwd']);

    $hashedNew = password_hash($new, PASSWORD_DEFAULT);
    
    //controllo valori inseriti
    if(empty($old) || empty($new)){
		header("Location: ../user_admin.php?error=invalid");
		exit();
	}else{

        //controlla se vecchia password è valida
        $sql = "SELECT * FROM users WHERE users_mail='". $_SESSION['u_mail'] . "'";
		$result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $valid = password_verify($old,$row['users_pwd']);
            }
        }

        if($valid==false){
            //password vecchia errata
            echo '<script type="text/javascript">alert("Vecchia password errata."); window.location="../user_admin.php?error=OldPwd"</script>';
        } 
        else{
            //query di modifica
            $sql = "UPDATE users SET users_pwd=" . $hashedNew . " WHERE users_mail='" . $_SESSION['u_mail'] . "'";
            $result = mysqli_query($conn, $sql);
            if($result==FALSE){
                echo '<script type="text/javascript">alert("Errore modifica password."); window.location="../user_admin.php?error"</script>';
            }
            echo '<script type="text/javascript">alert("Password modificata con successo"); window.location="../user_admin.php?Success"</script>';
        }
    }
}
else {
    echo '<script type="text/javascript">alert("Errore modifica password."); window.location="../user_admin.php?error"</script>';
}
?>

