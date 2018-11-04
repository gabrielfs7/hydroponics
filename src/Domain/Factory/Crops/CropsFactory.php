<?php

namespace GSoares\Hydroponics\Domain\Factory\Crops;

use ArrayAccess;
use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class CropsFactory implements FactoryInterface
{
    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function make(ArrayAccess $parameters): Crops
    {
        $domainObject = new Crops(
            $parameters->offsetGet('name'),
            $parameters->offsetGet('quantity'),
            $parameters->offsetGet('system'),
            $parameters->offsetGet('plant')
        );
        $domainObject->changeCreatedAt($this->dateTimeProvider->current());

        return $domainObject;
    }
}
