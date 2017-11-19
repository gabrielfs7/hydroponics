<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\CropsTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;

class Plant
{
    use IdTrait;
    use NameTrait;
    use ModifiedAtTrait;
    use CropsTrait;

    /**
     * @var string
     */
    private $species;

    public function __construct($name, $species)
    {
        $this->name = $name;
        $this->species = $species;
    }

    /**
     * @return string
     */
    public function getSpecies()
    {
        return $this->species;
    }
}
