<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\SystemsTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;

class Greenhouse
{
    use IdTrait;
    use NameTrait;
    use SystemsTrait;
    use ModifiedAtTrait;

    public function __construct($name)
    {
        $this->name = $name;
        $this->systems = new \ArrayObject();
    }
}
