<?php

$dbhost = "localhost";
$dbuser = "samuele";
$dbpass = "!*-.Samu";
$dbname = "studweb";



if(! $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){

    die("failed to connect");
}
