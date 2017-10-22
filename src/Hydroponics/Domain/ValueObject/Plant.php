<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;

class Plant
{
    use IdTrait;
    use NameTrait;

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
