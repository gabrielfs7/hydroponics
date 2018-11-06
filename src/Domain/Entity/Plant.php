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

    /** @var string */
    private $species;

    public function __construct(string $name, string $species)
    {
        $this->name = $name;
        $this->species = $species;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function changeSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
    }
}
