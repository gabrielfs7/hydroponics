<?php

namespace GSoares\Hydroponics\Application\Decoder\Tank;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class TankDtoDecoder extends AbstractDtoDecoder
{
    protected function getResourceType(): string
    {
        return 'tank';
    }
}
