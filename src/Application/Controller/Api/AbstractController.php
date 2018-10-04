<?php

namespace GSoares\Hydroponics\Application\Controller\Api;

use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceDeleterInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceSearcherInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class AbstractController implements ControllerInterface
{
    use ContainerAwareTrait;

    /**
     * @var ResourceCreatorInterface
     */
    private $resourceCreator;

    /**
     * @var ResourceUpdaterInterface
     */
    private $resourceUpdater;

    /**
     * @var ResourceSearcherInterface
     */
    private $resourceSearcher;

    /**
     * @var ResourceDeleterInterface
     */
    private $resourceDeleter;

    public function __construct(
        ResourceCreatorInterface $resourceCreator,
        ResourceUpdaterInterface $resourceUpdater,
        ResourceSearcherInterface $resourceSearcher,
        ResourceDeleterInterface $resourceDeleter
    ) {
        $this->resourceCreator = $resourceCreator;
        $this->resourceUpdater = $resourceUpdater;
        $this->resourceSearcher = $resourceSearcher;
        $this->resourceDeleter = $resourceDeleter;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request)
    {
        $dto = $this->resourceCreator
            ->create($request->getContent());

        return new JsonResponse($dto);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function patch(Request $request)
    {
        $dto = $this->resourceUpdater
            ->update($request->getContent(), $request->get('id'));

        return new JsonResponse($dto);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request)
    {
        $responseDto = $this->resourceSearcher
            ->searchById($request->get('id'));

        return new JsonResponse($responseDto);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        $responseDto = $this->resourceSearcher
            ->search($request->query->all());

        return new JsonResponse($responseDto);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $responseDto = $this->resourceDeleter
            ->delete($request->get('id'));

        return new JsonResponse($responseDto);
    }
}
