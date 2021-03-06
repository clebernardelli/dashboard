<?php

/**
 * Class to create chart with MSLine.swf from fusioncharts.com
 * @version 2.0
 * @package Chart
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Chart_Line extends FusionCharts_Chart_Abstract
{
    const SWF_NAME = 'MSLine.swf';

    /**
     * @var array
     */
    protected $lines = array();

    /**
     * @var array
     */
    protected $categories = array();

    /**
     * @var array
     */
    protected $trendLines = array();

    /**
     * @param FusionCharts_Tag_Categories $categories
     * @return FusionCharts_Chart_Line
     */
    public function addCategories(FusionCharts_Tag_Categories $categories)
    {
        $this->categories[] = $categories->getXML();
        return $this;
    }

    /**
     * @param FusionCharts_Tag_DataSet $dataSet
     * @return FusionCharts_Chart_Line
     */
    public function addLine(FusionCharts_Tag_DataSet $dataSet)
    {
        $this->lines[] = $dataSet->getXML();
        return $this;
    }

    /**
     * @param FusionCharts_Tag_TrendLines $trendLines
     * @return FusionCharts_Chart_Line
     */
    public function addTrendLines(FusionCharts_Tag_TrendLines $trendLines)
    {
        $this->trendLines[] = $trendLines->getXML();
        return $this;
    }

    /**
     * @param boolean $rotate
     * @return FusionCharts_Chart_Line
     */
    public function setLabelRotate($rotate = true)
    {
        if ($rotate == true) {
            $this->setAttribute('labelDisplay', 'Rotate');
            $this->setAttribute('slantLabels', '1');
        }
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see FusionCharts_Chart_Abstract::startDefaultAttributes()
     */
    protected function startDefaultAttributes()
    {
        $this->setAttribute('caption', $this->name);
    }

    /**
     * (non-PHPdoc)
     * @see FusionCharts_Chart_Abstract::getXML()
     */
    public function getXML()
    {
        $xmlChart  = "<chart " . $this->getAsXMLAttributes($this->attribute) . " >";
        $xmlChart .= implode(' ', $this->categories) . implode(' ', $this->lines);
        $xmlChart .= implode(' ', $this->trendLines);
        $xmlChart .= "</chart>";

        return $xmlChart;
    }
}
