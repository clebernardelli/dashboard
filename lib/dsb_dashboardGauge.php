<?php

/**
 * Descrição da classe dsb_dashboardGauge
 * 
 * @author Cleber Nardelli
 */
class dsb_dashboardGauge extends dsb_dashBoardAbstract {
 
    private $limiteInferior;
    private $limiteSuperior;
    private $nomeLimiteInferior;
    private $nomeLimiteSuperior;
    private $simboloValor;
    private $valorExibir;
    
    private $quadrantes = Array();
    
    function __construct() {      
        parent::__construct();
        $this->setTipoGrafico(dsb_dashBoardType::grGauge);

        /* Setar os valores iniciais padrão */
        $this->setLimiteInferior(0);
        $this->setLimiteSuperior(100);
        $this->setNomeLimiteInferior('Nenhum');
        $this->setNomeLimiteSuperior('Todos');
        $this->setSimboloValor('%');        
    }
    
    public function getJSONData() {
        $chart = '"chart": {
                            "theme": "fint",
                            "caption": "'. $this->getTitulo(). '",
                            "subCaption": "' . $this->getSubTitulo() . '",
                            "lowerLimit": "' . $this->getLimiteInferior() . '",
                            "upperLimit": "' . $this->getLimiteSuperior() . '",
                            "lowerlimitdisplay": "' . $this->getNomeLimiteInferior() . '",
                            "upperlimitdisplay": "' . $this->getNomeLimiteSuperior() . '",
                            "numberSuffix": "' . $this->getSimboloValor() . '",
                            "showvalue": "0",
                            "chartBottomMargin": "40",
                            "valueFontSize": "11",
                            "valueFontBold": "0",
                            "palette": "1",
                            "tickvaluedistance": "10",
                            "gaugeinnerradius": "0",
                            "bgcolor": "FFFFFF",
                            "pivotfillcolor": "333333",
                            "pivotradius": "8",
                            "pivotfillmix": "333333, 333333",
                            "pivotfilltype": "radial",
                            "pivotfillratio": "0,100",
                            "showtickvalues": "1",
                            "showborder": "0"
                         }';
        
        $colorRange = '"colorrange": { 
                        "color": [';
        /* @var $quadrante dsb_dashboardGauge_quadrante */
        foreach ($this->quadrantes as $quadrante) {
            $colorRange .= '{ "minvalue": "' . $quadrante->getValorInferior() . '", 
                              "maxvalue": "' . $quadrante->getValorSuperior() . '", 
                              "code": "' . $quadrante->getCor() . '"
                            },';
        }
        $colorRange = substr($colorRange, 0, strlen($colorRange)-1);
        $colorRange .= ']}';
        
        return $chart . ',' . $colorRange;
    }

    public function getJSONSourceFormat() {
        if($this->getQueryOfData()) {
            $result = '"dials": {
                        "dial": [
                            {';
            $record = $this->getQueryOfData()->next();
            if($record) {
                $result .= '"value": "' . $record[0] . '",
                            "rearextension": "15",
                            "radius": "100",
                            "bgcolor": "333333",
                            "bordercolor": "333333",
                            "basewidth": "8"';
            }
            $result .= '    }
                          ]
                        }';                
            return $result;
        } else {
            return '"dials": { "dial" : [{}]}';
        }
    }
    
    public function addQuadrante($valorInferior, $valorSuperior, $cor) {
        $quadrante = new dsb_dashboardGauge_quadrante();
        $quadrante->setValorInferior($valorInferior);
        $quadrante->setValorSuperior($valorSuperior);
        $quadrante->setCor($cor);
                
        array_push($this->quadrantes, $quadrante);
    }
    
    function getLimiteInferior() {
        return $this->limiteInferior;
    }

    function getLimiteSuperior() {
        return $this->limiteSuperior;
    }

    function getNomeLimiteInferior() {
        return $this->nomeLimiteInferior;
    }

    function getNomeLimiteSuperior() {
        return $this->nomeLimiteSuperior;
    }

    function getSimboloValor() {
        return $this->simboloValor;
    }

    function getValorExibir() {
        return $this->valorExibir;
    }

    function setLimiteInferior($limiteInferior) {
        $this->limiteInferior = $limiteInferior;
    }

    function setLimiteSuperior($limiteSuperior) {
        $this->limiteSuperior = $limiteSuperior;
    }

    function setNomeLimiteInferior($nomeLimiteInferior) {
        $this->nomeLimiteInferior = $nomeLimiteInferior;
    }

    function setNomeLimiteSuperior($nomeLimiteSuperior) {
        $this->nomeLimiteSuperior = $nomeLimiteSuperior;
    }

    function setSimboloValor($simboloValor) {
        $this->simboloValor = $simboloValor;
    }

    function setValorExibir($valorExibir) {
        $this->valorExibir = $valorExibir;
    }
    
}

class dsb_dashboardGauge_quadrante {
    
    private $valorInferior;
    private $valorSuperior;
    private $cor;
    
    function getValorInferior() {
        return $this->valorInferior;
    }

    function getValorSuperior() {
        return $this->valorSuperior;
    }

    function getCor() {
        return $this->cor;
    }

    function setValorInferior($valorInferior) {
        $this->valorInferior = $valorInferior;
    }

    function setValorSuperior($valorSuperior) {
        $this->valorSuperior = $valorSuperior;
    }

    function setCor($cor) {
        $this->cor = $cor;
    }

}
