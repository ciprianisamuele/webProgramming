

function addChat(param1, param2) {
    $.ajax({
        url: "http://localhost/studweb/add-chat-conversation.php",
        type: "POST",
        data: {
            user1: param1,
            user2: param2
        },
        success: function(response){
            // Gestire la risposta dal tuo script PHP
            console.log(response);
        },
        error: function(xhr, status, error){
            // Gestire eventuali errori di comunicazione
            console.error(error);
        }
    });
}
