<?php

namespace GSoares\Hydroponics\Domain\Factory\Plant;

use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class PlantFactory implements FactoryInterface
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
        $domainObject = new Plant(
            $parameters->offsetGet('name'),
            $parameters->offsetGet('species')
        );
        $domainObject->changeCreatedAt($this->dateTimeProvider->current());

        return $domainObject;
    }
}
