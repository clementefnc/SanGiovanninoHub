<?php 

if( isset($_POST['cambiaip']) ) {

   $GLOBALS['ip_sannetflixino'] = $_POST['ipsannetflixino'];
   header('Location: ../admin.php');

}


?>