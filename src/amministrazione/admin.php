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
		      <div class="card-body">
		        <?php 
		        	include_once '../inc/db.inc.php';
					$sql = "SELECT users_mail, users_name, users_cog, users_room FROM users WHERE abilitato=0";
					$result = mysqli_query($conn, $sql);
					$num=$result->num_rows;
					while ($row = $result->fetch_assoc()) { 

						$temp = $row[users_mail];
						echo '<div style="margin-bottom:10px"> <span style="display:inline-block">' . $row[users_name] . ' ' . $row[users_cog] . '('. $temp . ')   ' . '</span>'
						. 
						'<form style="margin-top:0px; display:initial; text-align:initial" action="inc/abilita.php" method="post">
						<input type="text" name="mail" id="mail" value="' . $temp . '" style="display: none;">
						<button type="submit" class="btn btn-success" name="abilita">Abilita</button>
						<button type="submit" class="btn btn-danger" name="cancella">Cancella</button>
						</form> <br> </div>';
					}

		        ?>
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
		        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
		      <div class="card-body">
		        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
		      </div>
		    </div>
		  </div>
		</div>

</body>
</html>