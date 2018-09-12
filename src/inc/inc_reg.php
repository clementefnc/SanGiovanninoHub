<?php

if(isset($_POST['submit'])){

	include_once 'db.inc.php';

	$first = mysqli_real_escape_string($conn, $_POST['nome']);
	$sec = mysqli_real_escape_string($conn, $_POST['cognome']);
	$mail = mysqli_real_escape_string($conn, $_POST['mail']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$room = mysqli_real_escape_string($conn, $_POST['room']);

	//Error Handler

	if(empty($first) || empty($sec) || empty($mail) || empty($pwd) || empty($room)){
		header("Location: ../registrazioni.php?error=empty");
		exit();		
	}else{

		//Verifica input
		if(!preg_match("/^([a-zA-Z\s]*)|(\')$/", $first) || !preg_match("/^([a-zA-Z\s]*)|(\')$/", $sec)){
			
			header("Location: ../registrazioni.php?error=unvalideInput");
			exit();

		}else{
			if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
				
				header("Location: ../registrazioni.php?error=unvalideMail");
				exit();

			}else{

				$sql = "SELECT * FROM users WHERE users_mail='$mail'";
				$result = mysqli_query($conn, $sql);
				$check = mysqli_num_rows($result);

				if($check > 0){
					
					header("Location: ../registrazioni.php?error=mailRegistered");
					exit();		

				}else{
					
					$sql = "SELECT * FROM users WHERE users_room='$room'";
					$result = mysqli_query($conn, $sql);
					$check = mysqli_num_rows($result);

					if($check > 0){

						header("Location: ../registrazioni.php?error=roomRegistered");
						exit();

					}else{

						$hashed = password_hash($pwd, PASSWORD_DEFAULT);
						$sql = "INSERT INTO users (users_name, users_cog, users_mail, users_pwd, users_room) VALUES ('$first', '$sec', '$mail', '$hashed', '$room')";
						$result = mysqli_query($conn, $sql);
            			header("Location: ../login.php");


					}
				
				}

			}
		}
	}

}else{
	header("Location: ../registrazioni.php?error");
	exit();
}

?>