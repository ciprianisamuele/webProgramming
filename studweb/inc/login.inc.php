<?php 

if(isset($_POST['submit-log'])){
    
    echo "<script>stad = 2 ;</script>";

    $row = $_SESSION["row"];

    echo $row['nome'];

    $password = $_POST['password-log'];

    if(isRightPassword($password, $row)){
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['nome'];
        $_SESSION['surname'] = $row['cognome'];
        $_SESSION['birthday'] = $row['birthday'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['image'] = $row['image'];

        header('Location: indstud.php');

    }
    else{
        echo 'Password sbagliata';
        
    }

}