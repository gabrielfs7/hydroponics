<?php

namespace GSoares\Hydroponics\Application\Controller\Api;

use GSoares\Hydroponics\Application\Builder\Error\ErrorCollectionDtoBuilder;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request)
    {
        return $this->getDefaultResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function patch(Request $request)
    {
        return $this->getDefaultResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request)
    {
        return $this->getDefaultResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        return $this->getDefaultResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        return $this->getDefaultResponse();
    }

    /**
     * @return JsonResponse
     */
    protected function getDefaultResponse()
    {
        $errors = $this->getErrorCollectionDtoBuilder()
            ->configCode(404)
            ->configStatus(404)
            ->configTitle('Resource Not Found')
            ->configDetails('Resource Not Found')
            ->configSourcePointer('')
            ->addError()
            ->build();

        return new JsonResponse($errors);
    }

    /**
     * @return ErrorCollectionDtoBuilder
     */
    private function getErrorCollectionDtoBuilder()
    {
         return $this->container
            ->get('application.builder.error.error_collection_dto_builder');
    }
}
