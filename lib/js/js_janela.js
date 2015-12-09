/* 
 * Comportamentos de tela.
 */
$(document).ready(function(){
    resizeObjects();
});
$(window).resize(function(){
    resizeObjects();
});

$(function() {
    $( "#accordion" ).accordion();
});
$(function() {
    $( "#menu-lateral" ).resizable({
      minHeight: 140,
      minWidth: 100,
      resize: function() {
        $( "#accordion" ).accordion( "refresh" );
      }
    });
  });  
$(function() {
  $( "#resizable" ).resizable({
    containment: "#container"
  });
}); 

$(function() {
    $( "#button" ).button();
});

$(function() {
    $( "#tooltip" ).tooltip();
});

$(function() {
    $( "div.draggable").draggable({ scroll: true, scrollSensitivity: 100 });
}); 

function resizeObjects() {
    //Fixo 200 para o menu left
    $("#menu-lateral").width(200);
    $("#menu-lateral").height($(window).height()-25);

    //Toda a área disponível para o main
    var c_width = $(window).width() - $("#menu-lateral").width() - 30;
    $("#main").width(c_width);
    $("#main").css({ left: $("#menu-lateral").width() + 2 });
}
