

$(document).ready(function() {
    var wheelAction = true; 

    $(document).on('click', '.next', function() {
        wheelAction = false;
        console.log("de");

        var slider = $(this).siblings('.image-slider');
        var slideWidth = slider.find('img').outerWidth(true);
        var currentIndex = slider.data('currentIndex') || 0;
        currentIndex++;
        var maxIndex = slider.find('img').length - 1;
        if (currentIndex > maxIndex) {
            currentIndex--;
        }
        var newPosition = slideWidth * currentIndex;
        slider.data('currentIndex', currentIndex).animate({scrollLeft: newPosition}, 100);

        var dots = $(this).siblings('.dot-container');
        dots.html((currentIndex+1) + '/' + (maxIndex+1));



        setTimeout(function() {
            wheelAction = true; // Ripristina il flag dopo un breve ritardo
        }, 1200);
    });

    $(document).on('click', '.prev', function() {

        
        wheelAction = false;
        var slider = $(this).siblings('.image-slider');
        var slideWidth = slider.find('img').outerWidth(true);
        var currentIndex = slider.data('currentIndex') || 0;
        currentIndex--;
        var maxIndex = slider.find('img').length - 1;
        if (currentIndex < 0) {
            currentIndex ++;
        }
        var newPosition = slideWidth * currentIndex;
        slider.data('currentIndex', currentIndex).animate({scrollLeft: newPosition}, 100);

        var dots = $(this).siblings('.dot-container');
        dots.html((currentIndex+1) + '/' + (maxIndex+1));
        
        setTimeout(function() {
            wheelAction = true; // Ripristina il flag dopo un breve ritardo
        }, 1200);
    });




    /*
    document.addEventListener('wheel', function(event) {
        event.preventDefault();
    
        var slider = event.target.closest('.image-slider');
    
        if (slider && wheelAction) {
            var deltaX = event.deltaX;
            var direction = deltaX > 0 ? 'right' : 'left';
            console.log(deltaX)
    
            console.log('Scroll direction:', direction);
    
            // Esegui azioni in base alla direzione dello scorrimento
            if (direction === 'right') {
                // Scorrimento verso destra, chiamata alla funzione "next"
                var nextButton = slider.parentNode.querySelector('.next');
                if (nextButton) {
                    nextButton.click();
                }
            } else if (direction === 'left') {
                // Scorrimento verso sinistra, chiamata alla funzione "prev"
                var prevButton = slider.parentNode.querySelector('.prev');
                if (prevButton) {
                    prevButton.click();
                }
            }
    
            // Memorizza la posizione dello scroll per il prossimo controllo
            slider.setAttribute('data-last-scroll-left', slider.scrollLeft);
        }
    }, { passive: false });
    */
});

