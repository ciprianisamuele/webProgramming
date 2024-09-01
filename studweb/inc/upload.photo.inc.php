


<?php

session_start();
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
include("functions.inc.php");
include("dbh.inc.php");



// Verifica se il modulo è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]["name"])) {
    // Percorso della directory in cui verranno salvate le immagini
    $targetDirectory = "imginc/";

    // Genera un nome univoco per l'immagine
    $imageFileName = uniqid() . "_" . basename(str_replace(' ', '', $_FILES["image"]["name"]));

    // Percorso completo del file dell'immagine sul server
    $targetFilePath = $targetDirectory . $imageFileName;

    // Salva l'immagine sul server
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {

        // Recupera l'ID dell'utente dalla sessione
        $userId = $_SESSION['user_id'];

        // Query per salvare l'URI dell'immagine nel database
        $imageUri = "http://localhost/studweb/inc/{$targetFilePath}"; // L'URI dell'immagine è il percorso completo sul server
        $sql = "UPDATE users SET image = ? WHERE user_id = ?";
        $stmt = $con->prepare($sql);

        // Binding dei parametri
    
        $stmt->bind_param("ss", $imageUri, $userId);

        echo $imageUri;
        // Esecuzione della query
        if ($stmt->execute()) {
            $_SESSION['image'] = $imageUri;
            echo "Immagine caricata con successo.";
        } else {
            echo "Errore durante il caricamento dell'immagine nel database.";
        }

        // Chiudi la connessione al database
        $stmt->close();
        $con->close();
    } else {
        echo "Errore durante il caricamento dell'immagine.";
    }
}