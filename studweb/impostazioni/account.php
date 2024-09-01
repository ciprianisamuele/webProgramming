<?php
include("../header.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Stampa i valori delle variabili di sessione per debug

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

?>
<main>
    <div class= "impostazioni">

        <div class="left">
            <div class="title">Impostazioni</div>
            <ol class = 'menu'> 
                <li><a href='#'><i class='fa-regular fa-user'></i> <span>Dettagli account</span></a></li>
                <li><a href='chat.php'><i class='fa-regular fa-message'></i> <span>Sicurezza</span></a></li>
                <li><a href='#'><i class='fa-regular fa-clock'></i> <span>Notifiche</span></a></li>
                <li><a href='#'><i class='fa-regular fa-heart'> </i><span>Privacy</span></a></li>
                <li><a href='#'><i class='fa-solid fa-key'></i>Impostazioni</a></li> 
                <li><a href='#'><i class='fa-regular fa-user'></i> <span>Dettagli account</span></a></li>
                <li><a href='chat.php'><i class='fa-regular fa-message'></i> <span>Sicurezza</span></a></li>
                <li><a href='#'><i class='fa-regular fa-clock'></i> <span>Notifiche</span></a></li>
                <li><a href='#'><i class='fa-regular fa-heart'> </i><span>Privacy</span></a></li>
                <li><a href='#'><i class='fa-solid fa-key'></i>Impostazioni</a></li> 
            </ol>
            <div class="left-scroll-overlay"></div>
        </div>
        <div class="right">

            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" id="form-prova">

                <div class="error-text"></div>
                <div class="image">
                    <img src= <?php echo returnURI($con, $_SESSION['user_id']) ?>>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                    <label class="input-nascosto"for ="image"><i class="fa-solid fa-camera"></i> Modifica</label>

                </div>
            </form>

            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" id="form">
                <div class="bottom">
                    <span>Informazioni personali</span>
                    <span class = "names">
                        <span class="nom"><label for = "nome-cambia">Nome</label><input id="nome-cambia" name="nome" type="text" placeholder = "nome" value = ' <?php echo $_SESSION['name'] ?>' required /></span>
                        <span class="cogn"><label for = "cognome-cambia">Cognome</label><input id="cognome-cambia" name="cognome" type="text" placeholder = "cognome" value =  '<?php echo $_SESSION['surname'] ?> ' required /></span>
                    </span>
                    <label for = "birthday-cambia" class = "label-max">Data di nascita</label><input type="date" id="birthday-cambia" name="birthday" value='<?php echo date("Y-m-d", strtotime($_SESSION['birthday'])); ?>' required>
                    <label for = "email-cambia" class = "label-max">Email</label><input id="email-cambia" name="email" type="email" placeholder = "Email" value = '<?php echo $_SESSION['email'] ?> ' required />

                    <button type= "button" >Cambia password</button>
                    



                    <input class = "submit" type="submit" value ="Conferma modifiche">

                </div>
            </form>

        </div>

    
</div>
    <div class="pro">
    <div class="image">
                <img src = "http://localhost/favicon.ico">
                <button><i class="fa-solid fa-camera"></i> Modifica</button>
            </div>

            <div class="image">
                <img src = "http://localhost/favicon.ico">
                <button><i class="fa-solid fa-camera"></i> Modifica</button>
            </div>


    </div>
<main>

<script src = "/studweb/js/scroll.js"> </script>
<script src = "/studweb/js/change.account.js"> </script>

<?php
include("../footer.php");



?>