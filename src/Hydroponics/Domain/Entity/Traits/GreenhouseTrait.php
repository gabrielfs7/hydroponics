<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;

trait GreenhouseTrait
{

    /**
     * @var Greenhouse
     */
    protected $greenhouse;

    /**
     * @return Greenhouse
     */
    public function getGreenhouse()
    {
        return $this->greenhouse;
    }
}
