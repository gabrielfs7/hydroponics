<?php

namespace GSoares\Hydroponics\Application\Action\Crops;

use GSoares\Hydroponics\Application\Action\AbstractAction;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class UpdateCropsAction extends AbstractAction
{
    /** @var ResourceUpdaterInterface */
    private $resourceUpdater;

    public function __construct(ResourceUpdaterInterface $resourceUpdater)
    {
        $this->resourceUpdater = $resourceUpdater;
    }

    protected function process(
        RequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseDtoInterface {
        return $this->patch($this->resourceUpdater, $request);
    }
}
