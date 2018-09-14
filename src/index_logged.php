<?php

session_start();

if (!empty($_SESSION)) {

	$myfile = fopen("amministrazione/ipSN.txt", "r") or die("Unable to open file!");
	$ipSN = fgets($myfile);
	fclose($myfile);

echo '<!DOCTYPE html>
<html>
<head>
	<title>SanGiovannino Hub</title>

	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- FONT ROBOTO -->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 

 	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


</head>
<body class="bg">

<div class="topnav" style="position:relative">
  <a class="active" href="https://www.sangiovannino.altervista.org">SanGiovannino HUB</a>
  <a href="https://www.sangiovannino.altervista.org/lavasciuga/indexLavasciuga.php">Lavanderia</a>
  <a href="http://' . $ipSN . ':32400/">SanNetflixino</a>
  <form method="post" action="inc/inc_logout.php" style="margin:12px; padding:0">
  	<button type="submit" name="submit" class="btn btn-danger" style="position:absolute; right:10px;">LOGOUT</button>
  </form>
</div>

	<div class="bg-index"></div>
	<a href="https://www.sangiovannino.altervista.org/lavasciuga/indexLavasciuga.php"><div class = "animated-lav bounceOut"></div></a>
	<a href="http://' . $ipSN . ':32400/"><div class = "animated-sann bounceOut"></div>

</body>
</html>';

}

else{
	header("Location: index_notlogged.php");
}

?>