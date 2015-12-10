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
    $( "#main" ).resizable({
      minHeight: 140,
      minWidth: 100,
      resize: function() {
        $( "#container" ).accordion( "refresh" );
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
    $( "div.draggable").draggable({ containment: "#main", scroll: false }); 
});

function resizeObjects() {
    //Fixo 200 para o menu left
    $("#menu-lateral").width(200);
    $("#menu-lateral").height($(window).height()-10);

    //Toda a área disponível para o main
    var c_width = $(window).width() - $("#menu-lateral").width() - 30;
    $("#main").width(c_width);
    $("#main").height($(window).height()-10);
};