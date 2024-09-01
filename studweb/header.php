<?php 
session_start();



error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

echo "<script>let stad = 0 ;</script>";

include("inc/functions.inc.php");
include("inc/dbh.inc.php");

include_once("first-log.php");
include_once("register.php");
include_once("login.php");

include("inc/first-log.inc.php");
include("inc/register.inc.php");
include("inc/login.inc.php");







?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" type="text/css" href="/studweb/css/indstud.css"> 
    <script src="https://kit.fontawesome.com/ba452e23c5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  </head>
  <body>

    <nav class="nav">

        <span class= "logo"><a href="/studweb/indstud.php">LOGO</a></span>

        <div class = "query">
            <input type="search" class="query-in" placeholder="Search here" />
            <span id="search-icon" class="fa-solid fa-magnifying-glass"></span>
        </div>
        
        <ol id = "main-nav">
            <span class="pubblica" onclick="redirect()"> Pubblica</span>
            <li class="list"><a href="chat.php"><i class="fa-regular fa-envelope"></i></a></li>
            <li class="list"><a href="#"><i class="fa-regular fa-bell"></i></a></li>
            <li class="list"><a href="#"><i class="fa-regular fa-heart"></i></a></li>
            <button class = "profile">
                
                <img src = <?php if(isset($_SESSION['user_id'])){echo  $_SESSION['image'];}
                     else{ echo "http://localhost/studweb/inc/imginc/default-avatar.png";} ?> class ="profile-image"> 
                <i class="fa-solid fa-caret-down"></i>
            </button>
            
     

        </ol>

        <ol class = "main-nav cell">
            <li class="list"><a href="indstud.php"><i  class="fa-solid fa-magnifying-glass"></i></a></li>
            <li class="list"><a href="chat.php"><i class="fa-regular fa-envelope"></i></a></li>
            <li class="list"><a href="#"><i class="fa-regular fa-heart"></i></a></li>
            <li class="list"><a href="#"><i class="fa-regular fa-heart"></i></a></li>
            <li class="list"><a href="#"><i class="fa-regular fa-user"></i></a></li>
            


        </ol>
    </nav>

    <div class="prova-ora"></div>
    <section class = "sub-account hide">

        <?php if(isset($_SESSION["user_id"])){
            echo 
            "<ol class = 'first-menu'> 
                <li><a href='impostazioni/account.php'><i class='fa-regular fa-user'></i> <span>Account</span></a></li>
                <li><a href='chat.php'><i class='fa-regular fa-message'></i> <span>Messaggi</span></a></li>
                <li><a href='#'><i class='fa-regular fa-clock'></i> <span>Recenti</span></a></li>
                <li><a href='#'><i class='fa-regular fa-heart'> </i><span>Preferiti</span></a></li>
                <li><a href='#'><i class='fa-solid fa-key'></i>Impostazioni</a></li> 
            </ol>
            
            <ol class = 'second-menu'>
                <li><a href='inc/log-out.inc.php' >Esci</a></li>
            </ol>";
        }

        else{
            echo
            "<ol class = 'first-menu'> 
            <li><a  class = 'accedi-registrati' ><span>Accedi o registrati</span></a></li>

            </ol>
            
            <ol class = 'second-menu'>
                <li><a href='#'><i class='fa-regular fa-user'></i> <span>Account</span></a></li>
                <li><a href='#'><i class='fa-regular fa-message'></i> <span>Messaggi</span></a></li>
                <li><a href='#'><i class='fa-regular fa-clock'></i> <span>Recenti</span></a></li>
                <li><a href='#'><i class='fa-regular fa-heart'> </i><span>Preferiti</span></a></li>
                <li><a href='#'><i class='fa-solid fa-key'></i>Impostazioni</a></li> 
            </ol>";

        }
        ?>
    </section>
