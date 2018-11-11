<?php

namespace GSoares\Hydroponics\Domain\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use GSoares\Hydroponics\Domain\Entity\Traits\CropVersionsTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\PlantTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;

class Crop
{
    use IdTrait;
    use NameTrait;
    use ModifiedAtTrait;
    use PlantTrait;
    use CropVersionsTrait;

    /** @var int */
    private $quantity;

    public function __construct(string $name, int $quantity, Plant $plant)
    {
        $this->name = $name;
        $this->plant = $plant;
        $this->quantity = $quantity;
        $this->cropVersions = new ArrayCollection();
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

    public function getHarvestedAt(): ?DateTimeInterface
    {
        foreach (array_reverse($this->cropVersions->getKeys()) as $key) {
            /** @var CropVersion $cropVersion */
            $cropVersion = $this->cropVersions->offsetGet($key);

            if ($cropVersion->getQuantityHarvested() > 0) {
                return $cropVersion->getCreatedAt();
            }
        }

        return null;
    }

    public function getQuantityHarvested(): int
    {
        $total = 0;

        /** @var CropVersion $cropVersion */
        foreach ($this->cropVersions as $cropVersion) {
            $total += $cropVersion->getQuantityHarvested();
        }

        return $total;
    }

    public function getQuantityLost(): int
    {
        $total = 0;

        /** @var CropVersion $cropVersion */
        foreach ($this->cropVersions as $cropVersion) {
            $total += $cropVersion->getQuantityLost();
        }

        return $total;
    }
}
