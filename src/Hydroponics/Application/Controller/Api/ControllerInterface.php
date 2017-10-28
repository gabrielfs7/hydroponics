<?php

namespace GSoares\Hydroponics\Application\Controller\Api;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
interface ControllerInterface extends ContainerAwareInterface
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function put(Request $request);

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function post(Request $request);

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function get(Request $request);

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request);
}
