<?php

namespace GSoares\Hydroponics\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use GSoares\Hydroponics\Domain\Entity\Traits\GreenhouseTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\TankVersionsTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;

class Tank
{
    use IdTrait;
    use NameTrait;
    use DescriptionTrait;
    use ModifiedAtTrait;
    use GreenhouseTrait;
    use TankVersionsTrait;

    /** @var float */
    private $volumeCapacity;

    /** @var NutritionalFormula */
    private $nutritionalFormula;

    public function __construct(string $name, float $volumeCapacity)
    {
        $this->name = $name;
        $this->volumeCapacity = $volumeCapacity;
        $this->tankVersions = new ArrayCollection();
    }

    public function getVolumeCapacity(): float
    {
        return $this->volumeCapacity;
    }

    public function changeNutritionalFormula(NutritionalFormula $nutritionalFormula): self
    {
        $this->nutritionalFormula = $nutritionalFormula;

        return $this;
    }

    public function getNutritionalFormula(): ?NutritionalFormula
    {
        return $this->nutritionalFormula;
    }
}
