<?php

namespace GSoares\Hydroponics\Domain\Factory;

interface FactoryInterface
{

    /**
     * @param \ArrayAccess $parameters
     * @return object
     */
    public function make(\ArrayAccess $parameters);
}
