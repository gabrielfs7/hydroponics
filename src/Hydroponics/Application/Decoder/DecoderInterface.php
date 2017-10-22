<?php

namespace GSoares\Hydroponics\Application\Decoder;

interface DecoderInterface
{

    /**
     * @param string $json
     * @return object
     */
    public function decode($json);
}