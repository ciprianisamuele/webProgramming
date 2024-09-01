<?php 

    session_start();
    include_once("dbh.inc.php");

    $sql = mysqli_querry($conn, "SELECT * FROM users");
    $output="";

    if(mysqli_num_rows($sql)> 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output.= "<div class='contact'>
            <img src = 'php/images/' class ='profile-image'>
            <div class='name'>NOME 1</div>
        </div>";
        }
    }