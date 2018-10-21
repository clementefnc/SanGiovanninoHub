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


    <!-- NAVBAR -->
    <?php include '../navbar/navbar_not_logged.php'; ?>

    <!-- CONTENT -->
    <div class="box" style="margin-top: 7%;" align="center">
      <div class="box-desktop" align="center">
        <h2 class="intestazione">Accedi</h2> 
        <form  action="inc/inc_login.php" method="post" class="align-items-center formD">
          <div class="form-group" align="center">
            <input name="mail" type="email" placeholder="Email" class="form-control inputC" id="email">
          </div>
          <div class="form-group" align="center">
            <input name="pwd" type="password" placeholder="Password" class="form-control inputC" id="pwd">
          </div>
          <button type="submit" name="submit" class="btn btn1">Login</button>
        </form> 
      </div>
  </div>


  </body>
</html>