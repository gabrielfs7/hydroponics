<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

class RelationshipDto implements ResourceRelationshipDtoInterface
{
    /** @var string */
    public $type;

    /** @var string */
    public $id;

    public function __construct(string $id, string $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
