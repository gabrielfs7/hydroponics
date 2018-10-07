<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\GreenhouseTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\TankVersionsTrait;
use GSoares\Hydroponics\Domain\ValueObject\NutritionalFormula;
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

    public function __construct(string $name, float $volumeCapacity, NutritionalFormula $nutritionalFormula = null)
    {
        $this->name = $name;
        $this->volumeCapacity = $volumeCapacity;
        $this->nutritionalFormula = $nutritionalFormula;
    }

    public function getVolumeCapacity(): float
    {
        return $this->volumeCapacity;
    }

    public function getNutritionalFormula(): NutritionalFormula
    {
        return $this->nutritionalFormula;
    }
}
