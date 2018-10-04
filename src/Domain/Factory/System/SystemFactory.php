<?php

namespace GSoares\Hydroponics\Domain\Factory\System;

use ArrayAccess;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class SystemFactory implements FactoryInterface
{
    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function make(ArrayAccess $parameters): System
    {
        $domainObject = new System(
            $parameters->offsetGet('name'),
            $parameters->offsetGet('greenhouse'),
            $parameters->offsetGet('tank')
        );
        $domainObject->changeCreatedAt($this->dateTimeProvider->current());

        return $domainObject;
    }
}
