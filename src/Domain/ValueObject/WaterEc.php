<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

class WaterEc
{
    /** @var float */
    private $ec;

    /** @var float */
    private $maxEc;

    /** @var float */
    private $minEc;

    public function __construct(float $ec, float $maxEc, float $minEc)
    {
        $this->ec = $ec;
        $this->maxEc = $maxEc;
        $this->minEc = $minEc;
    }

    public function getEc(): float
    {
        return $this->ec;
    }

    public function getMinEc(): float
    {
        return $this->minEc;
    }

    public function getMaxEc(): float
    {
        return $this->maxEc;
    }
}
