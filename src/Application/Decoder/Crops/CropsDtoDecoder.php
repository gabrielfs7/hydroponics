<?php

namespace GSoares\Hydroponics\Application\Decoder\Crops;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class CropsDtoDecoder extends AbstractDtoDecoder
{
    protected function getResourceType(): string
    {
        return 'crops';
    }
}
