<?php

namespace GSoares\Hydroponics\Application\Encoder;

interface EncoderInterface
{

    /**
     * @param object $object
     * @return string
     */
    public function encode($object);
}