<?php

namespace GSoares\Hydroponics\Application\Controller\Api;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Dto\Response\SingleResponseDto;
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
    public function get(Request $request)
    {
        $greenhouse = $this->container
            ->get('repository.greenhouse')
            ->addFilter('id', $request->get('id'))
            ->findOne();

        $greenhouseDto = $this->container
            ->get('application.encoder.greenhouse.greenhouse_dto_encoder')
            ->encode($greenhouse);

        return new JsonResponse(['data' => $greenhouseDto]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        $greenhouses = $this->container
            ->get('repository.greenhouse')
            ->findAll();

        $encoder = $this->container
            ->get('application.encoder.greenhouse.greenhouse_dto_encoder');

        $greenhousesDto = [];

        foreach ($greenhouses as $greenhouse) {
            $greenhousesDto[] = $encoder->encode($greenhouse);
        }

        $responseDto = new ResponseDto();
        $responseDto->data = $greenhousesDto;

        return new JsonResponse($responseDto);
    }
}
