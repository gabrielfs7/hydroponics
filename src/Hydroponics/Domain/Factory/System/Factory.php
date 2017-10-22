<?php

namespace GSoares\Hydroponics\Domain\Factory\System;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
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

    public function make($name, Greenhouse $greenhouse, Tank $tank)
    {
        $greenhouse = new System($name, $greenhouse, $tank);
        $greenhouse->changeCreatedAt($this->dateTimeProvider->current());

        return $greenhouse;
    }
}
