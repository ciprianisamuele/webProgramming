
import { getPosition } from './functions.js';


$("#search-icon").click(function(event) {
    event.preventDefault();
    
    var inputText = $('.query-in').val();

    getPosition(inputText, function(lat, lon){

        window.location.href = 'http://localhost/studweb/esplora.php?lat=' + encodeURIComponent(lat) + '&lng=' + encodeURIComponent(lon) + '&loc=' + encodeURIComponent(inputText)+ '&search=text';
    })
    
  
 
});

// Ascolta l'evento di pressione del tasto Invio sulla casella di ricerca
$(".query-in").keypress(function(event) {
    // Verifica se il tasto premuto è Invio
    if (event.which === 13) {
        event.preventDefault();
        
        var inputText = $('.query-in').val();

        getPosition(inputText, function(lat, lon){
            window.location.href = 'http://localhost/studweb/esplora.php?lat=' + encodeURIComponent(lat) + '&lng=' + encodeURIComponent(lon) + '&loc=' + encodeURIComponent(inputText)+ '&search=text';
        })

    }
});



$(document).ready(function() {
    initAutocomplete();
});

function initAutocomplete() {
    var input = $('.query-in')[0]; // Selettore jQuery per ottenere l'elemento input
  
    var options = {
      types: ['geocode'] // Limita la ricerca agli indirizzi (città e strade)
    };
  
    var autocomplete = new google.maps.places.Autocomplete(input, options);

}