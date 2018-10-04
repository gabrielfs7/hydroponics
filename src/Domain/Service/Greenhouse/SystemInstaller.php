<?php

namespace GSoares\Hydroponics\Domain\Service\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;

class SystemInstaller
{

    /**
     * @param Greenhouse $greenhouse
     * @param System $system
     * @return Greenhouse
     */
    public function install(Greenhouse $greenhouse, System $system)
    {
        return $system;
    }
}
