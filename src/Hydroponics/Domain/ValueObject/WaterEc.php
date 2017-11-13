<?php

namespace GSoares\Hydroponics\Domain\ValueObject;


class WaterEc
{

    /**
     * @var float
     */
    private $ec;

    /**
     * @var float
     */
    private $maxEc;

    /**
     * @var float
     */
    private $minEc;

    public function __construct($ec, $maxEc, $minEc)
    {
        $this->ec = $ec;
        $this->maxEc = $maxEc;
        $this->minEc = $minEc;
    }

    /**
     * @return float
     */
    public function getEc()
    {
        return $this->ec;
    }

    /**
     * @return float
     */
    public function getMaxEc()
    {
        return $this->maxEc;
    }

    /**
     * @return float
     */
    public function getMinEc()
    {
        return $this->minEc;
    }
}
