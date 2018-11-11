<?php

namespace GSoares\Hydroponics\Application\Encoder\Crop;

use GSoares\Hydroponics\Application\Dto\Crop\CropAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Entity\Crop;

class CropDtoEncoder implements EncoderInterface
{
    public function encode(object $object): ResourceDtoInterface
    {
        /** @var Crop $object */
        $attributes = new CropAttributesDto();
        $attributes->name = $object->getName();
        $attributes->quantity = $object->getQuantity();
        $attributes->harvestedAt = $object->getHarvestedAt() ? $object->getHarvestedAt()->format(DATE_ATOM) : null;
        $attributes->quantityHarvested = $object->getQuantityHarvested();
        $attributes->quantityLost = $object->getQuantityLost();
        $attributes->createdAt = $object->getCreatedAt()->format(DATE_ATOM);

        $dto = new ResourceDto(
            $object->getId(),
            'crops',
            $attributes,
            new ResourceLinksDto('', ''),
            [],
            []
        );

        return $dto;
    }
}
