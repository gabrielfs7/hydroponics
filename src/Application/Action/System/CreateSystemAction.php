<?php

namespace GSoares\Hydroponics\Application\Action\System;

use GSoares\Hydroponics\Application\Action\AbstractAction;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class CreateSystemAction extends AbstractAction
{
    /** @var ResourceCreatorInterface */
    private $resourceCreator;

    public function __construct(ResourceCreatorInterface $resourceCreator)
    {
        $this->resourceCreator = $resourceCreator;
    }

    protected function process(RequestInterface $request, ResponseInterface $response, array $args): ResponseDtoInterface
    {
        return $this->post($this->resourceCreator, $request);
    }
}
