<?php

namespace GSoares\Hydroponics\Application\Decoder\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class GreenhouseDtoDecoder extends AbstractDtoDecoder
{
    protected function getResourceType(): string
    {
        return 'greenhouse';
    }
}
