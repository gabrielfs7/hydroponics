<?php

namespace GSoares\Hydroponics\Application\Action\System;

use GSoares\Hydroponics\Application\Action\AbstractAction;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceDeleterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class DeleteSystemAction extends AbstractAction
{
    /** @var ResourceDeleterInterface */
    private $resourceDeleter;

    public function __construct(ResourceDeleterInterface $resourceDeleter)
    {
        $this->resourceDeleter = $resourceDeleter;
    }

    protected function process(RequestInterface $request, ResponseInterface $response, array $args): ResponseDtoInterface
    {
        return $this->delete($this->resourceDeleter, $request);
    }
}
