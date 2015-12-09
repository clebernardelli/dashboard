<?php

/**
 * Descrição da classe dsb_painelAbstract
 *
 * @author Cleber Nardelli
 */
abstract class dsb_painelAbstract {
    
    private $dashboards = Array();
    /* @var $conn dsb_connection_bd */
    private $conn;
    private $titulo;
    
    function __construct() {
       $this->conn = new dsb_connection_bd('teste', '127.0.0.1', 'postgres', '123456');
    }
    
    function getConn() {
        return $this->conn;
    }
    
    function getQuery($sSQL) {
        $oQuery = $this->getConn()->criaQuery($sSQL);
        $oQuery->open();
        return $oQuery;
    }

    function addDashboard( $dashBoard ) {
        array_push($this->dashboards, $dashBoard);
    }
    
    function renderPainel() {
        $result = '<header class="ui-widget-header" style="font-size: 12px; padding: 4px;">'. $this->getTitulo() . '</header>';
        foreach ($this->dashboards as $dashBoard) {
            $result .= $dashBoard->render();
        }
        return $result;
    }
    
    function addAllDashboards() {
        $aMethods = get_class_methods($this);
        foreach ($aMethods as $method) {
            if(substr($method, 0, 9) == 'dashboard') {
                $this->$method();
            }            
        }
    }
    
    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    
}
