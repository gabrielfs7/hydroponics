<?php

namespace GSoares\Hydroponics\Domain\Factory\Crops;

use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\ValueObject\Plant;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class Factory
{

    /**
     * @var DateTimeProvider
     */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function make($name, System $system, Plant $plant)
    {
        $crops = new Crops($name, $system, $plant);
        $crops->changeCreatedAt($this->dateTimeProvider->current());

        return $crops;
    }
}
