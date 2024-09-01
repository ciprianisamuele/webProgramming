

$('#image').change(function() {
    var formData = new FormData($('#form-prova')[0]);
        

    $.ajax({
        url: 'http://localhost/studweb/inc/upload.photo.inc.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
         success: function(response) {
             console.log('File inviato con successo:', response);
             window.location.reload();
            // Esegui altre azioni dopo l'invio del file...
        },
        error: function(xhr, status, error) {
            alert('Errore durante l\'invio del file:', error);
        }
    });
});

