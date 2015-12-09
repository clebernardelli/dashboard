<?php
   require_once 'lib/dsb_function_autoload.php';
   if(isset($_POST['showpainel'])) {
        if(class_exists($_POST['showpainel'])) {
            /* @var $painel dsb_painelAbstract */
            $class = $_POST['showpainel'];
            $painel = new $class();
            if(isset($_POST['iddashboard'])) {
                //Atualizar um dashboard específico
                $method = 'dashboard' . $_POST['iddashboard'];
                if(method_exists($painel, $method)) {
                    $painel->$method();
                } else {
                    throw new dsb_class_exception_base('Método ' . $method . ' não existe na classe ' . $_POST['showpainel']);            
                }                
            } else {
                $painel->addAllDashboards();
                echo $painel->renderPainel();
            }
        } else {
           throw new dsb_class_exception_base('Classe ' . $_POST['showpainel'] . ' não implementada!');            
        }
   } else {
        require_once 'index.html';
   }
