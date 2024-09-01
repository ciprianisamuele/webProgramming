<?php
include("inc/dbh.inc.php");
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se i parametri sono stati inviati correttamente
    if (isset($_POST["user1"]) && isset($_POST["user2"])) {
        // Recupera i valori dei parametri
        $user1 = $_POST["user1"];
        $user2 = $_POST["user2"];

        $sql = "INSERT INTO chats (user1_id, user2_id) VALUES (?,?);";

        $stmt = mysqli_stmt_init($con);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Failed";
        }

        mysqli_stmt_bind_param($stmt, "ss", $user1, $user2);
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