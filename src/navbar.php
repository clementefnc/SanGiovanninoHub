<?php 
	session_start(); 
	if (empty($_SESSION)) {
?>

		<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
		  <!-- Navbar content -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
				<a class="navbar-brand" href="index.php">SanGiovannino HUB</a>

				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				  <li class="nav-item">
				    <a class="nav-link" href="indexLavanderia.php">Lavanderia</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" href="indexSanNetflixino.php">SanNetflixino</a>
				  </li>
				</ul>
			</div>
			<button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
		</nav>

<?php
	}
	else{
?>


		<nav class="navbar navbar-dark bg-dark">
		  <!-- Navbar content -->
			<a class="navbar-brand" href="index.php">SanGiovannino HUB</a>
			<a href="signup.php" class="btn btn-info ml-auto">Registrati</a>
			<a href="login.php" class="btn btn-success ml-2">Accedi</a>
		</nav>

<?php
	}
?>