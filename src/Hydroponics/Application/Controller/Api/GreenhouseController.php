<?php

namespace GSoares\Hydroponics\Application\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class GreenhouseController extends AbstractController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function patch(Request $request)
    {
        $dto = $this->container
            ->get('application.service.greenhouse.greenhouse_updater')
            ->update($request->getContent(), $request->get('id'));

        return new JsonResponse($dto);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request)
    {
        $dto = $this->container
            ->get('application.service.greenhouse.greenhouse_creator')
            ->create($request->getContent());

        return new JsonResponse($dto);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $this->container
            ->get('domain.service.greenhouse.greenhouse_deleter')
            ->delete($request->get('id'));

        return new JsonResponse();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request)
    {
        $responseDto = $this->container
            ->get('application.service.greenhouse.greenhouse_searcher')
            ->searchById($request->get('id'));

        return new JsonResponse($responseDto);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        $responseDto = $this->container
            ->get('application.service.greenhouse.greenhouse_searcher')
            ->search($request->query->all());

        return new JsonResponse($responseDto);
    }
}
