<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Tank;

trait TankTrait
{

    /**
     * @var Tank
     */
    protected $tank;

    /**
     * @return Tank
     */
    public function getTank()
    {
        return $this->tank;
    }
}
