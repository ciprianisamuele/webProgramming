<?php 

if(isset($_POST['submit-reg'])){

    $name = ucfirst(strtolower($_POST['nome']));
    $surname = ucfirst(strtolower($_POST['cognome']));
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $unique_id = uniqid();
    $img_uri = "http://localhost/studweb/inc/imginc/default-avatar.png";

    createUser( $con,$unique_id, $name, $surname, $birthday, $email , $password, $img_uri );

    echo $img_uri;

    $_SESSION['user_id'] = $unique_id;
    $_SESSION['name'] = $name;
    $_SESSION['surname'] = $surname;
    $_SESSION['birthday'] = $birthday;
    $_SESSION['email'] =  $email;
    $_SESSION['image']= $img_uri;

    header('Location: indstud.php');
}