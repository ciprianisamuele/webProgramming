<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
include("dbh.inc.php");


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Controlla la connessione
    // Prepara l'istruzione SQL con i parametri

    $sql = "INSERT INTO venditori (venditore_id, nome, email, telefono, indirizzo, prezzo, descrizione, image_uri, lat, lng) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    // Controlla se la preparazione dell'istruzione ha avuto successo
    if ($stmt === false) {
        die("Errore di preparazione dell'istruzione SQL: " . $con->error);
    }

    // Associa i parametri all'istruzione preparata
    $stmt->bind_param("sssdsdssss", $user_id, $nome, $email, $telefono, $indirizzo, $prezzo, $descrizione, $imageUri, $lat, $lng);

    // Recupera i dati dal modulo inviato
    $user_id= $_POST['user_id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $indirizzo = $_POST['indirizzo'];
    $prezzo = $_POST['prezzo'];
    $descrizione = $_POST['descrizione'];
    $lat= $_POST['lat'];
    $lng= $_POST['lng'];

    // Caricamento delle immagini
    $targetDirectory = "imginc/";
    $imagePaths = array();

    foreach ($_FILES["foto"]["name"] as $key => $fileName) {
        $imageFileName = uniqid() . "_" . basename(str_replace(' ', '', $fileName));
        $targetFilePath = $targetDirectory . $imageFileName;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"][$key], $targetFilePath)) {
            $imagePaths[] = $targetFilePath;
        } else {
            echo "Errore nel caricamento dell'immagine.";
        }
    }

    // Inserisci i dati del venditore nel database
    $imageUri = implode(",", $imagePaths); // Unisci i percorsi delle immagini separati da virgola
    if ($stmt->execute()) {
        echo "Dati inseriti correttamente nella tabella 'venditori'.";
    } else {
        echo "Errore durante l'inserimento dei dati del venditore: " . $stmt->error;
    }

    // Chiudi l'istruzione preparata e la connessione al database
    $stmt->close();
    $con->close();

}