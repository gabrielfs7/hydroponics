<?php

namespace GSoares\Hydroponics\Application\Dto\Response;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface;

class ResponseDto implements ResponseDtoInterface
{
    /** @var ResourceLinksDtoInterface */
    public $links;

    /** @var object|array */
    public $data;

    public function __construct(ResourceLinksDtoInterface $links, $data)
    {
        $this->links = $links;
        $this->data = $data;
    }

    public function getMeta(): ?array
    {
        return $this->{'meta'};
    }

    public function changeMeta(array $meta)
    {
        $this->{'meta'} = $meta;

        return $this;
    }

    public function getLinks(): ResourceLinksDtoInterface
    {
        return $this->links;
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}
