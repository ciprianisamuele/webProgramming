<?php 

$output="";
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM users WHERE user_id <> ?";


$stmt = mysqli_stmt_init($con);

if(!mysqli_stmt_prepare($stmt, $query)){
    echo "Failed";
}

mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Ciclo su ogni utente trovato
while ($row = mysqli_fetch_assoc($result)) {

    $row_user_id = $row['user_id'];
    $image = $row['image'];
    $name = $row['name'];
    $surname = $row['surname'];


    $output.= "<div class='contact' onclick='addChat(\"$user_id\", \"$row_user_id\")'>
                    <img src='$image' class='profile-image'>
                    <div class='name'>$name $surname</div>
                </div>";


}
mysqli_stmt_close($stmt);

echo $output;

// Chiudere la connessione
mysqli_close($con);
