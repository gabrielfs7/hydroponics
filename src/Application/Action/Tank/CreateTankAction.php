<?php

namespace GSoares\Hydroponics\Application\Action\Tank;

use GSoares\Hydroponics\Application\Action\AbstractAction;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class CreateTankAction extends AbstractAction
{
    /** @var ResourceCreatorInterface */
    private $resourceCreator;

    public function __construct(ResourceCreatorInterface $resourceCreator)
    {
        $this->resourceCreator = $resourceCreator;
    }

    protected function process(
        RequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseDtoInterface {
        return $this->post($this->resourceCreator, $request);
    }
}
