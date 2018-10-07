<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\GreenhouseTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\TankTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;

class System
{
    use IdTrait;
    use NameTrait;
    use DescriptionTrait;
    use ModifiedAtTrait;
    use GreenhouseTrait;
    use TankTrait;

    /** @var Tank */
    private $tank;

    public function __construct(string $name, Greenhouse $greenhouse, Tank $tank)
    {
        $this->changeName($name);
        $this->greenhouse = $greenhouse;
        $this->tank = $tank;
    }
}
