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

    <!-- FUNZIONI DI UTILITA' -->
    <script type="text/javascript" src="../js/passwd_retype_check.js"></script>

    <title>SanGiovannino HUB</title>
  </head>


  <body class="bg">
    

    <!-- NAVBAR -->
    <?php include '../navbar/navbar_not_logged.php'; ?>

    <!-- CONTENT -->
    <div class="box" style="margin-top: 4%;" align="center">
      <div class="box-desktop" align="center">

        <h2 class="intestazione">Registrati</h2>

        <form action="../inc/inc_reg.php" style="margin-bottom: 20px;" class="align-items-center" method="post">
          <div class="form-group" align="center">
            <!--<label for="email">Email address:</label>-->
            <input name="mail" type="email" placeholder="Email" class="form-control inputC" id="email">
          </div>
          <div class="form-group" align="center">
            <!--<label for="pwd">Password:</label>-->
            <input name="pwd" type="password" placeholder="Password" class="form-control inputC" id="pwd">
          </div>
          <div class="form-group" align="center">
            <input name="rePass" type="password" onblur="passwd_retype_check()" placeholder="Retype Password" class="form-control inputC" id="retype">
          </div>
          <div class="form-group" align="center">
            <input name="nome" placeholder="Nome" class="form-control inputC" id="nome" type="text">
          </div>
          <div class="form-group" align="center">
            <input name="cognome" placeholder="Cognome" class="form-control inputC" id="cogn" type="text">
          </div>
          <div class="form-group" align="center">
            <input name="room" placeholder="Numero Camera" class="form-control inputC" id="ncamera" type="number">
          </div>
          <button type="submit" name="submit" class="btn btn1" id="reg">Registrati</button>
        </form> 

      </div>
    </div>
    
  </body>
</html>