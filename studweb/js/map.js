
import { getPosition, updateURLParameters, readURLParameters, checkLocationType} from './functions.js';
var map;
var isNotFirstTime = 0;
var markerArrayF = [];
var boolIdle;
var jsonData;

function initMap(lat, lng) {
    // Crea un oggetto della mappa con il centro e lo zoom desiderati

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: lat, lng: lng},
        zoom: 13,
        minZoom: 3,
        streetViewControl: false,
        fullscreenControl: false,
        mapTypeControl: false,
        mapId: '3ef2db4f030b4544'
    });

    var lastValidCenter = map.getCenter();
    var southLimit = -73;
    var northLimit = 73;
    
    google.maps.event.addListener(map, 'center_changed', function() {
        var center = map.getCenter();
        if (center.lat() < southLimit || center.lat() > northLimit) {
        map.panTo(new google.maps.LatLng(
            Math.min(Math.max(center.lat(), southLimit), northLimit),
            center.lng()
        ));
        } else {
        lastValidCenter = map.getCenter();
        }
    });
    
    google.maps.event.addListener(map, 'idle', function() {
        // Ottieni i limiti della mappa visibile
  

        if(isNotFirstTime){
            var bounds = map.getBounds();
            var ne = bounds.getNorthEast(); // Punto nord-est della mappa visibile
            var sw = bounds.getSouthWest(); // Punto sud-ovest della mappa visibile

            var center = map.getCenter();
            var lat = center.lat();
            var lng = center.lng();

            // Aggiorna i parametri dell'URL con le nuove coordinate
            effettuaRicercaMappa(ne.lat(), ne.lng(), sw.lat(), sw.lng(), lat, lng);
        }
        else{
            isNotFirstTime = 1;
        }
    });


        // Aggiungi altre coordinate se necessario

    // Aggiungi i marker sulla mappa
 
}

function effettuaRicercaMappa(start_lat, start_lng, max_lat, max_lng,lat,lng){
    
    $.ajax({
        url: 'http://localhost/studweb/inc/esplora.inc.php', // Il nome del tuo script PHP
        method: 'GET',
        data:{
            start_lat: start_lat,
            start_lng: start_lng,
            fin_lat: max_lat,
            fin_lng: max_lng,
            lat: lat,
            lng: lng
        },
        success: function(data) {
            // Aggiorna la lista dei venditori con i risultati ottenuti dal server
            var dataArray = data.split("<!--JSON_SEPARATOR-->");
            var htmlData = dataArray[0]; // Ottieni l'HTML
            jsonData = JSON.parse(dataArray[1]); // Ottieni i dati JSON

            if (jsonData.length == 0) {
                if (!$('.venditori').hasClass('show-space')) {
                    $('.venditori').addClass('show-space');
                }
                if(!$('.pagination').hasClass('hide')){
                    $('.pagination').addClass('hide');
                }
            }
            else if (jsonData.length <= 3) {

                if(!$('.venditori').hasClass('show-space')){
                    $('.venditori').addClass('show-space');
                }
                if($('.pagination').hasClass('hide')){
                    $('.pagination').removeClass('hide');
                }
               
            }
            else{ 
                if ($('.venditori').hasClass('show-space')) {
                    $('.venditori').removeClass('show-space');
                }
                if($('.pagination').hasClass('hide')){
                    $('.pagination').removeClass('hide');
                }
            }
    
            // Aggiorna la lista dei venditori con l'HTML ricevuto
            $('.sub-list-venditori').html(htmlData);

            
            currentPage = 0;
            updatePagination();
    
            // Utilizza i dati JSON come desideri
      
       

            var newURL = 'http://localhost/studweb/esplora.php?lat=' + lat + '&lng=' + lng + '&start_lat=' + start_lat + '&start_lng=' + start_lng + '&fin_lat=' + max_lat + '&fin_lng=' + max_lng + '&search=map';

        // Modifica l'URL nel browser senza ricaricare la pagina

            // Aggiorna l'URL della pagina
            window.history.pushState({ path: newURL }, '', newURL);


        },
        error: function(xhr, status, error) {
            // Gestisci eventuali errori qui
        }
    });

}
function effettuaRicercaPan(lat,lng, inputText){
    var getRequestURL = 'http://localhost/studweb/inc/esplora.inc.php';
    var finLoc = checkLocationType(inputText);
    $.ajax({
        url: getRequestURL, // Il nome del tuo script PHP
        method: 'GET',
        data:{
            lat:lat,
            lng:lng,
            city: finLoc

        },
        success: function(data) {
            // Aggiorna la lista dei venditori con i risultati ottenuti dal server
            var dataArray = data.split("<!--JSON_SEPARATOR-->");
            var htmlData = dataArray[0]; // Ottieni l'HTML
            jsonData = JSON.parse(dataArray[1]); // Ottieni i dati JSON

            if(jsonData.length == 0){
                $('.venditori').toggleClass('show-space');
            }

    
            
            if (jsonData.length == 0 && !$('.venditori').hasClass('show-space')) {
                $('.venditori').addClass('show-space');

                if(!$('.pagination').hasClass('hide')){
                    $('.pagination').addClass('hide');
                }

            }
            else if (jsonData.length <= 3) {

                if(!$('.venditori').hasClass('show-space')){
                    $('.venditori').addClass('show-space');
                }
                if($('.pagination').hasClass('hide')){
                    $('.pagination').removeClass('hide');
                }
               
            }
            else{ 
                if ($('.venditori').hasClass('show-space')) {
                    $('.venditori').removeClass('show-space');
                }
                if($('.pagination').hasClass('hide')){
                    $('.pagination').removeClass('hide');
                }
            }

            $('.sub-list-venditori').html(htmlData);

            currentPage = 0;
            updatePagination();
    
            // Utilizza i dati JSON come desideri


            var newPosition = new google.maps.LatLng(lat, lng);
            isNotFirstTime = 0;

            
            map.panTo(newPosition);
            map.setZoom(13)
            


        },
        error: function(xhr, status, error) {
            // Gestisci eventuali errori qui
        }
    });
}

function effettuaRicerca(params) {
    // Effettua una richiesta AJAX di tipo GET per ottenere i risultati della ricerca
    var getRequestURL = 'http://localhost/studweb/inc/esplora.inc.php?' + params;

    if(params.includes('&search=text')){
        var loc=params.split('&loc=')[1]
        var finLoc = checkLocationType(decodeURIComponent(loc.split('&')[0]));
    }

    $.ajax({
        url: getRequestURL, // Il nome del tuo script PHP
        method: 'GET',
        data: {city:finLoc},
    
        success: function(data) {
            // Aggiorna la lista dei venditori con i risultati ottenuti dal server
            var dataArray = data.split("<!--JSON_SEPARATOR-->");
            var htmlData = dataArray[0]; // Ottieni l'HTML
            jsonData = JSON.parse(dataArray[1]); // Ottieni i dati JSON

            

            if(jsonData.length == 0 && !$('.pagination').hasClass('hide')){
                $('.pagination').addClass('hide');
            }
            if (jsonData.length == 0 && !$('.venditori').hasClass('show-space')) {
                $('.venditori').addClass('show-space');

            }
            else if (jsonData.length <= 3) {

                if(!$('.venditori').hasClass('show-space')){
                    $('.venditori').addClass('show-space');
                }
                if($('.pagination').hasClass('hide')){
                    $('.pagination').removeClass('hide');
                }
               
            }
            else{ 
                if ($('.venditori').hasClass('show-space')) {
                    $('.venditori').removeClass('show-space');
                }
                if($('.pagination').hasClass('hide')){
                    $('.pagination').removeClass('hide');
                }
            }
    
            // Aggiorna la lista dei venditori con l'HTML ricevuto
            $('.sub-list-venditori').html(htmlData);
            $('.load-list').toggleClass('hide-at-start');
            

            // Inizializza la mappa con il posto
            var lat = readURLParameters('lat');
            var lng = readURLParameters('lng');

            initMap(parseFloat(lat), parseFloat(lng));

            currentPage = 0;
            updatePagination();




        },
        error: function(xhr, status, error) {
            // Gestisci eventuali errori qui
        }
    });
}


$(document).ready(function() {


    var urlParams = new URLSearchParams(window.location.search);
    var searchLat = urlParams.get('lat');

    var currentURL = window.location.href;

    var params = currentURL.split('?')[1]; // Ottieni la parte dopo il '?'


    if (searchLat) {

        effettuaRicerca(params);
    } 

    
    $("#search-icon").click(function(event) {
        event.preventDefault();
        
        var inputText = $('.query-in').val();
    
        getPosition(inputText, function(lat, lon){
    
            var newURL = 'http://localhost/studweb/esplora.php?lat=' + lat + '&lng=' + lon + '&loc=' + encodeURIComponent(inputText) +'&search=text';
            // Aggiorna l'URL della pagina
            window.history.pushState({ path: newURL }, '', newURL);
  
            effettuaRicercaPan(lat,lon, inputText);
        })
        
      
     
    });
    
    // Ascolta l'evento di pressione del tasto Invio sulla casella di ricerca
    $(".query-in").keypress(function(event) {
        // Verifica se il tasto premuto è Invio
        if (event.which === 13) {
            event.preventDefault();
            
            var inputText = $('.query-in').val();
    
            getPosition(inputText, function(lat, lon){
                var newURL = 'http://localhost/studweb/esplora.php?lat=' + lat + '&lng=' + lon + '&loc=' + encodeURIComponent(inputText) +'&search=text';
                // Aggiorna l'URL della pagina
                window.history.pushState({ path: newURL }, '', newURL);
      
                effettuaRicercaPan(lat,lon, inputText);
            })
    
        }
    });

})



// Array per memorizzare i marker





$(document).ready(function() {
    initAutocomplete();
});

function initAutocomplete() {
    var input = $('.query-in')[0]; // Selettore jQuery per ottenere l'elemento input
    var autocomplete = new google.maps.places.Autocomplete(input);

}



var currentPage = 0;
var cardsPerPage = 15;
var maxVisibleButtons = 5; // Massimo numero di pulsanti visibili


// Aggiungi gestori per i pulsanti di navigazione
$(document).on('click', '.pagination-btn', function() {
    currentPage = parseInt($(this).text()) - 1;
    updatePagination();

});

$(document).on('click', '.prev-page', function() {
    if (currentPage > 0) {
        currentPage--;
        updatePagination();
    }
});

$(document).on('click', '.next-page', function() {
    var totalPages = Math.ceil($('.venditore').length / cardsPerPage);
    if (currentPage < totalPages - 1) {
        currentPage++;
        updatePagination();
    }
});
function showPage(page) {

    markerArrayF = creaMarkers(jsonData, page, cardsPerPage);

    var startIndex = page * cardsPerPage;
    var endIndex = startIndex + cardsPerPage;
    $('.venditore').removeClass('show').slice(startIndex, endIndex).addClass('show');
}

// Aggiorna la visualizzazione delle card e i pulsanti di paginazione
function updatePagination() {
    showPage(currentPage);
    
    $('.pagination-btn').remove(); // Rimuovi i pulsanti numerati esistenti

    var totalPages = Math.ceil($('.venditore').length / cardsPerPage);
    var startPage = 0;
    var endPage = totalPages;

    if (totalPages > maxVisibleButtons) {
        var middlePage = Math.floor(maxVisibleButtons / 2);
        startPage = currentPage - middlePage;
        endPage = currentPage + middlePage + 1;

        if (startPage < 0) {
            endPage += Math.abs(startPage);
            startPage = 0;
        }

        if (endPage > totalPages) {
            startPage -= (endPage - totalPages);
            endPage = totalPages;
        }
    }

    // Aggiungi pulsanti numerati dalla pagina 1 alla pagina 5 (o al massimo)
    for (var i = startPage; i < Math.min(endPage, startPage + maxVisibleButtons); i++) {
        if (i === startPage) {
            $('.next-page').before('<button class="pagination-btn">' + (1) + '</button>');
        } else if (i === endPage - 1) {
            $('.next-page').before('<button class="pagination-btn">' + (totalPages) + '</button>');
        } else if (i == currentPage){
            $('.next-page').before('<button class="pagination-btn active">' + (i + 1) + '</button>');
        }else {
            $('.next-page').before('<button class="pagination-btn">' + (i + 1) + '</button>');
        }
 
    }

    $('.pagination-btn').eq(currentPage - startPage).addClass('active');
}

var markerArray = [];

function creaMarkers(json, currentPage, cardsPerPage) {
    // Array per memorizzare i marker
    

    // Calcola l'indice di inizio e fine per la pagina corrente
    var startIndex = currentPage * cardsPerPage;
    var endIndex = (currentPage + 1) * cardsPerPage;
    
    // Estrai la porzione dell'array di coordinate per la pagina corrente


    var coordinatePerPage = json.slice(startIndex, endIndex);

 
    markerArray.forEach(function(marker) {
        marker.setMap(null);
    });


    // Pulisci l'array dei marker
    markerArray = [];

    // Itera su ciascuna coppia di coordinate e crea direttamente i marker
    coordinatePerPage.forEach(function(coord) {
        // Crea e aggiungi direttamente il marker all'array dei marker
        var marker = new google.maps.Marker({
            position: { lat: parseFloat(coord.lat), lng: parseFloat(coord.lng) },
            map: map,
            title: 'Marker Titolo',
            label: { 
                text: '600 $', // Testo da visualizzare sull'etichetta
                className: 'marker-label'
            },
            icon: { 
                url: 'http://localhost/studweb/inc/imginc/default-avatar.png', 
                size: new google.maps.Size(30, 30), // Dimensioni dell'icona trasparente
                origin: new google.maps.Point(10, 10), // Punto di origine dell'icona
                anchor: new google.maps.Point(10, 10) // Punto di ancoraggio per centrare il label
            }
        });

        
        // Aggiungi il marker all'array dei marker
        markerArray.push(marker);

        marker.addListener('mouseover', function() {
            // Modifica lo stile del marker durante l'hover
            console.log("DENTRO");
            marker.setLabel({ text: '600 $',className: 'marker-label-hover' });
        });

        marker.addListener('mouseout', function() {
            // Ripristina lo stile del marker dopo l'hover
            console.log("FUORI");
            marker.setLabel({ text: '600 $', className: 'marker-label' });
        });
    });

    // Ritorna l'array dei marker creati
    return markerArray;
}


