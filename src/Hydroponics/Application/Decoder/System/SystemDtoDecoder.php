<?php

namespace GSoares\Hydroponics\Application\Decoder\System;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class SystemDtoDecoder extends AbstractDtoDecoder
{

    /**
     * @return string
     */
    protected function getResourceType()
    {
        return 'system';
    }
}
