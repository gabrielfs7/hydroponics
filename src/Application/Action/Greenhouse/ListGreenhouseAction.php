<?php

namespace GSoares\Hydroponics\Application\Action\Greenhouse;

use GSoares\Hydroponics\Application\Action\AbstractAction;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceSearcherInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ListGreenhouseAction extends AbstractAction
{
    /** @var ResourceSearcherInterface */
    private $resourceSearcher;

    public function __construct(ResourceSearcherInterface $resourceSearcher)
    {
        $this->resourceSearcher = $resourceSearcher;
    }

    protected function process(
        RequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseDtoInterface {
        return $this->getAll($this->resourceSearcher, $request);
    }
}
