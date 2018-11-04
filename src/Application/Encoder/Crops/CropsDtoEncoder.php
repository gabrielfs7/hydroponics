<?php

namespace GSoares\Hydroponics\Application\Encoder\Crops;

use GSoares\Hydroponics\Application\Dto\Crops\CropsAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Entity\Crops;

class CropsDtoEncoder implements EncoderInterface
{
    public function encode(object $object): ResourceDtoInterface
    {
        /** @var Crops $object */
        $attributes = new CropsAttributesDto();
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
