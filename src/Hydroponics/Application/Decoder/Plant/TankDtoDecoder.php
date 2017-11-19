<?php

namespace GSoares\Hydroponics\Application\Decoder\Plant;

use GSoares\Hydroponics\Application\Decoder\AbstractDtoDecoder;

class PlantsDtoDecoder extends AbstractDtoDecoder
{

    /**
     * @return string
     */
    protected function getResourceType()
    {
        return 'plants';
    }
}