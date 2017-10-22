<?php

namespace GSoares\Hydroponics\Application\Encoder\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseDto;

class GreenhouseDtoEncoder implements DecoderInterface
{

    /**
     * @param object $object
     * @return GreenhouseDto
     */
    public function decode($object)
    {
        $dto = new GreenhouseDto();
        $dto->name = $object->getName();

        return $dto;
    }
}