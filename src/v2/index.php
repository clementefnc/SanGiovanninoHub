<?php

/*
	Una singola pagina di index
	Contiene il controllo sulla sessione per valutare il tipo di navbar
		ed il tipo di contenuto da includere
*/

session_start();

if($_SESSION['u_mail']=="sangiovanninolavatrici@gmail.com"){
	header("Location: amministrazione/admin.php");
}

else if (!empty($_SESSION)) {
	header("Location: index/index_logged.php");
}else{
	header("Location: index/index_not_logged.php");
}

?>