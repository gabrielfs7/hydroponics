<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

class ResourceLinksDto implements ResourceLinksDtoInterface
{

    /**
     * @var string
     */
    public $self;

    /**
     * @var string
     */
    public $related;

    public function __construct($self, $related)
    {
        $this->self = $self;
        $this->related = $related;
    }

    /**
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * @return string
     */
    public function getRelated()
    {
        return $this->related;
    }
}
