<?php 

if( isset($_POST['cambia']) ) {

    include_once '../../inc/db.inc.php';

    if( $_POST['stanzaArrivo'] <= 1 || $_POST['stanzaArrivo'] > 90 || $_POST['stanzaPartenza'] <= 1 || $_POST['stanzaPartenza'] > 90){
        echo '<script type="text/javascript">alert("Valori non validi."); window.location="../admin.php?error"</script>';
    }

    $sql = "UPDATE users SET users_room=" . $_POST['stanzaArrivo'] . " WHERE users_room=" . $_POST['stanzaPartenza'] ;

    if(mysqli_query($conn, $sql)){
        echo '<script type="text/javascript">alert("Variazione eseguita."); window.location="../admin.php?error"</script>';
    }
    else {
        echo '<script type="text/javascript">alert("ERRORE: variazione non eseguita."); window.location="../admin.php?error"</script>';
    }

}


?>