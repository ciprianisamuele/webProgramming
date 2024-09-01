<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );


include "dbh.inc.php";
include "functions.inc.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $output = '';

    
    $query = "SELECT * FROM chats WHERE user1_id = ? OR user2_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ss", $_SESSION["user_id"], $_SESSION["user_id"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        
        
        $user_contact_id = ($row['user1_id'] == $_SESSION["user_id"]) ? $row['user2_id'] : $row['user1_id'];

        $row_user = getUserDetails($con, $user_contact_id);
        $message = returnLastMessage($con, $_SESSION['user_id'], $user_contact_id);

        $image = $row_user["image"];
        $name = $row_user["name"];
        $surname = $row_user["surname"];

        if ($message) {
            $message_content = $message['content'];
            $message_state = $message['state'];
            $message_sender = $message['sender_id'];
            $message_timem = $message['date'];

            $message_class = (!$message_state) ? 'unseen' : 'seen';

            $distanza_tempo = returnQuantoTempo($message_timem);


            if($message_sender == $user_contact_id){

                $output .= "<div class='contact  $message_class' data-user-id='" . $_SESSION['user_id'] . "' data-contact-id='$user_contact_id', id= $num>
                                <img src='$image' class='profile-image'>
                                <div class='info'>
                                    <div class='up'>
                                        <div class='name'>$name $surname</div>
                                        <div class='tempo'>$distanza_tempo</div> 
                                    </div>
                                    <div class='last-message $message_class'> 
                                        <div class='content'>$message_content </div>
                                    </div>
                                </div>
                                
                            </div>";
            }
            else{

                $output .= "<div class='contact' data-user-id='" . $_SESSION['user_id'] . "' data-contact-id='$user_contact_id', id= $num>
                                <img src='$image' class='profile-image'>
                                <div class='info'>
                                    <div class='up'>
                                        <div class='name'>$name $surname</div>
                                        <div class='tempo'>$distanza_tempo</div> 
                                    </div>
                                    <div class='last-message'> 
                                        <div class='content'>$message_content</div>
                                    </div>
                                </div>
                            </div>";

            }

        }
        else{
            $output .= "<div class='contact' data-user-id='" . $_SESSION['user_id'] . "' data-contact-id='$user_contact_id', id= $num>
                            <img src='$image' class='profile-image'>
                            <div class='info'>
                                <div class='name'>$name $surname</div>
                                <div class='last-message start'> 
                                    <div class='content'>Inizia una conversazione</div>
                                </div>
                            </div>
                        </div>";
        }

        $num++;

        
    }

    echo $output;

}

