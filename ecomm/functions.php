
<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

function checkLogin($con){
    
    if(isset($_COOKIE['user_token'])){
        
        $id = $_COOKIE['user_token'];
        $query = "select * from users where token = '$id' limit 1";
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)> 0){
            $user_data  = mysqli_fetch_assoc($result);
            return $user_data['email'];
        }

    }
    
    if(isset($_SESSION['user_id'])){
        

        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)> 0){
            $user_data  = mysqli_fetch_assoc($result);
            return $user_data['email'];
        }
    }
    
    else{
        return null;
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

function createToken(){
    $token = [];
    for($i=0; $i<10; $i++){
        $token[$i] = rand(0,9);
    }
    return (int)implode("",$token);
}
