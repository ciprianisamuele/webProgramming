<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
session_start();
include("inc/dbh.inc.php");

// Recupera l'ID dell'utente dalla sessione
$userId = $_SESSION['user_id'];

// Query per recuperare l'immagine dalla tabella
$sql = "SELECT image FROM users WHERE user_id = ?";
$stmt = $con->prepare($sql);

// Binding dei parametri
$stmt->bind_param("i", $userId);

// Esecuzione della query
$stmt->execute();

// Ottieni il risultato della query
$result = $stmt->get_result();

// Verifica se l'immagine è stata trovata
if ($result->num_rows > 0) {
    // Recupera l'immagine dalla riga del risultato
    $row = $result->fetch_assoc();
    $imageData = $row['image'];

    echo $imageData;
} else {
    echo "Nessuna immagine trovata per questo utente.";
}

// Chiudi la connessione al database
$stmt->close();
$con->close();
?>