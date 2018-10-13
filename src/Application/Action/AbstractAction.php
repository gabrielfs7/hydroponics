<?php

namespace GSoares\Hydroponics\Application\Action;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Exception\Http\HttpException;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceDeleterInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceSearcherInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;

abstract class AbstractAction
{
    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response = $response->withAddedHeader('Content-type', 'application/json');

        try {
            $response->getBody()->write(json_encode($this->process($request, $response, $args)));
        } catch (HttpException $httpException) {
            $response = $response->withStatus($httpException->getStatusCode());
            $response->getBody()->write(json_encode($httpException->getErrorCollection()));
        }

        return $response;
    }

    abstract protected function process(
        RequestInterface $request,
        ResponseInterface $response,
        array $args
    ): ResponseDtoInterface;

    protected function post(
        ResourceCreatorInterface $resourceCreator,
        RequestInterface $request
    ): ResponseDtoInterface
    {
        return $resourceCreator->create((string) $request->getBody());
    }

    protected function patch(
        ResourceUpdaterInterface $resourceUpdater,
        RequestInterface $request
    ): ResponseDtoInterface
    {
        return $resourceUpdater->update(
            (string) $request->getBody(),
            $this->getRequestParameter($request, 'id')
        );
    }

    protected function delete(
        ResourceDeleterInterface $resourceDeleter,
        RequestInterface $request
    ): ResponseDtoInterface
    {
        return $resourceDeleter->delete($this->getRequestParameter($request, 'id'));
    }

    protected function get(
        ResourceSearcherInterface $resourceSearcher,
        RequestInterface $request
    ): ResponseDtoInterface
    {
        return $resourceSearcher->searchById($this->getRequestParameter($request, 'id'));
    }

    protected function getAll(
        ResourceSearcherInterface $resourceSearcher,
        RequestInterface $request
    ): ResponseDtoInterface
    {
        return $resourceSearcher->search($this->getRequestParameters($request));
    }

    private function getRequestParameter(
        RequestInterface $request,
        string $parameter
    ): string
    {
        /** @var Request $request */
        return $request->getAttribute($parameter);
    }

    private function getRequestParameters(RequestInterface $request): array
    {
        /** @var Request $request */
        return $request->getQueryParams();
    }
}