<?php

namespace GSoares\Hydroponics\Application\Dto\Response;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface;

class ResponseDto implements ResponseDtoInterface
{

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface
     */
    public $links;

    /**
     * @var object|array
     */
    public $data;

    public function __construct(ResourceLinksDtoInterface $links, $data)
    {
        $this->links = $links;
        $this->data = $data;
    }

    /**
     * @return \GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @return object|array
     */
    public function getData()
    {
        return $this->data;
    }
}
