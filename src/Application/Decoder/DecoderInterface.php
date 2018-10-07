<?php

namespace GSoares\Hydroponics\Application\Decoder;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;

interface DecoderInterface
{
    public function decode(string $json): ResourceDtoInterface;
}
