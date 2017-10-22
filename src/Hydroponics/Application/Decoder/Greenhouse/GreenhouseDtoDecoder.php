<?php

namespace GSoares\Hydroponics\Application\Decoder\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseDto;

class GreenhouseDtoDecoder implements DecoderInterface
{

    /**
     * @param string $json
     * @return GreenhouseDto
     */
    public function decode($json)
    {
        $stdClass = json_decode($json);

        $dto = new GreenhouseDto();
        $dto->name = $stdClass->name;

        return $dto;
    }
}