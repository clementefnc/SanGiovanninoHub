<?php

function bisestile($anno){
    if($anno % 100 == 0){
        if($anno % 400 == 0)
            return true;
    }
    else {
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

?>