<?php

/**
 * Descrição da classe ate_atendimentos_real
 *
 * @author Cleber Nardelli
 */
class ate_atendimentosReal extends dsb_painelAbstract {
    
    function __construct() {
        parent::__construct();
        $this->setTitulo("Atendimentos Situação Atual");        
    }
    
    function dashboardQtdAtendimento() {
       $dashBoard = new dsb_dashboardGauge();
       $dashBoard->setTitulo("Atendimentos por Tipo 3D");
       $dashBoard->setQueryOfData($this->getQuery("SELECT COUNT(*) FROM SC_TESTE.ATENDIMENTOS"));
       
       $dashBoard->addQuadrante(0, 45, 'e44a00');
       $dashBoard->addQuadrante(45, 75, 'f8bd19');
       $dashBoard->addQuadrante(75, 100, '6baa01');
       
       $this->addDashboard($dashBoard);
       return $dashBoard;
    }    

    
}
