<?php

namespace GSoares\Hydroponics\Application\Encoder\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseAttributesDto;
use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseDto;
use GSoares\Hydroponics\Application\Dto\Link\LinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;

class GreenhouseDtoEncoder implements EncoderInterface
{

    /**
     * @param object $object
     * @return GreenhouseDto
     */
    public function encode($object)
    {
        $dto = new GreenhouseDto();
        $dto->id = $object->getId();

        $dto->attributes = new GreenhouseAttributesDto();
        $dto->attributes->name = $object->getName();
        $dto->attributes->createdAt = $object->getCreatedAt()->format('Y-m-d\TH:i:s');

        $dto->links = new LinksDto();

        return $dto;
    }
}
