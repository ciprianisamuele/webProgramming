<?php


error_reporting( E_ALL );
ini_set( 'display_errors', 1 );



$dbhost = "localhost";
$dbuser = "samuele";
$dbpass = "!*-.Samu";
$dbname = "e-commerce";



if(! $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){

    die("failed to connect");
}

