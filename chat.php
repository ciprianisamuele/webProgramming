<?php
include("header.php");



error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

?>

<main class = "wrapper-chat">
    <section class = "bar-contact">
        <div class="bar-head">
            <span class="title">
                Messaggi
            </span>
            <span><i class="fa-solid fa-ellipsis"></i></span>
        </div>
        <div class = "list-contact">
          


       

    



        </div>


    </section>
    <section class="chat-area">
        <div class="chat-head">

            <div class="details">
                <div class="go-back">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <div class="down">
                    <span class= "nome"></span>
                    <span class = "active"></span>
                </div>
            </div>
            <div class="more-info">

            </div>


        </div>

        <div class="chat">

            <div class="chat-box">
            </div>
         
            


            <div class="scroll-down"><i class="fa-solid fa-angle-down"></i></div>

        </div>
        <div class= "form">

        </div>

   


    </section>

</main>

<script src = "js/ajax-show-chatbox.js"> </script>

<?php
include("footer.php");



?>