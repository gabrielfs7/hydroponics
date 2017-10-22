<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\GreenhouseTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;

class System
{
    use IdTrait;
    use NameTrait;
    use GreenhouseTrait;

    public function __construct($name, Greenhouse $greenhouse)
    {
        $this->name = $name;
        $this->greenhouse = $greenhouse;
    }
}
