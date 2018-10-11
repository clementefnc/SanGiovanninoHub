<?php

include_once '../inc/db.inc.php';

date_default_timezone_set("Europe/Rome");
setlocale(LC_TIME, array('it_IT.UTF-8','it_IT@euro','it_IT','italian'));

//echo "Oggi è " . strftime("%A %d/%m/%Y") . "<br>";

$giornoOggi = intval(strftime("%d"),10);
$meseOggi = intval(strftime("%m"),10);
$annoOggi = intval(strftime("%Y"),10);

$giornoSettimanaOggi = strftime("%a");

//echo "In interi oggi è " . $giornoOggi . "/" . $meseOggi . "/" . $annoOggi . "<br><br><br><br>";


//stampa di prova

//+0
//echo "Oggi è " . $giornoOggi . "/" . $meseOggi . "/" . $annoOggi . "<br>";
$piu0 = array($giornoOggi,$meseOggi,$annoOggi,$giornoSettimanaOggi);

//+1
$piu1 = giornoSuccessivo($giornoOggi,$meseOggi,$annoOggi,$giornoSettimanaOggi);
//echo "Domani è " . $piu1[0] . "/" . $piu1[1] . "/" . $piu1[2] . "<br>";

//+2
$piu2 = giornoSuccessivo($piu1[0],$piu1[1],$piu1[2],$piu1[3]);
//echo "Dopodomani è " . $piu2[0] . "/" . $piu2[1] . "/" . $piu2[2] . "<br>";

//+3
$piu3 = giornoSuccessivo($piu2[0],$piu2[1],$piu2[2],$piu2[3]);
//echo "Fra 3 giorni è " . $piu3[0] . "/" . $piu3[1] . "/" . $piu3[2] . "<br>";

//+4
$piu4 = giornoSuccessivo($piu3[0],$piu3[1],$piu3[2],$piu3[3]);
//echo "Fra 4 giorni è " . $piu4[0] . "/" . $piu4[1] . "/" . $piu4[2] . "<br>";

//+5
$piu5 = giornoSuccessivo($piu4[0],$piu4[1],$piu4[2],$piu4[3]);
//echo "Fra 5 giorni è " . $piu5[0] . "/" . $piu5[1] . "/" . $piu5[2] . "<br>";

//+6
$piu6 = giornoSuccessivo($piu5[0],$piu5[1],$piu5[2],$piu5[3]);
//echo "Fra 6 giorni è " . $piu6[0] . "/" . $piu6[1] . "/" . $piu6[2] . "<br>";

$piu = array($piu0,$piu1,$piu2,$piu3,$piu4,$piu5,$piu6);

function bisestile($anno){

    if($anno % 100 == 0){
        //anno secolare
        if($anno % 400 == 0)
            return true;
    }
    else {
        //anno non secolare
        if($anno % 4 == 0)
            return true;
    }

    return false;
}

function giornoSuccessivo($g,$m,$a,$s){
    if(($m == 11 || $m == 4 || $m == 6 || $m == 9) && $g == 30 ){
        //novembre, aprile, giugno, settembre
        //è l'ultimo del mese
    
        $g_1 = 1;
        $m_1 = $m + 1;
        $a_1 = $a;
    
    }
    
    else if ($m == 2 && ($g==28 || $g==29)){
        //febbraio
        //controllare se anno è bisestile
    
        $bisestile = bisestile($a);
    
        //calcolo +1
        if($bisestile && $g==28){
            $g_1 = 29;
            $m_1 = $m;
        }
        else if ($bisestile && $g==29) {
            $g_1 = 1;
            $m_1 = 3;
        }
        else {
            //no bisestile
            $g_1 = 1;
            $m_1 = 3;
        }
        
        $a_1 = $a;
    
    }
    
    else if ( ($m == 1 || $m == 3 || $m == 7 || $m == 8 || $m == 10 || $m == 12 ) && ($g == 31) ){
        //gennaio, marzo, maggio, luglio, agosto, ottobre, dicembre
    
        if($m == 12){
            $g_1 = 1;
            $m_1 = 1;
            $a_1 = $a + 1;
        }
        else {
            $g_1 = 1;
            $m_1 = $m + 1;
            $a_1 = $a;
        }
    
    }

    else {
        $g_1 = $g + 1;
        $m_1 = $m;
        $a_1 = $a;
    }

    if(strcmp($s,"lun")==0) $s="mar";
    else if(strcmp($s,"mar")==0) $s="mer";
    else if(strcmp($s,"mer")==0) $s="gio";
    else if(strcmp($s,"gio")==0) $s="ven";
    else if(strcmp($s,"ven")==0) $s="sab";
    else if(strcmp($s,"sab")==0) $s="dom";
    else if(strcmp($s,"dom")==0) $s="lun";

    return array($g_1, $m_1, $a_1, $s);
}

session_start();

if (!empty($_SESSION)) {

echo '

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

    <!-- <script>

    window.onload = function () { alert("GLI SLOT DELLA LAVATRICE SONO DA INTENDERSI PER LA LAVATRICE NON A PAGAMENTO, FINO A NUOVO ORDINE.") }

    </script> -->

</head>
<body>

    <div class="topnav" style="position:relative">
        <a class="active" href="https://www.sangiovannino.altervista.org">SanGiovannino HUB</a>
        <form method="post" action="../inc/inc_logout.php" style="margin:0; padding:0">
        <button type="submit" name="submit" class="btn btn-danger" style="position:absolute; right:10px; margin-top: 10px">LOGOUT</button>
        </form>
    </div> 

    <p align=center style="background-color: #f2f2f2; color: red; font-size: 150%;">LavN è la lavatrice nuova (quella piccola senza asciugatrice), LavV è l\'altra. Per il momento l\'asciugatrice è anarchia pura.</p>

    <div class="topnav" style="background-color: #f2f2f2;">
        <form method="post" action="../inc/inc_prenota.php">
            <div class="form-group" style="width:12%; display: inline-block;">
                <label style="color:#0c0c0c">Giorno</label>
                <select class="form-control" name="giornoSelect">
                  <option>'. $piu0[0] . '/' . $piu0[1] . '/' . $piu0[2] .'</option>
                  <option>'. $piu1[0] . '/' . $piu1[1] . '/' . $piu1[2] .'</option>
                  <option>'. $piu2[0] . '/' . $piu2[1] . '/' . $piu2[2] .'</option>
                  <option>'. $piu3[0] . '/' . $piu3[1] . '/' . $piu3[2] .'</option>
                  <option>'. $piu4[0] . '/' . $piu4[1] . '/' . $piu4[2] .'</option>
                  <option>'. $piu5[0] . '/' . $piu5[1] . '/' . $piu5[2] .'</option>
                  <option>'. $piu6[0] . '/' . $piu6[1] . '/' . $piu6[2] .'</option>
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
            <th colspan = "2">' . $giornoSettimanaOggi . "<br>" . $giornoOggi . "/" . $meseOggi . "/" . $annoOggi . '</th>
            <th colspan = "2">' . $piu1[3] . "<br>" . $piu1[0] . "/" . $piu1[1] . "/" . $piu1[2] . '</th>
            <th colspan = "2">' . $piu2[3] . "<br>" . $piu2[0] . "/" . $piu2[1] . "/" . $piu2[2] . '</th>
            <th colspan = "2">' . $piu3[3] . "<br>" . $piu3[0] . "/" . $piu3[1] . "/" . $piu3[2] . '</th>
            <th colspan = "2">' . $piu4[3] . "<br>" . $piu4[0] . "/" . $piu4[1] . "/" . $piu4[2] . '</th>
            <th colspan = "2">' . $piu5[3] . "<br>" . $piu5[0] . "/" . $piu5[1] . "/" . $piu5[2] . '</th>
            <th colspan = "2">' . $piu6[3] . "<br>" . $piu6[0] . "/" . $piu6[1] . "/" . $piu6[2] . '</th>
        </tr>
        <tr>
            <th></th>
            <th>LavV</th>
            <th>LavN</th>
            <th>LavV</th>
            <th>LavN</th>
            <th>LavV</th>
            <th>LavN</th>
            <th>LavV</th>
            <th>LavN</th>
            <th>LavV</th>
            <th>LavN</th>
            <th>LavV</th>
            <th>LavN</th>
            <th>LavV</th>
            <th>LavN</th>
        </tr>
        </thead>

        <tbody>';
        
        for ($i = 6; $i < 24; $i++) {
            echo '<tr> <td align="center">'. $i . ':00</td>';

            for ($j = 0; $j <= 6; $j++){

                //ASCIUGATRICE
                echo '<td align="center" style="font-size: 12px">';
                
                $sql = "SELECT users_name, users_cog, users_room 
                        FROM users, asciugatrice 
                        WHERE a_giorno=".intval($piu[$j][0],10)
                            ." AND a_mese=".intval($piu[$j][1],10)
                            ." AND a_anno=".intval($piu[$j][2],10)
                            ." AND a_ora=".intval($i,10)
                            ." AND users_mail=a_email";
                    $result = mysqli_query($conn, $sql);

                //printare il risultato della query
                $check = mysqli_num_rows($result);

                if($check>0)
                while($row = $result->fetch_assoc()) {
                    echo $row["users_cog"] . "<br>" . "<strong>" . $row["users_room"] . "</strong>";
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

                if($check>0)
                while($row = $result->fetch_assoc()) {
                    echo $row["users_cog"] . "<br>" . "<strong>" . $row["users_room"] . "</strong>";
                }
                
                echo '</td>';
            }

            echo '</tr>';
        }

    echo 
        '
        </tbody>
    </table>

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

</script>';

echo

'
    
</body>
</html>

';

}
else {
    header("Location: ../index_notlogged.php");
}

?>