<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );



include "inc/dbh.inc.php";

// Controlla se l'utente è postato
if (isset($_POST['user_id'])) {
    // Aggiorna l'ultima attività dell'utente nel database o in un altro sistema di memorizzazione
    // Ad esempio, potresti eseguire una query MySQL per aggiornare un campo last_activity nella tabella degli utenti

 

    // Verifica la connessione
    if ($con->connect_error) {
        die("Connessione al database fallita: " . $con->connect_error);
    }

    // Prepara e esegue la query per vedere l'ultima attività dell'utente
    $user_id = $_POST['user_id'];


    $sql = "SELECT * FROM users WHERE user_id = ? limit 1"; 
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $name = $row['name'];
        $surname = $row['surname'];

        echo''. strtoupper($name) .' '. strtoupper($surname) .'';


    } else {
        echo "Errore con la query" . $con->error;
    }

    // Chiudi la connessione al database
    $con->close();
} else {
    echo "non postato niente";
}
