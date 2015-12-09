<?php

/**
 * Class to create chart with Pareto3D.swf from fusioncharts.com
 * @version 2.0
 * @package Chart
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
class FusionCharts_Chart_Pareto extends FusionCharts_Chart_Abstract
{
    const SWF_NAME = 'Pareto3D.swf';

    /**
     * @var string
     */
    protected $xDesc;

    /**
     * @var string
     */
    protected $yDesc;

    /**
     * @var array
     */
    protected $sets = array();

    /**
     * @param string $xDesc
     * @return FusionCharts_Chart_Pareto
     */
    public function setXdescription($xDesc)
    {
        $this->xDesc = $xDesc;
        return $this;
    }

    /**
     * @param string $yDesc
     * @return FusionCharts_Chart_Pareto
     */
    public function setYdescription($yDesc)
    {
        $this->yDesc = $yDesc;
        return $this;
    }

    /**
     * @param FusionCharts_Tag_Set $set
     * @return FusionCharts_Chart_Pareto
     */
    public function addColumn(FusionCharts_Tag_Set $set)
    {
        $this->sets[] = $set->getXML();
        return $this;
    }

    /**
     * @param boolean $rotate
     * @return FusionCharts_Chart_Pareto
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
        $this
            ->setAttribute('caption', $this->name)
            ->setAttribute('xaxisname', $this->xDesc)
            ->setAttribute('pyaxisname', $this->yDesc)
            ->setAttribute('animation', '1');
    }

    /**
     * (non-PHPdoc)
     * @see FusionChartAbstract::getXML()
     */
    public function getXML()
    {
        $xmlChart  = "<chart " . $this->getAsXMLAttributes($this->attribute) . " > " . implode(' ', $this->sets) .  " </chart>";

        return $xmlChart;
    }
}
