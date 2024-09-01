<?php
include("inc/dbh.inc.php");
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );



$query = "SELECT * FROM chats WHERE user1_id = ? OR user2_id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "ss", $_SESSION["user_id"], $_SESSION["user_id"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {

    $user_contact_id = ($row['user1_id'] == $_SESSION["user_id"]) ? $row['user2_id'] : $row['user1_id'];

    $user_id = $_SESSION['user_id'];

    $messages = returnLastMessage($con, $user_id, $user_contact_id);

    if($messages[0]['state'] == 'seen') {

        echo 0;
        die();
    }
    if($messages[1]['state'] = 'seen'){

        echo 1;
        die();
    }
    else{

        echo 2;
        die();
    }
}

echo $output;



// Chiudere la connessione
mysqli_close($con);

