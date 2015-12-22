<?php

/**
 * Descrição da classe ate_atendimentos
 *
 * @author Cleber Nardelli
 */
class ate_atendimentos extends dsb_painelAbstract {
    
    function __construct() {
        parent::__construct();
        $this->setId(static::class);
        $this->setTitulo("Atendimentos");        
    }
    
    function dashboardAtendimentosMes() {
       $dashBoard = new dsb_dashboardBarras($this);
       $dashBoard->setName("AtendimentosMes");
       $dashBoard->setTitulo("Atendimentos por Tipo");
       $dashBoard->setNomeEixoX("Tipo");
       $dashBoard->setNomeEixoY("Atendimentos");
       $dashBoard->setInterval(60);
       $dashBoard->setQueryOfData($this->getQuery("SELECT * FROM SC_TESTE.ATENDIMENTOS"));
       
       $this->addDashboard($dashBoard);
       return $dashBoard;
    }

    function dashboardAtendimentosMes3D() {
       $dashBoard = new dsb_dashboardBarras($this);
       $dashBoard->setName("AtendimentosMes3D");
       $dashBoard->set3D();
       $dashBoard->setTitulo("Atendimentos por Tipo 3D");
       $dashBoard->setNomeEixoX("Tipo");
       $dashBoard->setNomeEixoY("Atendimentos");
       $dashBoard->setQueryOfData($this->getQuery("SELECT * FROM SC_TESTE.ATENDIMENTOS"));
       
       $this->addDashboard($dashBoard);
       return $dashBoard;
    }    
    
}
