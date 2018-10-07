<?php

namespace GSoares\Hydroponics\Application\Decoder\System;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class SystemDtoDecoder extends AbstractDtoDecoder
{
    protected function getResourceType(): string
    {
        return 'system';
    }
}
