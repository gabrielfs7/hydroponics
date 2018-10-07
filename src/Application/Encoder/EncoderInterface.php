<?php

namespace GSoares\Hydroponics\Application\Encoder;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;

interface EncoderInterface
{
    public function encode(object $object): ResourceDtoInterface;
}
