<?php

session_start();


if(isset($_POST['submit'])){
    include_once 'db.inc.php';

    $data = explode("/",$_POST['giornoSelect']);
    $ora = intval($_POST['oraSelect'],10);
    $macchina = $_POST['macchinaSelect'];
    $giorno = $data[0];
    $mese = $data[1];
    $anno = $data[2];

    if(strcmp($macchina,"Lavatrice")==0){
        $sql = "SELECT * FROM prenotazioni WHERE giorno=" . $giorno .
            " AND mese=" . $mese .
            " AND anno=" . $anno .
            " AND ora=" . $ora;

        $result = mysqli_query($conn, $sql);

        //printare il risultato della query
        $check = mysqli_num_rows($result);

        if($check>0) {
            echo '<script type="text/javascript">alert("ORA GIÀ PRENOTATA."); window.location="../lavasciuga/indexLavasciuga.php"</script>';
        }
        else{

            $sql = "SELECT COUNT(*) AS cnt
                    FROM prenotazioni 
                    WHERE email=" . "'" . $_SESSION['u_mail'] . "'" . 
                    " AND giorno=" . $giorno .
                    " AND mese=" . $mese . 
                    " AND anno=" . $anno;

            $result = mysqli_query($conn, $sql);

            $check = mysqli_num_rows($result);

                    if($check>0)
                        $row = $result->fetch_assoc();
                

            if (intval($row['cnt'],10) >= 2) {
                echo '<script type="text/javascript">alert("NUMERO MASSIMO DI PRENOTAZIONI RAGGIUNTO."); window.location="../lavasciuga/indexLavasciuga.php"</script>';
            }else{

                $sql = "INSERT INTO prenotazioni (email,giorno,mese,anno,ora) 
                    VALUES (" . "'" . $_SESSION['u_mail'] . "'" . "," . $giorno . "," . $mese . "," . $anno . "," . $ora .")";
                mysqli_query($conn, $sql);
                header("Location: ../lavasciuga/indexLavasciuga.php");
            }
        }

    }else{
        $sql = "SELECT * FROM asciugatrice WHERE a_giorno=" . $giorno .
            " AND a_mese=" . $mese .
            " AND a_anno=" . $anno .
            " AND a_ora=" . $ora;

            $result = mysqli_query($conn, $sql);

            //printare il risultato della query
            $check = mysqli_num_rows($result);
    
            if($check>0) {
                echo '<script type="text/javascript">alert("ORA GIÀ PRENOTATA."); window.location="../lavasciuga/indexLavasciuga.php"</script>';
            }
            else{

                 $sql = "SELECT COUNT(*) AS cnt
                    FROM asciugatrice 
                    WHERE a_email=" . "'" . $_SESSION['u_mail'] . "'" . 
                    " AND a_giorno=" . $giorno .
                    " AND a_mese=" . $mese . 
                    " AND a_anno=" . $anno;

            $result = mysqli_query($conn, $sql);

            $check = mysqli_num_rows($result);

                    if($check>0)
                        $row = $result->fetch_assoc();
                

                if (intval($row['cnt'],10) >= 2) {
                    echo '<script type="text/javascript">alert("NUMERO MASSIMO DI PRENOTAZIONI RAGGIUNTO."); window.location="../lavasciuga/indexLavasciuga.php"</script>';
                }else{

                    $sql = "INSERT INTO asciugatrice (a_email,a_giorno,a_mese,a_anno,a_ora) 
                    VALUES (" . "'" . $_SESSION['u_mail'] . "'" . "," . $giorno . "," . $mese . "," . $anno . "," . $ora .")";
                mysqli_query($conn, $sql);
                header("Location: ../lavasciuga/indexLavasciuga.php");
                }
            }
    }

}
//SPRENOTA
else if(isset($_POST['send'])){
    include_once 'db.inc.php';

    $data = explode("/",$_POST['giornoSelect']);
    $ora = intval($_POST['oraSelect'],10);
    $macchina = $_POST['macchinaSelect'];
    $giorno = $data[0];
    $mese = $data[1];
    $anno = $data[2];

    if(strcmp($macchina,"Lavatrice")==0){
        $sql = "SELECT * FROM prenotazioni WHERE giorno=" . $giorno .
            " AND mese=" . $mese .
            " AND anno=" . $anno .
            " AND email=" . "'" . $_SESSION['u_mail'] . "'" .
            " AND ora=" . $ora;

        $result = mysqli_query($conn, $sql);

        //printare il risultato della query
        $check = mysqli_num_rows($result);

        if($check<=0) {
            echo '<script type="text/javascript">alert("BIRICCHINO NON È LA TUA ORA"); window.location="../lavasciuga/indexLavasciuga.php"</script>';
        }
        else{
            $sql = "DELETE FROM prenotazioni WHERE giorno=" . $giorno .
            " AND mese=" . $mese .
            " AND anno=" . $anno .
            " AND ora=" . $ora;
            mysqli_query($conn, $sql);
            header("Location: ../lavasciuga/indexLavasciuga.php");
        }

    }else{
        $sql = "SELECT * FROM asciugatrice WHERE a_giorno=" . $giorno .
            " AND a_mese=" . $mese .
            " AND a_anno=" . $anno .
            " AND a_email=" . "'" . $_SESSION['u_mail'] . "'" .
            " AND a_ora=" . $ora;

        $result = mysqli_query($conn, $sql);

        //printare il risultato della query
        $check = mysqli_num_rows($result);

        if($check<=0) {
            echo '<script type="text/javascript">alert("BIRICCHINO NON È LA TUA ORA"); window.location="../lavasciuga/indexLavasciuga.php"</script>';
        }
        else{
            $sql = "DELETE FROM asciugatrice
            WHERE a_giorno=" . $giorno .
            " AND a_mese=" . $mese .
            " AND a_anno=" . $anno .
            " AND a_ora=" . $ora;
            mysqli_query($conn, $sql);
            header("Location: ../lavasciuga/indexLavasciuga.php");
        }
    }
}

?>