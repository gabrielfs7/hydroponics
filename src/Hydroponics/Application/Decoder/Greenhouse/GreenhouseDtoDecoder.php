<?php

namespace GSoares\Hydroponics\Application\Decoder\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;
use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseDto;

class GreenhouseDtoDecoder extends AbstractDtoDecoder
{

    /**
     * @return GreenhouseDto
     */
    protected function getDtoInstance()
    {
        return new GreenhouseDto();
    }
}