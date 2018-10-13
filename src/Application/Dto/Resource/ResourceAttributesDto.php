<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

use stdClass;

class ResourceAttributesDto implements ResourceAttributesDtoInterface
{
    public function getAttributes(): stdClass
    {
        $attributes = [];

        foreach ($this as $property => $value) {
            $attributes[$property] = $value;
        }

        return (object) $attributes;
    }
}
