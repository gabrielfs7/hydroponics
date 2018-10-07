<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

class WaterDbo
{
    /** @var float */
    private $dbo;

    /** @var float */
    private $maxDbo;

    /** @var float */
    private $minDbo;

    public function __construct(float $dbo, float $maxDbo, float $minDbo)
    {
        $this->dbo = $dbo;
        $this->maxDbo = $maxDbo;
        $this->minDbo = $minDbo;
    }

    public function getDbo(): float
    {
        return $this->dbo;
    }

    public function getMaxDbo(): float
    {
        return $this->maxDbo;
    }

    public function getMinDbo(): float
    {
        return $this->minDbo;
    }
}
