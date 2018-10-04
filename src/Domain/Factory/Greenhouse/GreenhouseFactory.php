<?php

namespace GSoares\Hydroponics\Domain\Factory\Greenhouse;

use ArrayAccess;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class GreenhouseFactory implements FactoryInterface
{
    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function make(ArrayAccess $parameters): Greenhouse
    {
        $domainObject = new Greenhouse($parameters->offsetGet('name'));
        $domainObject->changeCreatedAt($this->dateTimeProvider->current());

        return $domainObject;
    }
}
