<?php 

if(isset($_POST['submit-first'])){
   
    

    $email = $_POST['email-first'];

    $row = emailExists($con, $email);
    if($row){
        $_SESSION["row"] = $row;
    }

    if($row){
        echo "<script>stad = 2 ;</script>";

    }
    else{

        echo "<script>stad = 1 ;</script>";
        echo "<script>let email = '$email';</script>";
    }
    

}