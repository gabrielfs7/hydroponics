<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\IdTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\NameTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\SystemsTrait;

class Greenhouse
{
    use IdTrait;
    use NameTrait;
    use SystemsTrait;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
