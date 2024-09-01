<?php

session_start();
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$output="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se i parametri sono stati inviati correttamente
    if (isset($_POST["user1"]) && isset($_POST["user2"])) {
        // Recupera i valori dei parametri
        $user1 = $_POST["user1"];
        $user2 = $_POST["user2"];
        if($user1 == $_SESSION['user_id']){

            $output .= "<form class = 'typing-area' id = 'typing-area-id'>
                            <input type = 'text' name='outgoing_id' value = '$user1'>
                            <input type = 'text' name='incoming_id' value = '$user2'>
                            <input type ='text' placeholder='Scrivi qua...' name = 'tastiera'>
                            <button> <i class='fa-regular fa-paper-plane'></i> </button>
                        </form>";
        }
        else{

            $output .= "<form class = 'typing-area' id = 'typing-area-id'>
                            <input type = 'text' name='outgoing_id' value = '$user2'>
                            <input type = 'text' name='incoming_id' value = '$user1'>
                            <input type ='text' placeholder='Scrivi qua...' name = 'tastiera'>
                            <button> <i class='fa-regular fa-paper-plane'></i> </button>
                        </form>";

        }

    } else {
        // Se i parametri non sono stati inviati correttamente, restituisci un messaggio di errore
        echo "Errore: Parametri mancanti.";
    }
} 

echo $output;



