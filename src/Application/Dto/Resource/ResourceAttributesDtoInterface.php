<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

use stdClass;

interface ResourceAttributesDtoInterface
{
    /** @return stdClass[] */
    public function getAttributes(): array;
}
