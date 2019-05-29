<?php

session_start();

if (!empty($_SESSION)){
	//utente loggato
	$myfile = fopen("amministrazione/ipSN.txt", "r") or die("Unable to open file!");
	$ipSN = fgets($myfile);
	fclose($myfile);
?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="#">SanGiovannino Hub</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="../index.php">SanGiovannino Hub</a></li>
                <li><a href="../lavasciuga/indexLavasciuga.php">Lavanderia</a></li>
                <li><a href="http://<?php echo $ipSN ?>:32400/">SanNetflixino</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li>
                	<form method="post" action="inc/inc_logout.php">
                		<button type="submit" name="submit" class="btn btn-danger">LOGOUT</button>
                	</form>
                </li>
            </ul>

            </div>
        </div>
    </nav>

<?php
}
else{
	//utente non loggato
?>
	

<?php
}

?>