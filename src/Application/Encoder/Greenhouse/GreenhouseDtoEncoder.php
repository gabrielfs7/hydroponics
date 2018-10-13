<?php

namespace GSoares\Hydroponics\Application\Encoder\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;

class GreenhouseDtoEncoder implements EncoderInterface
{
    public function encode(object $object): ResourceDtoInterface
    {
        $attributes = new GreenhouseAttributesDto();
        $attributes->name = $object->getName();
        $attributes->description = $object->getDescription();
        $attributes->createdAt = $object->getCreatedAt()->format(DATE_ATOM);

        $dto = new ResourceDto(
            $object->getId(),
            'greenhouse',
            $attributes,
            new ResourceLinksDto('', ''),
            [],
            []
        );

        return $dto;
    }
}
