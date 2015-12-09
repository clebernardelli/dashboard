<?php

/**
 * Abstract class to create tag
 * @version 2.0
 * @package Tag
 * @author Lucas de Oliveira
 * @copyright 2014 - 2015 Lucas de Oliveira
 */
abstract class FusionCharts_Tag_Abstract
{
    /**
     * @var array
     */
    protected $attributes = array();

    /**
     * @param string $name
     * @param number $value
     * @return FusionCharts_Tag_Abstract
     */
    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getXMLAttributes()
    {
        $attributes = array();
        foreach ($this->attributes as $key => $attribute) {
            $attributes[] = $key . "=" . "'" . $attribute . "'";
        }

        return implode(' ', $attributes);
    }

    /**
     * @return string
     */
    abstract public function getXML();
}
