<?php

namespace GSoares\Hydroponics\Application\Encoder\System;

use GSoares\Hydroponics\Application\Dto\System\SystemAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;

class SystemDtoEncoder implements EncoderInterface
{

    /**
     * @param object $object
     * @return ResourceDtoInterface
     */
    public function encode($object)
    {
        $attributes = new SystemAttributesDto();
        $attributes->name = $object->getName();
        $attributes->description = $object->getDescription();
        $attributes->createdAt = $object->getCreatedAt()->format('Y-m-d\TH:i:s');

        $dto = new ResourceDto(
            $object->getId(),
            'system',
            $attributes,
            new ResourceLinksDto('', ''),
            [],
            []
        );

        return $dto;
    }
}
