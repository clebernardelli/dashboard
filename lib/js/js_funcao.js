/* 
 * Arquivo js base que deve ser inclu�do sempre
 * A camada de interface do framework depender� das fun��es aqui disponibilizadas.
 */

//Esta fun��o jQuery serve para configurar a forma como as requisi��es AJAX ser�o realizadas
$.ajaxSetup({
   type : "POST",
   url : "index.php"
})

//Fun��o gen�rica para fazer submiss�o de dados atrav�s de requisi��o AJAX (assincrono)
//utilizando o m�todo post para envio de dados.
function ajaxSendData(JSONdata, sender) {
        
    var jqxhr = $.ajax({
            data : JSONdata
        })
        .done(function(data){
                   
                   if(sender == "main") { 
                      renderPainel(data);
                   } else {
                      renderDashboard(sender, data);
                   }

              })
        .fail(function(){
                   alert("FALHA"); 
              })
        .always(function(){ 
                   //Sempre passar� por aqui quando a requisi��o foi conclu�da; 
              });
}

function renderPainel(HTMLData) {
    $( "#main" ).html(HTMLData);
}

function renderDashboard(sender, JSONData) {
    var updDashboardFunc = window["updateDashboard_" + sender];
    updDashboardFunc(JSONData);
}

//Fun��o para fechar um di�logo/janela
function fechaDialog(dialogID) {
  var dialogo = document.getElementById(dialogID);
  dialogo.outerHTML = "";
  delete dialogo;
}

function Exception(message) {
    showErro(message);
}
Exception.prototype = Error.prototype;

function showErro(msg) {
    $.fn.jAlert({
         'title':'Erro!',
         'message': msg,
         'theme': 'error'
       });
}

/*
   http://kevin.vanzonneveld.net
   +   original by: Brett Zamir (http://brettz9.blogspot.com)
   +      input by: Paul
       bugfixed by: Hyam Singer (http://www.impact-computing.com/)
   +   improved by: Philip Peterson
   +   bugfixed by: Brett Zamir (http://brettz9.blogspot.com)
   %        note 1: Should be considered expirimental. Please comment on this function.
   *     example 1: exit();
   *     returns 1: null
*/ 
function exit( status ) {
    var i;

    if (typeof status === 'string') {
        alert(status);
    }

    window.addEventListener('error', function (e) {e.preventDefault();e.stopPropagation();}, false);

    var handlers = [
        'copy', 'cut', 'paste',
        'beforeunload', 'blur', 'change', 'click', 'contextmenu', 'dblclick', 'focus', 'keydown', 'keypress', 'keyup', 'mousedown', 'mousemove', 'mouseout', 'mouseover', 'mouseup', 'resize', 'scroll',
        'DOMNodeInserted', 'DOMNodeRemoved', 'DOMNodeRemovedFromDocument', 'DOMNodeInsertedIntoDocument', 'DOMAttrModified', 'DOMCharacterDataModified', 'DOMElementNameChanged', 'DOMAttributeNameChanged', 'DOMActivate', 'DOMFocusIn', 'DOMFocusOut', 'online', 'offline', 'textInput',
        'abort', 'close', 'dragdrop', 'load', 'paint', 'reset', 'select', 'submit', 'unload'
    ];

    function stopPropagation (e) {
        e.stopPropagation();
        // e.preventDefault(); // Stop for the form controls, etc., too?
    }
    for (i=0; i < handlers.length; i++) {
        window.addEventListener(handlers[i], function (e) {stopPropagation(e);}, true);
    }

    if (window.stop) {
        window.stop();
    }

    throw '';
}