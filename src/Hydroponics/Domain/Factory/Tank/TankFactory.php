<?php

namespace GSoares\Hydroponics\Domain\Factory\Tank;

use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class TankFactory implements FactoryInterface
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
        $domainObject = new Tank(
            $parameters->offsetGet('name'),
            $parameters->offsetGet('volumeCapacity')
        );
        $domainObject->changeCreatedAt($this->dateTimeProvider->current());

        return $domainObject;
    }
}
