<?php

namespace GSoares\Hydroponics\Domain\ValueObject;


class WaterPh
{

    /**
     * @var float
     */
    private $ph;

    /**
     * @var float
     */
    private $maxPh;

    /**
     * @var float
     */
    private $minPh;

    public function __construct($ph, $maxPh, $minPh)
    {
        $this->ph = $ph;
        $this->maxPh = $maxPh;
        $this->minPh = $minPh;
    }

    /**
     * @return float
     */
    public function getPh()
    {
        return $this->ph;
    }

    /**
     * @return float
     */
    public function getMaxPh()
    {
        return $this->maxPh;
    }

    /**
     * @return float
     */
    public function getMinPh()
    {
        return $this->minPh;
    }
}
