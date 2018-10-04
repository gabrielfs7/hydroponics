<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;

trait GreenhouseTrait
{
    /** @var Greenhouse */
    protected $greenhouse;

    public function getGreenhouse(): Greenhouse
    {
        return $this->greenhouse;
    }
}
