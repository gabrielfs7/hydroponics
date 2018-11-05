<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\System;

trait SystemTrait
{
    /** @var System */
    protected $system;

    public function getSystem(): System
    {
        return $this->system;
    }

    public function changeSystem(System $system): self
    {
        $this->system = $system;

        return $this;
    }
}
