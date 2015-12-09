<?php

/**
 * Abstract class to create fusionchart classes
 * @version 2.0
 * @package Chart
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
abstract class FusionCharts_Chart_Abstract
{

    const JS_NAME = 'FusionCharts.js';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $width;

    /**
     * @var integer
     */
    protected $height;

    /**
     * @var string
     */
    protected $pathSWF;

    /**
     * @var string
     */
    protected $pathJS;

    /**
     * @var array
     */
    protected $attribute = array();

    /**
     * @param string $pathSWF full swf file
     * @param string $pathJS full js file
     * @throws InvalidArgumentException file not found
     */
    public function __construct($pathSWF, $pathJS)
    {
        $this->pathSWF = $pathSWF;
        $this->pathJS = $pathJS;

        if (!file_exists($this->pathSWF)) {
            throw new InvalidArgumentException("swf file not found: " . $this->pathSWF);
        }
        if (!file_exists($this->pathJS)) {
            throw new InvalidArgumentException("js file not found: " . $this->pathJS);
        }
    }

    /**
     * @param string $name
     * @return FusionCharts_Chart_Abstract
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param integer $width
     * @return FusionCharts_Chart_Abstract
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param integer $height
     * @return FusionCharts_Chart_Abstract
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return FusionCharts_Chart_Abstract
     */
    public function setAttribute($name, $value)
    {
        $this->attribute[$name] = $value;
        return $this;
    }

    /**
     * @return void
     */
    abstract protected function startDefaultAttributes();

    /**
     * @return string xml
     */
    abstract public function getXML();

    /**
     * @return string javascript
     */
    public function render()
    {
        $this->startDefaultAttributes();

        $scriptJS = "<div id='" . md5($this->name) . "'></div>";
        $scriptJS .= "<script type='text/javascript' src='" . $this->pathJS . "'></script>";
        $scriptJS .= "<script type='text/javascript'>";
        $scriptJS .= "var xml = \"" . $this->getXML() . "\";";
        $scriptJS .= "var chart = new FusionCharts('" . $this->pathSWF . "', 'id', '" . $this->width . "', '" . $this->height . "', '0', '1');";
        $scriptJS .= "chart.setXMLData(xml);";
        $scriptJS .= "chart.render('" . md5($this->name) . "');";
        $scriptJS .= "</script>";

        return $scriptJS;
    }

    /**
     * @param array $attributes
     * @return string XML
     */
    protected function getAsXMLAttributes(array $attributes = null)
    {
        if (! $attributes) {
            return '';
        }

        $xmlAttrbs = array();
        foreach ($attributes as $key => $value) {
            $xmlAttrbs[] = $key . "='" . $value . "'";
        }

        return implode(' ', $xmlAttrbs);
    }
}
