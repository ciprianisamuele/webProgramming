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

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  </head>
  <body>

    <nav class="nav">

        <span class= "logo"><a href="/studweb/indstud.php">LOGO</a></span>

        
        <ol id = "main-nav">

            <button class = "profile">
                
                <img src = <?php if(isset($_SESSION['user_id'])){echo  $_SESSION['image'];}
                     else{ echo "http://localhost/studweb/inc/imginc/default-avatar.png";} ?> class ="profile-image"> 
                <i class="fa-solid fa-caret-down"></i>
            </button>
            
     

        </ol>

        <ol class = "main-nav cell">
            <li class="list"><a href="indstud.php"><i  class="fa-solid fa-magnifying-glass"></i></a></li>
            <li class="list"><a href="chat.php"><i class="fa-solid fa-envelope"></i></a></li>
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
<main>
    <form id="form" enctype="multipart/form-data">
        <input type="hidden" id="user_id_input" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

        <label for="nome_input">Nome:</label>
        <input type="text" id="nome_input" name="nome" required><br><br>

        <label for="email_input">Email:</label>
        <input type="email" id="email_input" name="email" value = '<?php echo $_SESSION['email'] ?> ' required><br><br>

        <label for="telefono_input">Telefono:</label>
        <input type="tel" id="telefono_input" name="telefono"><br><br>

        <label for="indirizzo_input">Indirizzo:</label>
        <input type="text" id="indirizzo_input" name="indirizzo" required><br><br>

        <label for="prezzo_input">Prezzo:</label>
        <input type="number" id="prezzo_input" name="prezzo" required><br><br>

        <label for="descrizione_input">Descrizione:</label><br>
        <textarea id="descrizione_input" name="descrizione" rows="4" cols="50"></textarea><br><br>

        <div id="foto_fields">
            <label for="foto1_input">Foto 1:</label>
            <input type="file" class="foto_input" name="foto[]" accept="image/*"><br><br>
        </div>

        <button type="button" id="aggiungi_foto">Aggiungi Altra Foto</button><br><br>

        <input type="submit" value="Invia">
    </form>
</main>


<script type="module">
    import { getPosition} from './js/functions.js';
        $(document).ready(function(){
            var fotoCount = 1;

            $('#aggiungi_foto').click(function(){
                fotoCount++;
                var html = '<label for="foto' + fotoCount + '_input">Foto ' + fotoCount + ':</label>' +
                           '<input type="file" class="foto_input" name="foto[]" accept="image/*"><br><br>';
                $('#foto_fields').append(html);
            });

            $('#form').submit(function(event){
                event.preventDefault();
                var formData = new FormData(this);
                console.log(formData.get('indirizzo'));
                getPosition(formData.get('indirizzo'), function(lat, lon){
                    formData.append('lat', lat); // Aggiungi latitudine ai dati del modulo
                    formData.append('lng', lon); // Aggiungi longitudine ai dati del modulo


                    // Effettua la richiesta AJAX solo dopo aver ottenuto la posizione
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/studweb/inc/pubblica.inc.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            console.log(response);
                            // Esegui altre azioni se necessario
                        },
                        error: function(xhr, status, error){
                            console.error(xhr, status, error);
                        }
                    });
                });
            });
        });
</script>


<?php
include("footer.php");



?>
