<!DOCTYPE html>
<html>
<head>
	<title>SanGiovannino - Lavatrici</title>
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

<div class="topnav">
  <a class="active" href="https://www.sangiovannino.altervista.org">SanGiovannino HUB</a>
  <a href="https://www.sangiovannino.altervista.org/login.php" style="position:fixed; right:2%;">Accedi</a>
  <a href="https://www.sangiovannino.altervista.org/registrazioni.php" style="position:fixed; right:10%; margin-left: 5px;">Registrati</a>
</div> 


	<div class="content" style="margin-top: 7%;" align="center">

		<div class="box-desktop" align="center">

			<h1 class="h1D">Accedi</h1>

			<form  action="inc/inc_login.php" method="post" class="align-items-center formD">
			  <div class="form-group" align="center">
			    <!--<label for="email">Email address:</label>-->
			    <input name="mail" type="email" placeholder="Email" class="form-control inputC" id="email">
			  </div>
			  <div class="form-group" align="center">
			    <!--<label for="pwd">Password:</label>-->
			    <input name="pwd" type="password" placeholder="Password" class="form-control inputC" id="pwd">
			  </div>
			  <button type="submit" name="submit" class="btn btn1">Login</button>
			</form> 
		</div>
	</div>
</body>
</html>
