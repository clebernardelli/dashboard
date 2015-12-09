<?php

/**
 * Class to create chart with Pie3D.swf from fusioncharts.com
 * @version 2.0
 * @package Chart
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Chart_Pie extends FusionCharts_Chart_Abstract
{
    const SWF_NAME = 'Pie3D.swf';

    /**
     * @var array
     */
    protected $slices = array();

    /**
     * @param FusionCharts_Tag_Set $set
     * @return FusionCharts_Chart_Pie
     */
    public function addSlice(FusionCharts_Tag_Set $set)
    {
        $this->slices[] = $set->getXML();
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see FusionCharts_Chart_Abstract::startDefaultAttributes()
     */
    protected function startDefaultAttributes()
    {
        $this
            ->setAttribute('caption', $this->name)
            ->setAttribute('theme', 'fint');
    }

    /**
     * (non-PHPdoc)
     * @see FusionChartAbstract::getXML()
     */
    public function getXML()
    {
        $xmlChart = "<chart " . $this->getAsXMLAttributes($this->attribute) . " >" . implode(' ', $this->slices) . "</chart>";

        return $xmlChart;
    }
}
