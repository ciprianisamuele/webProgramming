<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );


include "inc/dbh.inc.php";


// Verifica se l'utente è autenticato
if (isset($_SESSION['user_id'])) {
    // Aggiorna l'ultima attività dell'utente nel database
    $user_id = $_SESSION['user_id'];

    // Prepara e esegue la query per aggiornare l'ultima attività dell'utente
    $sql = "UPDATE users SET last_activity = NOW() WHERE user_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $user_id);

    if ($stmt->execute()) {
        echo "Ultima attività aggiornata con successo.";
    } else {
        echo "Errore durante l'aggiornamento dell'ultima attività: " . $stmt->error;
    }

    // Chiudi la query preparata
    $stmt->close();
} else {
    echo "L'utente non è autenticato.";
}

// Chiudi la connessione al database
$con->close();