<?php

namespace GSoares\Hydroponics\Application\Decoder\Crop;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class CropDtoDecoder extends AbstractDtoDecoder
{
    protected function getResourceType(): string
    {
        return 'crops';
    }
}
