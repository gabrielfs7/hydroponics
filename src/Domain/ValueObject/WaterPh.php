<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

class WaterPh
{
    /** @var float */
    private $ph;

    /** @var float */
    private $maxPh;

    /** @var float */
    private $minPh;

    public function __construct(float $ph, float $maxPh, float $minPh)
    {
        $this->ph = $ph;
        $this->maxPh = $maxPh;
        $this->minPh = $minPh;
    }

    public function getPh(): float
    {
        return $this->ph;
    }

    public function getMaxPh(): float
    {
        return $this->maxPh;
    }

    public function getMinPh(): float
    {
        return $this->minPh;
    }
}
