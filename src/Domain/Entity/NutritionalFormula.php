<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;

class NutritionalFormula
{
    use IdTrait;
    use NameTrait;
    use DescriptionTrait;

    public function __construct(string $name)
    {
        $this->changeName($name);
    }
}
