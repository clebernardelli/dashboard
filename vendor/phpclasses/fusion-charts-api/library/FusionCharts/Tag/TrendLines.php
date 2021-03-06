<?php

/**
 * @package Tag
 * @version 2.0
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Tag_TrendLines extends FusionCharts_Tag_Abstract
{
    /**
     * @var array
     */
    protected $lines = array();

    /**
     * @param FusionCharts_Tag_Line $line
     * @return FusionCharts_Tag_TrendLines
     */
    public function addLine(FusionCharts_Tag_Line $line)
    {
        $this->lines[] = $line->getXML();
        return $this;
    }

    /**
     * @return string
     */
    public function getXMLLines()
    {
        return implode(' ', $this->lines);
    }

    /**
     * (non-PHPdoc)
     * @see FusionCharts_Tag_Abstract::getXML()
     */
    public function getXML()
    {
        return '<trendlines ' . $this->getXMLAttributes() . '>' . $this->getXMLLines() . '</trendlines>';
    }
}
