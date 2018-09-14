<?php 

if( isset($_POST['cambiaip']) ) {

    $myfile = fopen("../ipSN.txt", "w") or die("Unable to open file!");
    echo fwrite($myfile,$_POST['ipsannetflixino']);
    fclose($myfile);

    header('Location: ../admin.php');
}


?>