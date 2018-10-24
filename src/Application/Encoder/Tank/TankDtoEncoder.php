<?php

namespace GSoares\Hydroponics\Application\Encoder\Tank;

use GSoares\Hydroponics\Application\Dto\Tank\TankAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;

class TankDtoEncoder implements EncoderInterface
{

    /**
     * @param object $object
     * @return ResourceDtoInterface
     */
    public function encode($object)
    {
        $attributes = new TankAttributesDto();
        $attributes->name = $object->getName();
        $attributes->description = $object->getDescription();
        $attributes->volumeCapacity = $object->getVolumeCapacity();
        $attributes->createdAt = $object->getCreatedAt()->format(DATE_ATOM);

        $dto = new ResourceDto(
            $object->getId(),
            'tanks',
            $attributes,
            new ResourceLinksDto('', ''),
            [],
            []
        );

        return $dto;
    }
}
