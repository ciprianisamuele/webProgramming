<?php

function isRightPassword($password, $row) {

    return password_verify($password, $row["password"]);

}
function createUser( $con,$unique_id, $name, $surname, $birthday, $email , $password, $img_uri ){

    $sql = "INSERT INTO users (user_id, name, surname, birthday, email, password, image, last_activity) VALUES (?,?,?,?,?,?,?,?);";

    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Failed";
    }
    
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $time = time();
    $time_formatted = date('Y-m-d', $time);
    mysqli_stmt_bind_param($stmt, "ssssssss", $unique_id, $name, $surname, $birthday, $email, $hashed_password, $img_uri, $time_formatted);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

}
function emailExists($con, $email){

    $sql = "SELECT * FROM users WHERE email = ?;";

    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "Failed";
    }

    mysqli_stmt_bind_param($stmt,"s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){
        return $row;
    }
    else{
        return false;
    }
}
function random_num( $length ){

    $characters = "";
    if( $length < 5 ){
        $length = 5;
    }
    $len = rand(4, $length);
    for( $i = 0; $i < $len; $i++ ){ 

        $characters .= rand(0,9);
    }
    return  $characters;
}

function returnURI($con, $userId){
    

    // Query per recuperare l'immagine dalla tabella
    $sql = "SELECT image FROM users WHERE user_id = ? limit 1";
    $stmt = $con->prepare($sql);

    // Binding dei parametri
    $stmt->bind_param("s", $userId);

    // Esecuzione della query
    $stmt->execute();

    // Ottieni il risultato della query
    $result = $stmt->get_result();

    // Verifica se l'immagine è stata trovata
    if ($result->num_rows > 0) {
        // Recupera l'immagine dalla riga del risultato
        $row = $result->fetch_assoc();
        $imageData = $row['image'];

        return $imageData;
    } else {
        echo "Nessuna immagine trovata per questo utente.";
    }

}



function returnLastMessage($con, $user1, $user2) {

    $sql = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?)
            OR (sender_id = ? AND receiver_id = ?) ORDER BY date DESC LIMIT 1";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $user1, $user2, $user2, $user1);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return null;
    }
}

function getUserDetails($con, $user_id) {
    $query_user = "SELECT * FROM users WHERE user_id = ?";
    $stmt_user = mysqli_prepare($con, $query_user);
    mysqli_stmt_bind_param($stmt_user, "s", $user_id);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);
    return mysqli_fetch_assoc($result_user);
}

function returnQuantoTempo($date){

    $dist = time() - strtotime($date);

    if($dist < 30){
        return "ora";
    }
    if( $dist  < 60){
        return "1 minuto fa"; 
    }
    if( $dist  < 60*60){
        $min = floor($dist /60);
        return "$min minuti fa"; 
    }
    if( $dist < 60*60*2){
        return "1 ora fa";
    }
    if( $dist < 60*60*24){
        $ore = floor($dist / (60*60));
        return "$ore ore fa";
    }
    if( $dist < 60*60*24*2){
        return "1 giorno fa";
    }
    if( $dist < 60*60*24*30){
        $days = floor($dist / (60*60*24));
        return "$days giorni fa";
    }

    



}