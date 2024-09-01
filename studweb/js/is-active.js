


function inviaRichiestaAttivita() {
    $.ajax({
        url: 'http://localhost/studweb/controlla-attività.php', // Pagina PHP per controllare l'attività degli utenti
        type: 'POST',
        success: function(response) {
            // Gestisci la risposta dal server
            console.log('Richiesta di attività inviata con successo.');
        },
        error: function(xhr, status, error) {
            // Gestisci eventuali errori
            console.error('Errore nell\'invio della richiesta di attività:', error);
        }
    });
}

// Invia una richiesta di attività ogni 60 secondi
inviaRichiestaAttivita();
setInterval(inviaRichiestaAttivita, 60000);