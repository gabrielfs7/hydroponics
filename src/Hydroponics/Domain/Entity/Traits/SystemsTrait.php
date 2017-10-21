<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\System;

trait SystemsTrait
{

    /**
     * @var \ArrayObject
     */
    protected $systems;

    /**
     * @param System $system
     * @return \ArrayObject
     */
    public function addSystem(System $system)
    {
        $this->systems
            ->append($system);

        return $this->systems;
    }

    /**
     * @return \ArrayAccess
     */
    public function getSystems()
    {
        return $this->systems;
    }
}
