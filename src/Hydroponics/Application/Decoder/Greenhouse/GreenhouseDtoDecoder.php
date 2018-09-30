<?php

namespace GSoares\Hydroponics\Application\Decoder\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class GreenhouseDtoDecoder extends AbstractDtoDecoder
{

    /**
     * @return string
     */
    protected function getResourceType()
    {
        return 'greenhouse';
    }
}
