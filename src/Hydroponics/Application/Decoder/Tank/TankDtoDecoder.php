<?php

namespace GSoares\Hydroponics\Application\Decoder\Tank;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class TankDtoDecoder extends AbstractDtoDecoder
{

    /**
     * @return string
     */
    protected function getResourceType()
    {
        return 'tank';
    }
}