<?php

namespace GSoares\Hydroponics\Domain\Factory\Crop;

use ArrayAccess;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class CropFactory implements FactoryInterface
{
    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function make(ArrayAccess $parameters): Crop
    {
        $domainObject = new Crop(
            $parameters->offsetGet('name'),
            $parameters->offsetGet('quantity'),
            $parameters->offsetGet('system'),
            $parameters->offsetGet('plant')
        );
        $domainObject->changeCreatedAt($this->dateTimeProvider->current());

        return $domainObject;
    }
}
