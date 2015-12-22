<?php

/**
 * Descrição da classe fusionChartAbstract
 *
 * @author Cleber Nardelli
 */

abstract class dsb_dashBoardType {
    
    const __default = self::grBarras;
    
    const grBarras2D = 1;
    const grPizza = 2;
    const grGauge = 3;
    const grBarras3D = 4;
    const grNumericGroup = 5;
    
}

abstract class dsb_dashBoardAbstract {
    
    /* Dados para o gráfico no formato JSON */
    private $data;
    
    private $name;
    /* @type dashBoardType */
    private $tipoGrafico;
    private $titulo; 
    private $subTitulo;
    private $largura;
    private $altura;
    private $location;
    
    /* @var dsb_query */
    private $queryOfData;
    
    function __construct() {
       $this->setAltura(300);
       $this->setLargura(500);
       $this->setTipoGrafico(dsb_dashBoardType::grBarras2D);
    }
    
    function getName() {
        return $this->name;
    }

    function setName($name) {
        $this->name = $name;
    }
    
    function getLocation() {
        return $this->location;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getTipoGrafico() {
        return $this->tipoGrafico;
    }

    function setTipoGrafico($tipoGrafico) {
        $this->tipoGrafico = $tipoGrafico;
    }
    
    function getLargura($addPx = 0) {
        if($addPx > 0) {
            return $this->largura + $addPx;
        }
        return $this->largura;
    }

    function getAltura($addPx = 0) {
        if($addPx > 0) {
            return $this->altura + $addPx;
        }
        return $this->altura;
    }

    function setLargura($largura) {
        $this->largura = $largura;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }
    
    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
        if(!$this->getName()) {
            $this->setName(str_replace(' ', '_', $this->titulo));
        }
    }
    
    function getSubTitulo() {
        return $this->subTitulo;
    }

    function setSubTitulo($subTitulo) {
        $this->subTitulo = $subTitulo;
    }

    function getQueryOfData() {
        return $this->queryOfData;
    }

    function setQueryOfData($queryOfData) {
        $this->queryOfData = $queryOfData;
    }

    private function getFCType() {
        switch ($this->getTipoGrafico()) {
            case dsb_dashBoardType::grBarras2D : return 'column2d';
                break;
            case dsb_dashBoardType::grBarras3D : return 'column3d';
                break;
            case dsb_dashBoardType::grGauge : return 'angulargauge';
                break;
            /* TODO */
            case dsb_dashBoardType::grNumericGroup : return '?';
                break;
            case dsb_dashBoardType::grPizza : return 'pie';
                break;
            default:
                break;
        }
    }

    public function render()
    {
        $scriptJS = '<div id="area_dash_'.md5($this->getName()).'" class="draggable" style="width: ' .  $this->getLargura(20) . 'px; height: ' . $this->getAltura(38) . 'px;">'
                  . '  <button onclick="ajaxSendData(\'showpainel=ate_atendimentos&iddashboard='. $this->getName(). '\',\'' . md5($this->getName()) . '\')">Atualizar</button>';
        if(!$this->getLocation()) {
            $scriptJS .= '<div id="' . md5($this->getName()) . '" style="display: inline-block;"></div>';
            $renderAt = md5($this->getName());
        } else {
            $renderAt = $this->getLocation();
        }
        $scriptJS .= "<script type='text/javascript'>";
        $scriptJS .= 'var chart = new FusionCharts({"type": "'. $this->getFCType() .'",
                                                    "width": "'. $this->getLargura(). '",
                                                    "height": "' . $this->getAltura(). '",  
                                                    "dataFormat": "json",
                                                    "dataSource":  {'. 
                                                                       $this->getJSONSourceFormat(). ','. 
                                                                       $this->getJSONData(). '
                                                                   }
                     });
                     chart.render("' . $renderAt . '");
                     
                     function updateDashboard_' . $renderAt . '(JSONData)
                     {
                         try {
                             var chartReference = FusionCharts("'. $renderAt . '");
                             chartReference.setXMLUrl(JSONData);
                         } catch (ex) {
                             alert("Falha ao carregar gráfico ' . $renderAt . '");
                         }   
                     }';        
        $scriptJS .= "</script>";
        $scriptJS .= "</div>";
        
        return $scriptJS;
    }
        
    abstract function getJSONSourceFormat();
    abstract function getJSONData();
}
