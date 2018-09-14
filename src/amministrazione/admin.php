<?php 

session_start();

if ($_SESSION['u_mail']=="sangiovanninolavatrici@gmail.com") {

echo '
<!DOCTYPE html>
<html>
<head>
	<title>Amministrazione - SanGiovannino Hub</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="../css/style.css">

 	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> 


</head>
<body style="background-color: #f9a13c">

	<div class="topnav" style="position:relative">
	  <a class="active" href="https://www.sangiovannino.altervista.org">SanGiovannino HUB</a>
	  <form method="post" action="../inc/inc_logout.php" style="margin:12px; padding:0">
	  	<button type="submit" name="submit" class="btn btn-danger" style="position:absolute; right:10px;">LOGOUT</button>
	  </form>
	</div>

	<div class="accordion" id="accordionExample">
		  <div class="card">
		    <div class="card-header" id="headingOne">
		      <h5 class="mb-0">
		        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Validazione Utente
		        </button>
		      </h5>
		    </div>

		    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
					<div class="card-body">';
					
		      include_once "../inc/db.inc.php";
					$sql = "SELECT users_mail, users_name, users_cog, users_room FROM users WHERE abilitato=0";
					$result = mysqli_query($conn, $sql);
					$num=$result->num_rows;
					if($num>0)
					while ($row = $result->fetch_assoc()) { 

						$temp = $row[users_mail]; 
						echo '<div style="margin-bottom:20px"> <span style="display:inline-block">' . $row[users_name] . ' ' . $row[users_cog] . ' ('. $temp . ') ' . $row[users_room] . '</span>'
						. 
						'<form style="margin-top:0px; display:initial; text-align:initial" action="inc/abilita.php" method="post">
						<input type="text" name="mail" id="mail" value="' . $temp . '" style="display: none;">
						<button type="submit" class="btn btn-success" style="position:absolute; right:7em;" name="abilita">Abilita</button>
						<button type="submit" class="btn btn-danger" style="position:absolute; right:1em;" name="cancella">Cancella</button>
						</form> <br> </div>';
					}
					else echo "<p>Nessun utente da validare.</p>";
						
					echo '
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingTwo">
		      <h5 class="mb-0">
		        <button class="btn btn-warning collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Varia Stanza
		        </button>
		      </h5>
		    </div>
		    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
		      <div class="card-body">
		        <form style="margin-top:0px; display:initial; text-align:initial" action="inc/cambia.php" method="post">
		        	<div class="form-group">
					    <label for="exampleFormControlInput1">Stanza Partenza</label>
					    <input style="width:20%" type="number" class="form-control" name="stanzaPartenza">
					  </div>
					  <div class="form-group">
					    <label for="exampleFormControlInput1">Stanza Arrivo</label>
					    <input style="width:20%" type="number" class="form-control" name="stanzaArrivo">
					</div>
					<button type="submit" class="btn btn-info" name="cambia">Cambia</button>
		        </form>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingFour">
		      <h5 class="mb-0">
		        <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
		          Varia IP SANNETFLIXINO
		        </button>
		      </h5>
		    </div>
		    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
		      <div class="card-body">
		        <form style="margin-top:0px; display:initial; text-align:initial" action="inc/cambiaIP.php" method="post">
		        	<div class="form-group">
					    <label for="exampleFormControlInput1">Nuovo IP</label>
					    <input style="width:20%" type="text" class="form-control" name="ipsannetflixino">
					  </div>
					<button type="submit" class="btn btn-success" name="cambiaip">Cambia IP</button>
		        </form>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingThree">
		      <h5 class="mb-0">
		        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		          Kick
		        </button>
		      </h5>
		    </div>
		    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
		      <div class="card-body">';
		
		      include_once '../inc/db.inc.php';
					$sql = "SELECT users_mail, users_name, users_cog, users_room FROM users ORDER BY users_cog";
					$result = mysqli_query($conn, $sql);
					$num=$result->num_rows;
					while ($row = $result->fetch_assoc()) { 

						$temp = $row[users_mail];
						echo '<div style="margin-bottom:20px; margin-top:0px;"> <span style="display:inline-block">' . $row[users_cog] . ' ' . $row[users_name] . ' ('. $temp . ')   ' . '</span>'
						. 
						'<form style="margin-top:0px; display:initial; text-align:initial" action="inc/abilita.php" method="post">
						<input type="text" name="mail" id="mail" value="' . $temp . '" style="display: none;">
						<button type="submit" class="btn btn-danger" style="position:absolute; right:10px;" name="cancella">Cancella</button>
						</form> <br> </div> <hr>';
					}
		        echo '
		      </div>
		    </div>
		  </div>
		</div>

</body>
</html>';
}

else {
	header("Location: index_notlogged.php");
}

?>