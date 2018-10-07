<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

class WaterVolume
{
    /** @var float */
    private $currentVolume;

    /** @var float */
    private $minVolume;

    public function __construct(float $currentVolume, float $minVolume)
    {
        $this->currentVolume = $currentVolume;
        $this->minVolume = $minVolume;
    }

    public function getCurrentVolume(): float
    {
        return $this->currentVolume;
    }

    public function getMinVolume(): float
    {
        return $this->minVolume;
    }
}
