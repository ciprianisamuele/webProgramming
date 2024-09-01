<?php


error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

include "dbh.inc.php";



if ($_SERVER["REQUEST_METHOD"] == "GET"){

    if (isset($_GET['start_lat'])) {
        $start_lat = $_GET['start_lat'];
        $start_lng = $_GET['start_lng'];
        $fin_lat = $_GET['fin_lat'];
        $fin_lng = $_GET['fin_lng'];
        $city = "area della mappa";
        $res = " risultati nell'area della mappa selezionata";
    }
    else{
        $max_lat = 0.094478;
        $max_lng = 0.085830;

        $start_lat = $_GET['lat'] + $max_lat/2;
        $start_lng = $_GET['lng'] + $max_lng/2;
        $fin_lat = $_GET['lat'] - $max_lat/2;;
        $fin_lng =  $_GET['lng'] - $max_lng/2;
        $city = $_GET['city'];
        $res = ' risultati per la località: ' . $city;

    }
    



    $coordinateArray = array(); 

    // Esegui una query per trovare i venditori nella zona vicina utilizzando il testo di ricerca
    $query = "SELECT *
    FROM venditori
    WHERE CAST(lat AS FLOAT) BETWEEN CAST(? AS FLOAT) AND CAST(? AS FLOAT)
    AND CAST(lng AS FLOAT) BETWEEN CAST(? AS FLOAT) AND CAST(? AS FLOAT)";

    $stmt = $con->prepare($query);
    $stmt->bind_param("ssss", $fin_lat, $start_lat, $fin_lng, $start_lng);
    $stmt->execute();
    $result = $stmt->get_result();


    // Mostra i risultati della ricerca
    if ($result->num_rows > 0) {
        echo '<div class="num-results">';
        echo $result->num_rows . $res;
        echo '</div>';
        echo '<div class = "list-venditori">';
        while ($row = $result->fetch_assoc()) {
            // Genera il markup HTML per ciascun venditore
            $urls =  explode(',', $row['image_uri']);
            $qt = 0;
            echo '<div class="venditore">';
            echo '<div class= image-container>';
            echo '<div class= image-slider>';
            foreach ($urls as $url) {
                    echo '<img src=" http://localhost/studweb/inc/' . $url . '">';
                    $qt++;
            }
            echo'</div>';
            echo '<button class="prev"><i class="fa-solid fa-angle-left"></i></button>
                  <button class="next"><i class="fa-solid fa-angle-right"></i></button>
                  <div class="dot-container">1/' . $qt . '
                  </div>';
            echo'</div>';
            echo '<h3>' . $row['nome'] . '</h3>';
            echo '<p>' . $row['descrizione'] . '</p>';
            // Aggiungi altri dettagli del venditore se necessario
            echo '</div>';

            $coordinate = array(
                "lat" => $row['lat'], // Sostituisci 'lat' con il nome corretto della colonna nella tua tabella del database
                "lng" => $row['lng']  // Sostituisci 'lng' con il nome corretto della colonna nella tua tabella del database
            );
        
            // Aggiungi l'array delle coordinate all'array principale
            $coordinateArray[] = $coordinate;
  
        }
        echo '</div>';
    } else {
        echo "Nessun venditore trovato nella zona indicata.";
    }

    // Chiudi la connessione al database
    $stmt->close();
    $con->close();


    // Stringa separatrice
    echo "<!--JSON_SEPARATOR-->";

    // Parte 2: Genera i dati JSON da restituire


    // Restituisci i dati JSON
    echo json_encode($coordinateArray);
 
}


