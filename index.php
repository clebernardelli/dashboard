<?php
   require_once 'lib/dsb_function_autoload.php';
   if(isset($_POST['showpainel'])) {
        if(class_exists($_POST['showpainel'])) {
            /* @var $painel dsb_painelAbstract */
            $class = $_POST['showpainel'];
            $painel = new $class();
            if(isset($_POST['iddashboard'])) {
                //Atualizar um dashboard espec�fico
                $method = 'dashboard' . $_POST['iddashboard'];
                if(method_exists($painel, $method)) {
                    $painel->$method();
                } else {
                    throw new dsb_class_exception_base('M�todo ' . $method . ' n�o existe na classe ' . $_POST['showpainel']);            
                }                
            } else {
                $painel->addAllDashboards();
                echo $painel->renderPainel();
            }
        } else {
           throw new dsb_class_exception_base('Classe ' . $_POST['showpainel'] . ' n�o implementada!');            
        }
   } else {
        require_once 'index.html';
   }
