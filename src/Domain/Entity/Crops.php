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

    /** @var int */
    private $totalHarvested;

    /** @var int */
    private $totalLost;

    public function __construct(string $name, int $quantity, System $system, Plant $plant)
    {
        $this->name = $name;
        $this->system = $system;
        $this->plant = $plant;
        $this->quantity = $quantity;
        $this->totalHarvested = 0;
        $this->totalLost = 0;
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

    public function getTotalHarvested(): int
    {
        return $this->totalHarvested;
    }

    public function changeTotalHarvested(int $totalHarvested): self
    {
        $this->totalHarvested = $totalHarvested;

        return $this;
    }

    public function getTotalLost(): int
    {
        return $this->totalLost;
    }

    public function changeTotalLost(int $totalLost): self
    {
        $this->totalLost = $totalLost;

        return $this;
    }
}
