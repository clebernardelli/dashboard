<?php

require_once 'dsb_generic_function.php';
/* 
 * Implementa o autoload padrão da aplicação.
 * Padrão PSR-0
 */

function autoload($className) {
    
    $className = ltrim($className, '\\');
    /*
     * Lib é a pasta da estrutura 
     * Se possuir est no nome então
     */    
    if(substr($className, 0, 4) == 'dsb_') {
        $fileName = strtolower('lib' . DIRECTORY_SEPARATOR . $className . '.php');
        if (file_exists($fileName)) {
           require_once $fileName;
        } else {
            $fileName = strtolower('lib\interface' . DIRECTORY_SEPARATOR . $className . '.php');
            if (file_exists($fileName)) {
               require_once $fileName;
            } else {
               /* @var est_class_exception_base DsbException */ 
               throw new dsb_class_exception_base('O arquivo de estrutura ' . $fileName . ' não foi encontrado para carregar!');
            }   
        }        
    } else {
       /*
       * Src é a pasta dos módulos e demais classes da aplicação.
       */ 
       $aclassName = str_getcsv($className, '_');
       $path = '';
       for ($index = 0; $index < (count($aclassName)-1); $index++) {
           $path .= $aclassName[$index] . DIRECTORY_SEPARATOR;
       }

       $fileName = 'src' . DIRECTORY_SEPARATOR . $path . $className . '.php';
       if (file_exists($fileName)) {
          require_once $fileName;
       } else {
          if((strtolower($className) == 'appInit') && (file_exists('src/appinit.php'))) {
             require_once('src/appinit.php');  
          } else           
          if(strpos($className, '.') > 0) {
             autoload_orm_class($className);              
          } else {            
             /* @var est_class_exception_base DsbException */ 
             throw new dsb_class_exception_base('O arquivo ' . $fileName . ' não foi encontrado para carregar!');
          }
       }
    }    
    
}

spl_autoload_register('autoload');