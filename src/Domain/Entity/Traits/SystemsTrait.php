<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use ArrayAccess;

trait SystemsTrait
{
    /** @var ArrayAccess */
    protected $systems;

    public function getSystems(): ?ArrayAccess
    {
        return $this->systems;
    }
}
