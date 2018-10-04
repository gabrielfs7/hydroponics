<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use ArrayAccess;

trait TankVersionsTrait
{
    /** @var ArrayAccess */
    protected $tankVersions;

    public function getTankVersions(): ArrayAccess
    {
        return $this->tankVersions;
    }
}
