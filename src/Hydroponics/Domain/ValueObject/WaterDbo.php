<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

class WaterDbo
{

    /**
     * @var float
     */
    private $dbo;

    /**
     * @var float
     */
    private $maxDbo;

    /**
     * @var float
     */
    private $minDbo;

    public function __construct($dbo, $maxDbo, $minDbo)
    {
        $this->dbo = $dbo;
        $this->maxDbo = $maxDbo;
        $this->minDbo = $minDbo;
    }

    /**
     * @return float
     */
    public function getDbo()
    {
        return $this->dbo;
    }

    /**
     * @return float
     */
    public function getMaxDbo()
    {
        return $this->maxDbo;
    }

    /**
     * @return float
     */
    public function getMinDbo()
    {
        return $this->minDbo;
    }
}
