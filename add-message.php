<?php

include("inc/dbh.inc.php");
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se i parametri sono stati inviati correttamente
    if (isset($_POST["tastiera"]) && !empty($_POST["tastiera"])) {
        // Recupera i valori dei parametri
        $user_out = $_POST["outgoing_id"];
        $user_in = $_POST["incoming_id"];

        $sql = "INSERT INTO messages (sender_id, receiver_id, content, state) VALUES (?,?,?,FALSE);";

        $stmt = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Failed";
        }

   

        mysqli_stmt_bind_param($stmt, "sss", $user_out, $user_in, $_POST['tastiera']);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        


    } else {
        // Se i parametri non sono stati inviati correttamente, restituisci un messaggio di errore
        echo "Errore: Parametri mancanti.";
    }
} else {
    // Se la richiesta non è stata effettuata tramite metodo POST, restituisci un messaggio di errore
    echo "Errore: Richiesta non valida.";
}

$con->close(); //AGGIUNTO CONTROLLARE!!

echo"andato";