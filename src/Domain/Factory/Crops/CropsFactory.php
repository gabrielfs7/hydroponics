<?php

namespace GSoares\Hydroponics\Domain\Factory\Crops;

use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class CropsFactory
{
    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function make(string $name, System $system, Plant $plant): Crops
    {
        $domainObject = new Crops($name, $system, $plant);
        $domainObject->changeCreatedAt($this->dateTimeProvider->current());

        return $domainObject;
    }
}
