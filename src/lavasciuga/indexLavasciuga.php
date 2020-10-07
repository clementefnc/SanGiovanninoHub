<?php

include_once '../inc/db.inc.php';
include '../inc/dateFunc.php';

date_default_timezone_set("Europe/Rome");
setlocale(LC_TIME, array('it_IT.UTF-8','it_IT@euro','it_IT','italian'));

$giornoOggi = intval(strftime("%d"),10);
$meseOggi = intval(strftime("%m"),10);
$annoOggi = intval(strftime("%Y"),10);

$giornoSettimanaOggi = strftime("%a");

$piu0 = array($giornoOggi,$meseOggi,$annoOggi,$giornoSettimanaOggi);
$piu1 = giornoSuccessivo($giornoOggi,$meseOggi,$annoOggi,$giornoSettimanaOggi);
$piu2 = giornoSuccessivo($piu1[0],$piu1[1],$piu1[2],$piu1[3]);
$piu3 = giornoSuccessivo($piu2[0],$piu2[1],$piu2[2],$piu2[3]);
$piu4 = giornoSuccessivo($piu3[0],$piu3[1],$piu3[2],$piu3[3]);
$piu5 = giornoSuccessivo($piu4[0],$piu4[1],$piu4[2],$piu4[3]);
$piu6 = giornoSuccessivo($piu5[0],$piu5[1],$piu5[2],$piu5[3]);

$piu = array($piu0,$piu1,$piu2,$piu3,$piu4,$piu5,$piu6);

session_start();

if (!empty($_SESSION)) {
//utente loggato, mostra contenuto

?>

    <!DOCTYPE html>
    <html>
    <head>
    	<title>Prenotazioni - Lavanderia</title>
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
    <body>

        <div class="topnav" style="position:relative">
            <a class="active" href="https://www.sangiovannino.altervista.org">SanGiovannino HUB</a>
            <form method="post" action="../inc/inc_logout.php" style="margin:0; padding:0">
            <button type="submit" name="submit" class="btn btn-danger" style="position:absolute; right:10px; margin-top: 10px">LOGOUT</button>
            </form>
        </div> 

       <!--  <p align=center style="background-color: #f2f2f2; color: red; font-size: 150%;">LavN è la lavatrice GRIGIA; LavV è la lavatrice BIANCA PICCOLA</p> -->

        <div class="topnav" style="background-color: #f2f2f2;">
            <form method="post" action="../inc/inc_prenota.php">
                <div class="form-group" style="width:12%; display: inline-block;">
                    <label style="color:#0c0c0c">Giorno</label>
                    <select class="form-control" name="giornoSelect">
                      <option><?php echo $piu0[0] ?>/<?php echo $piu0[1] ?>/<?php echo $piu0[2] ?></option>
                      <option><?php echo $piu1[0] ?>/<?php echo $piu1[1] ?>/<?php echo $piu1[2] ?></option>
                      <option><?php echo $piu2[0] ?>/<?php echo $piu2[1] ?>/<?php echo $piu2[2] ?></option>
                      <option><?php echo $piu3[0] ?>/<?php echo $piu3[1] ?>/<?php echo $piu3[2] ?></option>
                      <option><?php echo $piu4[0] ?>/<?php echo $piu4[1] ?>/<?php echo $piu4[2] ?></option>
                      <option><?php echo $piu5[0] ?>/<?php echo $piu5[1] ?>/<?php echo $piu5[2] ?></option>
                      <option><?php echo $piu6[0] ?>/<?php echo $piu6[1] ?>/<?php echo $piu6[2] ?></option>
                    </select>
                  </div>

                <div class="form-group" style="width:12%; display: inline-block; margin-left:5px;">
                    <label style="color:#0c0c0c">Ora</label>
                    <select class="form-control" name="oraSelect">
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                      <option>11</option>
                      <option>12</option>
                      <option>13</option>
                      <option>14</option>
                      <option>15</option>
                      <option>16</option>
                      <option>17</option>
                      <option>18</option>
                      <option>19</option>
                      <option>20</option>
                      <option>21</option>
                      <option>22</option>
                      <option>23</option>
                    </select>
                  </div>          

                  <div class="form-group" style="width:12%; display: inline-block;">
                    <label style="color:#0c0c0c">Scegli</label>
                    <select class="form-control" name="macchinaSelect">
                      <option>Lavatrice</option>
                      <option>Asciugatrice</option>
                    </select>
                  </div>

                  <button type="submit" name="submit" class="btn btn-success" style="margin-left: 5px">PRENOTA</button>
                  <button type="submit" name="send" class="btn btn-danger" style="margin-left: 5px">SPRENOTA</button>
            </form>
        </div>

    	<div class="content" style="width: 100%;margin: 0; padding: 0;">
    		 
    	<table  class="table table-striped table-bordered">
            <thead>
            <tr id="fix">
                <th colspan = "1">Ora</th>
                <th colspan = "2">
                    <?php echo $giornoSettimanaOggi ?><br><?php echo $giornoOggi ?>/<?php echo $meseOggi ?>/<?php echo $annoOggi ?>
                </th>
                <th colspan = "2">
                    <?php echo $piu1[3] ?><br><?php echo $piu1[0] ?>/<?php echo $piu1[1] ?>/<?php echo $piu1[2] ?>
                </th>
                <th colspan = "2">
                    <?php echo $piu2[3] ?><br><?php echo $piu2[0] ?>/<?php echo $piu2[1] ?>/<?php echo $piu2[2] ?>
                </th>
                <th colspan = "2">
                    <?php echo $piu3[3] ?><br><?php echo $piu3[0] ?>/<?php echo $piu3[1] ?>/<?php echo $piu3[2] ?>
                </th>
                <th colspan = "2">
                    <?php echo $piu4[3] ?><br><?php echo $piu4[0] ?>/<?php echo $piu4[1] ?>/<?php echo $piu4[2] ?>
                </th>
                <th colspan = "2">
                    <?php echo $piu5[3] ?><br><?php echo $piu5[0] ?>/<?php echo $piu5[1] ?>/<?php echo $piu5[2] ?>
                </th>
                <th colspan = "2">
                    <?php echo $piu6[3] ?><br><?php echo $piu6[0] ?>/<?php echo $piu6[1] ?>/<?php echo $piu6[2] ?>
                </th>
            </tr>
            <tr>
                <th></th>
                <th>Asc</th>
                <th>Lav</th>
                <th>Asc</th>
                <th>Lav</th>
                <th>Asc</th>
                <th>Lav</th>
                <th>Asc</th>
                <th>Lav</th>
                <th>Asc</th>
                <th>Lav</th>
                <th>Asc</th>
                <th>Lav</th>
                <th>Asc</th>
                <th>Lav</th>
            </tr>
            </thead>

            <tbody>


<!-- CICLO PER FARCIRE IL BODY DELLA TABELLA -->

    <?php
        
        for ($i = 6; $i < 24; $i++) {
            echo '<tr> <td align="center">'. $i . ':00</td>';

            for ($j = 0; $j <= 6; $j++){

                //ASCIUGATRICE
                echo '<td align="center" style="font-size: 12px">';
                
//                $sql = "SELECT users_name, users_cog, users_room 
//                        FROM users, asciugatrice 
//                        WHERE a_giorno=".intval($piu[$j][0],10)
//                            ." AND a_mese=".intval($piu[$j][1],10)
//                            ." AND a_anno=".intval($piu[$j][2],10)
//                            ." AND a_ora=".intval($i,10)
//                            ." AND users_mail=a_email";


					$sql = "SELECT users_name, users_cog, users_room 
                        FROM users, asciugatrice 
                        WHERE a_giorno=".intval($piu[$j][0],10)
                            ." AND a_mese=".intval($piu[$j][1],10)
                            ." AND a_anno=".intval($piu[$j][2],10)
                            ." AND a_ora=".intval($i,10)
                            ." AND users_mail=a_email";

                    $result = mysqli_query($conn, $sql);
                    // echo intval($piu[$j][0],10).' '.intval($piu[$j][1],10).' '.intval($piu[$j][2],10).' '.intval($i,10);

                //printare il risultato della query
                $check = mysqli_num_rows($result);
                // echo $check . "yo";

                if($check>0){
                while($row = $result->fetch_assoc()) {
                    echo $row["users_cog"] . "<br>" . "<strong>" . $row["users_room"] . "</strong>";
                }
                //echo "oh yes";
                }
                
                echo '</td>';

                echo '<td align="center" style="font-size: 12px">';

                $sql = "SELECT users_name, users_cog, users_room 
                        FROM users, prenotazioni 
                        WHERE giorno=".intval($piu[$j][0],10)
                            ." AND mese=".intval($piu[$j][1],10)
                            ." AND anno=".intval($piu[$j][2],10)
                            ." AND ora=".intval($i,10)
                            ." AND users_mail=email";
                    $result = mysqli_query($conn, $sql);

                //printare il risultato della query
                $check = mysqli_num_rows($result);

                if($check>0){
                while($row = $result->fetch_assoc()) {
                    echo $row["users_cog"] . "<br>" . "<strong>" . $row["users_room"] . "</strong>";
                }
                }
                
                echo '</td>';
            }

            echo '</tr>';
        }

    ?>
        </tbody>
    </table>

<!-- FINE CICLO TABELLA -->


<!-- Manteniamo la riga con la settimana in alto -->
 <script type="text/javascript">
        
    window.onscroll = function(){
        scrolling()
    };

    var header = document.getElementById("fix");
    var sticky = header.offsetTop; 

    function scrolling(){
         if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

</script>    
</body>
</html>

<?php
    }
    else {
        header("Location: ../index_notlogged.php");
    }

?>