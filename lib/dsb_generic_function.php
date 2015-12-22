<?php

/* 
 * Esta unit implementa as funчѕes genщricas de maneira estruturada do framework.
 * Todas as funчѕes aqui sуo declaradas com o prщ-nome: GENERIC
 */

/*
 * Esta funчуo щ utilizada para registrar o handler de erros disparados pela aplicaчуo
 * 
 * @param integer $codigo Cѓdigo da Mensagem (E_USER_WARNING, E_USER_ERROR, E_USER_NOTICE)
 * @param string $mensagem String de texto da mensagem
 * @param string $arquivo Nome do arquivo que lanчou a mensagem (trace)
 * @param integer $linha Nњmero da linha de onde o erro foi lanчado
 */
function generic_error_handler($codigo, $mensagem, $arquivo, $linha) {
    
    $mensagem = 'ERRO [' . $mensagem . '] [' . $arquivo . ', linha: ' . $linha . '. Cѓdigo: ' . $codigo. ']\n';
    
    /* 
     * Poderс no futuro armazenar em log.
     */
    $logHandle = fopen('erros.log', 'a');
    fwrite($logHandle, $mensagem);
    fclose($logHandle);
    
    /*
     * Se for uma warning, joga pra cima.
     */
    if(($codigo == E_USER_WARNING) || ($codigo == E_USER_NOTICE)) {
        echo $mensagem;
    }
    else if ($codigo == E_USER_ERROR) {
        echo $mensagem;
        die;
    } else {
        echo $mensagem;
        die;
    }
}
set_error_handler('generic_error_handler');

function generic_application_message($mensagem, $tipoMensagem = E_USER_NOTICE) {
    
    trigger_error($mensagem, $tipoMensagem);
    
}

function getBasePath($file) {
    return substr(str_replace('\\', '/', realpath(dirname($file))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']))));
}