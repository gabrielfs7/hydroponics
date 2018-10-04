<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Tank;

trait TankTrait
{
    /** @var Tank */
    protected $tank;

    public function getTank(): Tank
    {
        return $this->tank;
    }
}
