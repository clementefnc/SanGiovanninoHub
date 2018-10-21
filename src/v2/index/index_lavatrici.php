<?php

  //ottengo ip sannetflixino
  $myfile = fopen("../admin/ipSN.txt", "r") or die("Unable to open file!");
  $ipSN = fgets($myfile);
  fclose($myfile);

  $addrSN = "http://" . $ipSN . ":32400/";

?>

<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <title>SanGiovannino HUB</title>
  </head>


  <body class="bg">
    

    <!-- NAVBAR -->
    <?php include '../navbar/navbar_logged.php'; ?>

    <!-- CONTENT -->
    <?php /*selezione tipologia tabella da mostrare*/ 
      if ($_SESSION['mode']==1) include '../lavatrici/tendine.php';

      else include '../lavatrici/bottoni.php';
    ?>


  </body>
</html>