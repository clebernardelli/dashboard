<?php

/**
 * Descrição da classe dashboardBarras
 *
 * @author Cleber Nardelli
 */
class dsb_dashboardBarras extends dsb_dashBoardAbstract {
    
    private $nomeEixoX;
    private $nomeEixoY;
    
    function __construct() {      
        parent::__construct();
        $this->setTipoGrafico(dsb_dashBoardType::grBarras2D);
        /* Adicionar o js necessário para o tipo do dashboard */
        $this->addInclude('lib/fusioncharts/js/fusioncharts.charts.js');
    }
    
    public function set2D() {
        $this->setTipoGrafico(dsb_dashBoardType::grBarras2D);
    }
    
    public function set3D() {
        $this->setTipoGrafico(dsb_dashBoardType::grBarras3D);
    }
    
    function getNomeEixoX() {
        return $this->nomeEixoX;
    }

    function getNomeEixoY() {
        return $this->nomeEixoY;
    }

    function setNomeEixoX($nomeEixoX) {
        $this->nomeEixoX = $nomeEixoX;
    }

    function setNomeEixoY($nomeEixoY) {
        $this->nomeEixoY = $nomeEixoY;
    }
    
    public function getJSONData() {
        return '"chart": {
                            "caption": "'. $this->getTitulo(). '",
                            "subCaption": "' . $this->getSubTitulo() . '",
                            "xAxisName": "' . $this->getNomeEixoX() . '",
                            "yAxisName": "' . $this->getNomeEixoY() . '",
                            "theme": "fint"
                         }';
    }

    public function getJSONSourceFormat() {
        if($this->getQueryOfData()) {
            $result = '';
            /* @var dsb_query */
            while($record = $this->getQueryOfData()->next()) {
                $result .= '{ "label": "' . $record[0] . '", ' .
                           '  "value": "' . $record[1] . '"},';
            }        
            $result = substr($result, 0, strlen($result)-1);
            $result = '"data": [' . $result . ']';
            return $result;
        } else {
            return '"data": []';
        }
    }

}
