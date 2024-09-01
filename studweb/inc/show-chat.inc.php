
<?php
include("dbh.inc.php");
include("functions.inc.php");
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$output="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se i parametri sono stati inviati correttamente
    if (isset($_POST["user1"]) && isset($_POST["user2"])) {
        // Recupera i valori dei parametri
        $user1 = $_POST["user1"];
        $user2 = $_POST["user2"];

        $sql = "SELECT * FROM messages WHERE (sender_id = '$user1' AND receiver_id = '$user2')
           OR (sender_id = '$user2' AND receiver_id = '$user1')
        ORDER BY id DESC; ;";

        

        $result = mysqli_query( $con, $sql );

        $boolStart =1;

        

        while($row = mysqli_fetch_array($result)){
            
            $ora = substr($row['date'], 11, 5);

            if ($row['state'] == 0 && $row['receiver_id'] == $_SESSION['user_id']) {
                $unseen_message_ids[] = $row['id'];
            }

            if($boolStart){
                $output .= '<div class="father-chat">';
                $boolStart = 0;
                $prec_rec = $row['receiver_id'];
            }

            else if($prec_rec != $row['receiver_id']){

                $output .= '</div>';
                $output .= '<div class="father-chat">';
                $prec_rec = $row['receiver_id'];
            }

            if($row['receiver_id'] == $_SESSION['user_id']){
                

                $output .= '<div class="chat-incoming">
                            <div class="details">
                                <img src="' . returnURI($con, $row['sender_id']) . '" class="profile-image">
                                <p>' . $row['content'] . '</p>
                                <div class="ora">' . $ora .' </div>
                            </div>
                        </div>';
            }
            else{
                $output .= '<div class="chat-outgoing">
                            <div class="details">
                                <p>' . $row['content'] . '</p>
                                <div class="ora">' . $ora .' </div>
                            </div>
                        </div>';
            }
        }

        $output .= '</div>';

        if (!empty($unseen_message_ids)) {
            $id_list = implode(',', $unseen_message_ids);
            $update_sql = "UPDATE messages SET state = 1 WHERE id IN ($id_list)";
            mysqli_query($con, $update_sql);
        }


    } else {
        // Se i parametri non sono stati inviati correttamente, restituisci un messaggio di errore
        echo "Errore: Parametri mancanti.";
    }
} 
echo ($output);

$con->close(); //AGGIUNTO CONTROLLARE!!