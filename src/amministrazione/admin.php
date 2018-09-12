<?php

session_start();

if($_SESSION['u_mail']!="sangiovanninolavatrici@gmail.com"){
	header("Location: ../index_notlogged.php");
}

echo '
<!DOCTYPE html>
<html>
<head>
	<title>SanGiovannino Hub</title>

	<meta charset="utf-8">

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

<h1>Benvenuto ADMIN</h1>
<form action="../inc/inc_logout.php" method="post">
    <button type="submit" >LOGOUT</button>
  </form>

Le seguenti mail ancora non sono state abilitate: <br>';

include_once '../inc/db.inc.php';
$sql = "SELECT users_mail FROM users WHERE abilitato=0";
$result = mysqli_query($conn, $sql);
$num=$result->num_rows;
while ($row = $result->fetch_assoc()) {  
	$temp = $row[users_mail];
	echo "Mail: " .$temp 
		."Nome: " . $row[users_name] . " " . $row[users_cog] 
	. '
	
	<form action="inc/abilita.php" method="post">
	<input type="text" name="mail" id="mail" value="' . $temp . '" style="display: none;">
	<button type="submit" name="submit">Abilita</button>
	</form>
	
	' . '<br><br>';
}

echo '
</body>
</html>';

?>