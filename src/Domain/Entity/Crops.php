<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\PlantTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\SystemTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;

class Crops
{
    use IdTrait;
    use NameTrait;
    use ModifiedAtTrait;
    use SystemTrait;
    use PlantTrait;

    /** @var int */
    private $quantity;

    public function __construct(string $name, System $system, Plant $plant)
    {
        $this->name = $name;
        $this->system = $system;
        $this->plant = $plant;
        $this->quantity = 0;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function changeQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}