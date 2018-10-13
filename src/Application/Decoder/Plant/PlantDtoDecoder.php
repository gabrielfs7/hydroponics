<?php

namespace GSoares\Hydroponics\Application\Decoder\Plant;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class PlantDtoDecoder extends AbstractDtoDecoder
{
    protected function getResourceType(): string
    {
        return 'plants';
    }
}
