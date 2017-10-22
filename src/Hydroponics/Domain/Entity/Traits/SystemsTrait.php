<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

trait SystemsTrait
{

    /**
     * @var \ArrayObject
     */
    protected $systems;

    /**
     * @return \ArrayAccess
     */
    public function getSystems()
    {
        return $this->systems;
    }
}
