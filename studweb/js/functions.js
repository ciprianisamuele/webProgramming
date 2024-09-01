

export function getPosition(city, callback){

    const apiKey = 'AIzaSyAff1paPzlrfV5tVKgPeCUwD3EL5RcXduY';

    fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(city)}&key=${apiKey}`)
    .then(response => response.json())
    .then(data => {
        if (data.results.length > 0) {
        const location = data.results[0].geometry.location;
        const lat = parseFloat(location.lat);
        const lng = parseFloat(location.lng);
        
        if (!isNaN(lat) && !isNaN(lng)) {
            callback(lat, lng);
        } else {
            console.error('Coordinate non valide');
        }
        } else {
        console.error('Nessuna posizione trovata per la città specificata '+ city);
        }
    })
    .catch(error => {
        console.error('Errore durante la richiesta di geocodifica:', error);
    });
}

export function updateURLParameters(newParameters) {
    const url = new URL(window.location.href);
    for (const [key, value] of Object.entries(newParameters)) {
        url.searchParams.set(key, value);
    }
    const newURL = url.toString();
    history.pushState({}, '', newURL);
}

export function readURLParameters(param) {
    const urlParams = new URLSearchParams(window.location.search);
    const par = urlParams.get(param);

    return par ;
}

export function checkLocationType(loc) {


    // Se l'input inizia con un numero
    console.log(loc)
    if (!isNaN(parseInt(loc[0]))) {
      // Prendi le prime parole dopo il primo spazio e prima della prima virgola
      return loc.split(' ')[1].split(',')[0];
    } 
    // Se l'input contiene 4 virgole
    else if ((loc.match(/,/g) || []).length === 3) {
      // Prendi le parole tra la prima e la seconda virgola
      return loc.split(',')[1].trim();
    } 
    // Se l'input contiene 3 virgole
    else if ((loc.match(/,/g) || []).length === 2) {
      // Prendi le parole prima della prima virgola
      return loc.split(',')[0];
    } 
    // Se non corrisponde a nessuno dei casi sopra
    else {
      return 'unknown';
    }
}
  /* Esempi di utilizzo
  console.log(checkLocationType('Milano%2C%20MI%2C%20Italia')); // Output: 'city'
  console.log(checkLocationType('Viale%20della%20Villetta%2C%20Parma%2C%20PR%2C%20Italia')); // Output: 'address'

  Venezia%2C%20Italia

  Corso%20Concordia%2C%20Milano%2C%20MI%2C%20Italia
  Via%20Padre%20Lino%2C%2043125%20Parma%2C%20PR%2C%20Italia
  Via%20Ugo%20Monneret%20de%20Villard%2C%20Milano%2C%20MI%2C%20Italia
  */