<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

use stdClass;

class ResourceAttributesDto implements ResourceAttributesDtoInterface
{
    /** @return stdClass[] */
    public function getAttributes(): array
    {
        $attributes = [];

        foreach ($this as $property => $value) {
            $attributes[$property] = $value;
        }

        return (object) $attributes;
    }
}
