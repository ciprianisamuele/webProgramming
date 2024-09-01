<?php

$dbhost = "localhost";
$dbuser = "samuele";
$dbpass = "REMOVED_LOCAL_DB_PASSWORD";
$dbname = "studweb";



if(! $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){

    die("failed to connect");
}
