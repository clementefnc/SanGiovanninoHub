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
    

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
          <a class="navbar-brand" href="#">SanGiovannino HUB</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../user/admin_user.php"><span class="glyphicon glyphicon-user"></span> Utente</a></li>
            <li><button class="btn btn-danger navbar-btn" style="margin-right: 10px;">Logout</button></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- CONTENT -->

    <a href="https://www.sangiovannino.altervista.org/lavasciuga/indexLavasciuga.php"><div class = "animated-lav bounceOut"></div></a>
    <a href=<?php echo $addrSN; ?>><div class = "animated-sann bounceOut"></div>
    
  </body>
</html>