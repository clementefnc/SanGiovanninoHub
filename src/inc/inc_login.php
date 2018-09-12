<?php 

session_start();

if(isset($_POST['submit'])){

	include_once 'db.inc.php';

	$mail = mysqli_real_escape_string($conn, $_POST['mail']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	if(empty($mail) || empty($pwd)){

		header("Location: ../login.php?error=invalid");
		exit();
	}else{

		$sql = "SELECT * FROM users WHERE users_mail='$mail' AND abilitato=1";
		$result = mysqli_query($conn, $sql);
		$check = mysqli_num_rows($result);

		if($check < 1){


			echo '<script type="text/javascript">alert("Account inesistente o ancora non attivo."); window.location="../login.php?error=BadUser"</script>';
			exit();
		
		}else{

			$row = mysqli_fetch_assoc($result);

			if(!empty($row)){

				$hashed = password_verify($pwd, $row['users_pwd']);

				if($hashed == false){

					header("Location: ../login.php?error=CredentialError");
					exit();

				}elseif ($hashed == true) {
					
					$_SESSION['u_first'] = $row['users_name'];
					$_SESSION['u_last'] = $row['users_cog'];
					$_SESSION['u_mail'] = $row['users_mail'];
					$_SESSION['u_room'] = $row['users_room'];
					header('Location: ../index.php?login=success');
					exit();

				}

			}

		}

	}

}else{

	header("Location: ../login.php");
	exit();

}

?>