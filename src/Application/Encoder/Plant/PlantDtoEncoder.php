<?php

namespace GSoares\Hydroponics\Application\Encoder\Plant;

use GSoares\Hydroponics\Application\Dto\Plant\PlantAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;

class PlantDtoEncoder implements EncoderInterface
{
    public function encode(object $object): ResourceDtoInterface
    {
        $attributes = new PlantAttributesDto();
        $attributes->name = $object->getName();
        $attributes->species = $object->getSpecies();
        $attributes->createdAt = $object->getCreatedAt()->format(DATE_ATOM);

        $dto = new ResourceDto(
            $object->getId(),
            'plants',
            $attributes,
            new ResourceLinksDto('', ''),
            [],
            []
        );

        return $dto;
    }
}
