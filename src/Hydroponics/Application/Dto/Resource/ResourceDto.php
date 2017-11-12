<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

class ResourceDto implements ResourceDtoInterface
{

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDtoInterface
     */
    public $attributes;

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Resource\ResourceRelationshipDtoInterface[]
     */
    public $relationships;

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface
     */
    public $links;

    /**
     * @var array
     */
    public $meta;

    public function __construct(
        $id,
        $type,
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

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDtoInterface
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return \GSoares\Hydroponics\Application\Dto\Resource\ResourceRelationshipDtoInterface[]
     */
    public function getRelationships()
    {
        return $this->relationships;
    }

    /**
     * @return \GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }
}
