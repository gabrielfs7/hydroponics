<?php

namespace GSoares\Hydroponics\Domain\Factory;

use ArrayAccess;

interface FactoryInterface
{
    public function make(ArrayAccess $parameters);
}
