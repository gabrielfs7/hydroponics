<?php

namespace GSoares\Hydroponics\Domain\Factory\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class GreenhouseFactory implements FactoryInterface
{

    /**
     * @var DateTimeProvider
     */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    /**
     * @param \ArrayAccess $parameters
     * @return object
     */
    public function make(\ArrayAccess $parameters)
    {
        $greenhouse = new Greenhouse($parameters->offsetGet('name'));
        $greenhouse->changeCreatedAt($this->dateTimeProvider->current());

        return $greenhouse;
    }
}