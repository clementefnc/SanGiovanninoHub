<?php

session_start();

if (!empty($_SESSION)) {

	$myfile = fopen("amministrazione/ipSN.txt", "r") or die("Unable to open file!");
	$ipSN = fgets($myfile);
    fclose($myfile);
}

else{
	header("Location: index_notlogged.php");
}
    
?>

<!DOCTYPE html>
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

    <!-- FUNZIONI DI UTILITA' -->
	<script type="text/javascript" src="js/checkPwdChang.js"></script>


</head>
<body>

<div class="topnav" style="position:relative">
  <a class="active" href="https://www.sangiovannino.altervista.org">SanGiovannino HUB</a>
  <a href="https://www.sangiovannino.altervista.org/lavasciuga/indexLavasciuga.php">Lavanderia</a>
  <a href="<?php echo 'http://' . $ipSN . ':32400/">SanNetflixino</a>' ?>
  <form method="post" action="inc/inc_logout.php" style="margin:12px; padding:0">
  	<button type="submit" name="submit" class="btn btn-danger" style="position:absolute; right:10px;">LOGOUT</button>
  </form>
</div>

	<!-- Cambia password -->

    <!-- Lascia stanza -->

    <div class="accordion" id="accordionExample">
		<div class="card">
		    <div class="card-header" id="headingOne">
		      <h5 class="mb-0">
		        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Cambia Password
		        </button>
		      </h5>
		    </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <?
                include_once "inc/db.inc.php";
                $sql = "SELECT users_mail, users_pwd FROM users WHERE users_mail='" . $_SESSION['u_mail']."'";
                $result = mysqli_query($conn, $sql);
                $num=$result->num_rows;
                if($num>0)
                    while ($row = $result->fetch_assoc()) { 

                        $temp = $row[users_mail]; 

                        ?>
                        <form action="inc/cambia_pwd.php" method="post" class="align-items-center">

                            <?php echo '<input type="text" name="mail" id="mail" value="' . $temp . '" style="display: none;">'; ?>

                            <div class="form-group" align="center">
                            <label for="old_pwd">Vecchia password</label>
                            <input type="password" class="form-control inputC" id="old_pwd" placeholder="Vecchia password">
                            </div>

                            <div class="form-group" align="center">
                            <label for="new_pwd">Nuova password</label>
                            <input type="password" class="form-control inputC" id="new_pwd" placeholder="Nuova password">
                            </div>

                            <div class="form-group" align="center">
                            <label for="new_pwd_retype">Reinserisci nuova password</label>
                            <input type="password" class="form-control inputC" onblur="checkChange()" id="new_pwd_retype" placeholder="Nuova password">
                            </div>
                            <button type="submit" id="change" class="btn btn-primary">Cambia Ora!</button>
                            
                        </form>
                    
                    <?php
                    }
                else echo "<p>ERRORE</p>";
                ?>
                </div>
		    </div>
        </div>
    </div>
</body>
</html>