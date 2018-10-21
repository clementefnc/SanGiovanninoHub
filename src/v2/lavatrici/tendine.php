<?php

/* tabella con tendine per prenotazione/sprenotazione */

include_once '../inc/db.inc.php';

date_default_timezone_set("Europe/Rome");
setlocale(LC_TIME, array('it_IT.UTF-8','it_IT@euro','it_IT','italian'));

//echo "Oggi è " . strftime("%A %d/%m/%Y") . "<br>";

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

?>

<div class="container">           
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th colspan = "1">Ora</th>

        <th colspan = "3"><?php echo $piu0[3] . "<br>" . $piu0[0] . "/" . $piu0[1] . "/" . $piu0[2]; ?></th>
        <th colspan = "3"><?php echo $piu1[3] . "<br>" . $piu1[0] . "/" . $piu1[1] . "/" . $piu1[2]; ?></th>
        <th colspan = "3"><?php echo $piu2[3] . "<br>" . $piu2[0] . "/" . $piu2[1] . "/" . $piu2[2]; ?></th>
        <th colspan = "3"><?php echo $piu3[3] . "<br>" . $piu3[0] . "/" . $piu3[1] . "/" . $piu3[2]; ?></th>
        <th colspan = "3"><?php echo $piu4[3] . "<br>" . $piu4[0] . "/" . $piu4[1] . "/" . $piu4[2]; ?></th>
        <th colspan = "3"><?php echo $piu5[3] . "<br>" . $piu5[0] . "/" . $piu5[1] . "/" . $piu5[2]; ?></th>
        <th colspan = "3"><?php echo $piu6[3] . "<br>" . $piu6[0] . "/" . $piu6[1] . "/" . $piu6[2]; ?></th>
      </tr>
      <tr>
        <th></th>
        <th>Asc</th>
        <th>Lav1</th>
        <th>Lav2</th>
        <th>Asc</th>
        <th>Lav1</th>
        <th>Lav2</th>
        <th>Asc</th>
        <th>Lav1</th>
        <th>Lav2</th>
        <th>Asc</th>
        <th>Lav1</th>
        <th>Lav2</th>
        <th>Asc</th>
        <th>Lav1</th>
        <th>Lav2</th>
        <th>Asc</th>
        <th>Lav1</th>
        <th>Lav2</th>
        <th>Asc</th>
        <th>Lav1</th>
        <th>Lav2</th>
    </tr>
    </thead>
    <tbody>
      <tr>
      	<td>5</td>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
      	<td>6</td>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
      	<td>7</td>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>