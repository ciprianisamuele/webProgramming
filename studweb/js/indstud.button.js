



let w = $(window).width();
let h = $(window).height();



var $overlay_sub_account = $('<div/>', {
    'id': 'overlay-sub-account',
    css: {
     position   : 'absolute',
     height     : h + 'px',
     width      : w + 'px',
     left       : 0,
     top        : 0,
     background : '#000',
     opacity    : 0,
     zIndex: 99
    }
}).appendTo('body');

var $overlay_log = $('<div/>', {
    'id': 'overlay-log',
    css: {
     position   : 'absolute',
     height     : h + 'px',
     width      : w + 'px',
     left       : 0,
     top        : 0,
     background : '#000',
     opacity    : 0.3,
     zIndex: 101
    }
}).appendTo('body');


$("#overlay-sub-account").hide();
$("#overlay-log").hide();


if(stad === 1){

    $(".register").removeClass('hide');
    $("#overlay-log").show();
    $('.register #email').attr('placeholder',email);
    $('.register #email').val(email);




}
if(stad === 2){

    $(".login").removeClass('hide');
    $("#overlay-log").show();
}

$(".profile").click(function(){
    $(".sub-account").removeClass('hide');
    $("#overlay-sub-account").show();

    
})

$("#overlay-sub-account").click(function(){
    $(".sub-account").addClass('hide');
    $("#overlay-sub-account").hide();
})


$('.accedi-registrati').click(function(){
    $(".sub-account").addClass('hide');
    $("#overlay-sub-account").hide();
    
    $(".first-log").removeClass('hide');
    $("#overlay-log").show();
})

$('#overlay-log').click(function(){
    $(".first-log").addClass('hide');
    $(".login").addClass('hide');
    $(".register").addClass('hide');
    $("#overlay-log").hide();
    stad = 0;

})



$('.log-pass  .dietro').click(function() {
    var x = document.getElementById("new-password");
    if (x.type === "password") {

        x.type = "text";
        $('.log-pass  .dietro').empty();
        $('.log-pass  .dietro').append( '<i class="fa-solid fa-eye-slash"></i>');
    } 
    else {
        x.type = "password";
        $('.log-pass  .dietro').empty();
        $('.log-pass  .dietro').append('<i class="fa-solid fa-eye"></i>');
    }
})

$('.pass  .dietro').click(function() {
    console.log("ccc");
    var x = document.getElementById("new-password");
    console.log("ccc");
    if (x.type === "password") {

        x.type = "text";
        $('.pass  .dietro').empty();
        $('.pass  .dietro').append( '<i class="fa-solid fa-eye-slash"></i>');
    } 
    else {
        x.type = "password";
        $('.pass  .dietro').empty();
        $('.pass  .dietro').append('<i class="fa-solid fa-eye"></i>');
    }
})




$()

$(document).ready(function() {

    let boolIsLast = 1;

    /*
    $(window).click(function(){
        $('.nav').addClass('long');
        console.log("aaa");
    });
    */
    function scrollHandler() {
        let currentScroll =  $(this).scrollTop();

        if (currentScroll > -1000) {

            $('.scroll-down').removeClass('mostrato');

        } else {
            if(boolIsLast){
                $('.scroll-down').addClass('mostrato');
            }

        }

        if(currentScroll == 0){
            boolIsLast = 1;
        }
   
    }


    // Aggiungiamo un listener per lo scroll al contenitore con event delegation
    $('.chat').on('mouseover', '.chat-box', scrollHandler);

    $('.chat').on('click', '.scroll-down', function() {
        var chatBox = $('.chat-box');
        var scrollHeight = chatBox.prop('scrollHeight');
        chatBox.scrollTop(scrollHeight);
        boolIsLast = 0;
        $('.scroll-down').removeClass('mostrato');
    });

    

});

function redirect(){

    window.location = "http://localhost/studweb/pubblica.php"
}