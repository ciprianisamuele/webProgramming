


var isFirstTime = true;

function showChat(param1, param2) {
    $.ajax({
        url: "http://localhost/studweb/inc/show-chat.inc.php",
        type: "POST",
        data: {
            user1: param1,
            user2: param2
        },
        success: function(response){
            // Gestire la risposta dal tuo script PHP
            
    
            $(".chat-box").html(response);

         
            if(isFirstTime){
                var container = $('.chat-box')[0];

                // Imposta lo scroll al massimo valore possibile
                container.scrollTop = container.scrollHeight - container.clientHeight;
                isFirstTime = false;
            }

            
        },
        error: function(xhr, status, error){
            // Gestire eventuali errori di comunicazione
            console.error(error);
        }
    });
}
var intervalId;
var intervalActive;
var contactId;
var userId;
var selected;

document.addEventListener('click', function(event) {
    // Verifica se l'elemento cliccato o uno dei suoi genitori corrisponde a un elemento con la classe 'contact'
    var contact = event.target.closest('.contact');
    if (contact) {


        userId = contact.getAttribute('data-user-id');
        contactId = contact.getAttribute('data-contact-id');
        if ($(window).width() <= 760) {
            $('.chat-area').addClass('show-from-right');

        }
        else{
            
            showListContact()
            selected = contact.getAttribute('id');
        }



        if (intervalId) {
            clearInterval(intervalId);
        }

        if (intervalActive) {
            clearInterval(intervalActive);
        }
        // Avvia l'intervallo quando viene cliccato un elemento con la classe 'contact'
        //isFirstTime = true;


        showName(contactId);
        showChat(userId, contactId);
        isUserActive(contactId);
        showTastiera(userId, contactId);


        intervalId = setInterval(function() {
            showChat(userId, contactId);
            console.log("Intervallo chat");
        }, 5000); // Esegui la funzione showChat ogni mezzo secondo

        intervalActive = setInterval(function(){
            isUserActive(contactId);
            console.log("is active?")
        },30000);
    }
});

function showListContact(){

    $.ajax({
        url: "http://localhost/studweb/inc/chat-list-contact.inc.php",
        type: "POST",
        data: {
            start: 1,
        },
        success: function(response){
            // Gestire la risposta dal tuo script PHP
            
            $(".list-contact").html(response);
            console.log("Mostro lista dei contatti");
            if(selected){
                console.log(selected)


                selected_contact = document.getElementById(selected);

                selected_contact.style.backgroundColor = 'rgb(240,240,240)';
            }

        },
        error: function(xhr, status, error){
            // Gestire eventuali errori di comunicazione
            console.error(error);
        }
    });


}


function showTastiera(param1, param2){

    $.ajax({
        url: "http://localhost/studweb/inc/show-tast.inc.php",
        type: "POST",
        data: {
            user1: param1,
            user2: param2
        },
        success: function(response){
            // Gestire la risposta dal tuo script PHP
            
            $(".form").html(response);
        },
        error: function(xhr, status, error){
            // Gestire eventuali errori di comunicazione
            console.error(error);
        }
    });


}


function isUserActive(userid){

    $.ajax({
        url: "http://localhost/studweb/mostra-attività.php",
        type: "POST",
        data: {
            user_id: userid
        },
        success: function(response){
            // Gestire la risposta dal tuo script PHP
            
            $(".chat-area .details .active").html(response);
            
        },
        error: function(xhr, status, error){
            // Gestire eventuali errori di comunicazione
            console.error(error);
        }
    });
}



$(document).ready(function(){

    $('.go-back').click(function() {
        $('.chat-area').removeClass('show-from-right');
    });

    $('.chat-area').on('submit', '#typing-area-id', function(e){
        e.preventDefault(); // Previeni il comportamento predefinito del modulo

        var formData = $(this).serialize(); // Serializza i dati del modulo

       
        var outgoing_id = $('input[name="outgoing_id"]').val();
        var incoming_id = $('input[name="incoming_id"]').val();

        $('#typing-area-id input[name="tastiera"]').val('');

        $.ajax({
            type: 'POST',
            url: 'http://localhost/studweb/add-message.php', // URL del tuo script PHP
            data: formData,
            success: function(response){
                // Gestisci la risposta del server qui
                
                showListContact()
                console.log("ccc"); 
                if (intervalId) {
                    clearInterval(intervalId);
                }

                isFirstTime = true;
                showChat(outgoing_id, incoming_id );
                intervalId = setInterval(function() {
                    showChat(outgoing_id, incoming_id );
                }, 5000); 
                
            },
            error: function(xhr, status, error){
                // Gestisci gli errori qui
                console.error(xhr.responseText);
            }
        });

        return false;
    });


    showListContact();
    setInterval(function() {

        showListContact();

    }, 30000); // (30 secondi)
});



function showName(userid){
    $.ajax({
        url: "http://localhost/studweb/mostra-nome.php",
        type: "POST",
        data: {
            user_id: userid
        },
        success: function(response){
            // Gestire la risposta dal tuo script PHP
            
            $(".chat-area .details .nome").html(response);
        },
        error: function(xhr, status, error){
            // Gestire eventuali errori di comunicazione
            console.error(error);
        }
    });

}


