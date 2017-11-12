<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

class ResourceAttributesDto implements ResourceAttributesDtoInterface
{

    /**
     * @return \stdClass
     */
    public function getAttributes()
    {
        $attributes = [];
        
        foreach ($this as $property => $value) {
            $attributes[$property] = $value;
        }

        return (object) $attributes;
    }
}