<?php

/**
 * Descrição da classe ate_atendimentos
 *
 * @author Cleber Nardelli
 */
class ate_atendimentos extends dsb_painelAbstract {
    
    function __construct() {
        parent::__construct();
        $this->setTitulo("Atendimentos");        
    }
    
    function dashboardAtendimentosMes() {
       $dashBoard = new dsb_dashboardBarras();
       $dashBoard->setTitulo("Atendimentos por Tipo");
       $dashBoard->setNomeEixoX("Tipo");
       $dashBoard->setNomeEixoY("Atendimentos");
       $dashBoard->setQueryOfData($this->getQuery("SELECT * FROM SC_TESTE.ATENDIMENTOS"));
       
       $this->addDashboard($dashBoard);
       return $dashBoard;
    }
    
    function dashboardAtendimentosMes3D() {
       $dashBoard = new dsb_dashboardBarras();
       $dashBoard->set3D();
       $dashBoard->setTitulo("Atendimentos por Tipo 3D");
       $dashBoard->setNomeEixoX("Tipo");
       $dashBoard->setNomeEixoY("Atendimentos");
       $dashBoard->setQueryOfData($this->getQuery("SELECT * FROM SC_TESTE.ATENDIMENTOS"));
       
       $this->addDashboard($dashBoard);
       return $dashBoard;
    }    
    
}
