<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

class ResourceLinksDto implements ResourceLinksDtoInterface
{
    /** @var string */
    public $self;

    /** @var string */
    public $related;

    public function __construct(string $self, string $related)
    {
        $this->self = $self;
        $this->related = $related;
    }

    public function getSelf(): string
    {
        return $this->self;
    }

    public function getRelated(): string
    {
        return $this->related;
    }
}
