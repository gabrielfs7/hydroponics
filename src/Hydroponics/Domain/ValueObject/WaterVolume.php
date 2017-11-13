<?php

namespace GSoares\Hydroponics\Domain\ValueObject;


class WaterVolume
{

    /**
     * @var float
     */
    private $currentVolume;

    /**
     * @var float
     */
    private $minVolume;

    public function __construct($currentVolume, $minVolume)
    {
        $this->currentVolume = $currentVolume;
        $this->minVolume = $minVolume;
    }

    /**
     * @return float
     */
    public function getCurrentVolume()
    {
        return $this->currentVolume;
    }

    /**
     * @return float
     */
    public function getMinVolume()
    {
        return $this->minVolume;
    }
}
