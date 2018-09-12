
<?php

session_start();

if($_SESSION['u_mail']=="sangiovanninolavatrici@gmail.com"){
	header("Location: amministrazione/admin.php");
}

else if (!empty($_SESSION)) {
	header("Location: index_logged.php");
}else{
	header("Location: index_notlogged.php");
}

?>


