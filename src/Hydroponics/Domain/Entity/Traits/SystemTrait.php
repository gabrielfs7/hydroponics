<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\System;

trait SystemTrait
{

    /**
     * @var System
     */
    protected $system;

    /**
     * @return System
     */
    public function getSystem()
    {
        return $this->system;
    }
}
