<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

trait TankVersionsTrait
{

    /**
     * @var \ArrayObject
     */
    protected $tankVersions;

    /**
     * @return \ArrayAccess
     */
    public function getTankVersions()
    {
        return $this->tankVersions;
    }
}
