<?php

namespace GSoares\Hydroponics\Application\Dto\Response;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface;

class ResponseDto implements ResponseDtoInterface
{
    /** @var ResourceLinksDtoInterface */
    public $links;

    /** @var object|array */
    public $data;

    public function __construct(ResourceLinksDtoInterface $links, mixed $data)
    {
        $this->links = $links;
        $this->data = $data;
    }

    public function getLinks(): ResourceLinksDtoInterface
    {
        return $this->links;
    }

    /** @return object|array */
    public function getData(): mixed
    {
        return $this->data;
    }
}
