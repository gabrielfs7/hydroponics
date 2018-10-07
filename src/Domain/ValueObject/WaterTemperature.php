<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

class WaterTemperature
{
    /** @var float */
    private $temperature;

    /** @var float */
    private $maxTemperature;

    /** @var float */
    private $minTemperature;

    public function __construct(float $temperature, float $maxTemperature, float $minTemperature)
    {
        $this->temperature = $temperature;
        $this->maxTemperature = $maxTemperature;
        $this->minTemperature = $minTemperature;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getMaxTemperature(): float
    {
        return $this->maxTemperature;
    }

    public function getMinTemperature(): float
    {
        return $this->minTemperature;
    }
}
