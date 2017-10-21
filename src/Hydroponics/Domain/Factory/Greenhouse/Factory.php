<?php

namespace GSoares\Hydroponics\Domain\Factory\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;

class Factory
{

    public function make($name)
    {
        $greenhouse = new Greenhouse($name);

        return $greenhouse;
    }
}
