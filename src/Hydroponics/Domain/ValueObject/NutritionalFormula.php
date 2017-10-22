<?php

namespace GSoares\Hydroponics\Domain\ValueObject;

use GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;

class NutritionalFormula
{
    use IdTrait;
    use NameTrait;
    use DescriptionTrait;

    public function __construct($name)
    {
        $this->name = $name;
    }
}
