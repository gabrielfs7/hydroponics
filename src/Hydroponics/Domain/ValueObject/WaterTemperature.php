<?php

namespace GSoares\Hydroponics\Domain\ValueObject;


class WaterTemperature
{

    /**
     * @var float
     */
    private $temperature;

    /**
     * @var float
     */
    private $maxTemperature;

    /**
     * @var float
     */
    private $minTemperature;

    public function __construct($temperature, $maxTemperature, $minTemperature)
    {
        $this->temperature = $temperature;
        $this->maxTemperature = $maxTemperature;
        $this->minTemperature = $minTemperature;
    }

    /**
     * @return float
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @return float
     */
    public function getMaxTemperature()
    {
        return $this->maxTemperature;
    }

    /**
     * @return float
     */
    public function getMinTemperature()
    {
        return $this->minTemperature;
    }
}
