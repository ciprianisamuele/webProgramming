


$(document).ready(function(){

    var leftDiv = $(".impostazioni .left-scroll-overlay"); // Estrai l'elemento JavaScript nativo
    var rightDiv = $(".impostazioni .right");



    leftDiv.append('<div style="height:' + rightDiv.prop('scrollHeight') + 'px;"></div>');
    leftDiv.height(rightDiv.height());

    // Sincronizza lo scrolling da sinistra a destra
    leftDiv.on("scroll", function() {
      var scrollTop = $(this).scrollTop();
      rightDiv.scrollTop(scrollTop);
    });
    rightDiv.on("scroll", function() {
        var scrollTop = $(this).scrollTop();
        leftDiv.scrollTop(scrollTop);
    });
    console.log(leftDiv.height(), leftDiv.prop('scrollHeight'), rightDiv.height(), rightDiv.prop('scrollHeight'))

  });