<?php

namespace GSoares\Hydroponics\Domain\Factory\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
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

    public function make($name)
    {
        $greenhouse = new Greenhouse($name);
        $greenhouse->changeCreatedAt($this->dateTimeProvider->current());

        return $greenhouse;
    }
}
