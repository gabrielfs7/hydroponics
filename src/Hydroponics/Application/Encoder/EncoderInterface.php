<?php

namespace GSoares\Hydroponics\Application\Encoder;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;

interface EncoderInterface
{

    /**
     * @param object $object
     * @return ResourceDtoInterface
     */
    public function encode($object);
}