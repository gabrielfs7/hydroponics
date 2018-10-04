<?php

namespace GSoares\Hydroponics\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use GSoares\Hydroponics\Domain\Entity\Traits\SystemsTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\DescriptionTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\NameTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;

class Greenhouse
{
    use IdTrait;
    use NameTrait;
    use DescriptionTrait;
    use SystemsTrait;
    use ModifiedAtTrait;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->systems = new ArrayCollection();
    }
}
