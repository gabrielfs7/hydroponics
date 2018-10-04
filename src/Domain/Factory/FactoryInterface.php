<?php

namespace GSoares\Hydroponics\Domain\Factory;

interface FactoryInterface
{
    public function make(\ArrayAccess $parameters);
}
