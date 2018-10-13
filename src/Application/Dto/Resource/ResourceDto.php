<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceRelationshipDtoInterface;
use stdClass;

class ResourceDto implements ResourceDtoInterface
{

    /** @var string */
    public $id;

    /** @var string */
    public $type;

    /** @var ResourceAttributesDtoInterface */
    public $attributes;

    /** @var ResourceRelationshipDtoInterface[] */
    public $relationships;

    /** @var ResourceLinksDtoInterface */
    public $links;

    /** @var array */
    public $meta;

    public function __construct(
        string $id,
        string $type,
        ResourceAttributesDtoInterface $attributes,
        ResourceLinksDtoInterface $links,
        array $relationships,
        array $meta
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->attributes = $attributes;
        $this->links = $links;
        $this->relationships = $relationships;
        $this->meta = $meta;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAttributes(): stdClass
    {
        return $this->attributes;
    }

    public function getAttributeValue(string $name): ?string
    {
        if (property_exists($this->attributes, $name)) {
            return $this->attributes->{$name};
        }
    }

    /** @return ResourceRelationshipDtoInterface[] */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    public function getLinks(): ResourceLinksDtoInterface
    {
        return $this->links;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }
}
