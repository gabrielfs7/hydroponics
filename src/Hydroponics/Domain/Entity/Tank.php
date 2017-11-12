<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\GreenhouseTrait;
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

    /**
     * @var float
     */
    private $volumeCapacity;

    /**
     * @var NutritionalFormula
     */
    private $nutritionalFormula;

    public function __construct($name, $volumeCapacity, NutritionalFormula $nutritionalFormula = null)
    {
        $this->name = $name;
        $this->volumeCapacity = $volumeCapacity;
        $this->nutritionalFormula = $nutritionalFormula;
    }

    /**
     * @return float
     */
    public function getVolumeCapacity()
    {
        return $this->volumeCapacity;
    }

    /**
     * @return NutritionalFormula
     */
    public function getNutritionalFormula()
    {
        return $this->nutritionalFormula;
    }
}
