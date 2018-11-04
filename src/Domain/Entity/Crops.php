<?php

namespace GSoares\Hydroponics\Domain\Entity;

use DateTimeInterface;
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
    private $quantityHarvested;

    /** @var int */
    private $quantityLost;

    /** @var  DateTimeInterface */
    private $harvestedAt;

    public function __construct(string $name, int $quantity, System $system, Plant $plant)
    {
        $this->name = $name;
        $this->system = $system;
        $this->plant = $plant;
        $this->quantity = $quantity;
        $this->quantityHarvested = 0;
        $this->quantityLost = 0;
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

    public function getQuantityHarvested(): int
    {
        return $this->quantityHarvested;
    }

    public function changeQuantityHarvested(int $quantityHarvested): self
    {
        $this->quantityHarvested = $quantityHarvested;

        return $this;
    }

    public function getQuantityLost(): int
    {
        return $this->quantityLost;
    }

    public function changeQuantityLost(int $quantityLost): self
    {
        $this->quantityLost = $quantityLost;

        return $this;
    }

    public function getHarvestedAt(): ?DateTimeInterface
    {
        return $this->harvestedAt;
    }

    public function changeHarvestedAt(DateTimeInterface $harvestedAt): self
    {
        $this->harvestedAt = $harvestedAt;

        return $this;
    }
}
