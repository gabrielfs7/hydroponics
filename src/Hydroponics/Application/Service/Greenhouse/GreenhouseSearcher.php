<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

class GreenhouseSearcher
{

    /**
     * @var DecoderInterface
     */
    private $greenhouseEncoder;

    /**
     * @var RepositoryInterface
     */
    private $greenhouseRepository;

    public function __construct(
        EncoderInterface $greenhouseEncoder,
        RepositoryInterface $greenhouseRepository
    ) {
        $this->greenhouseEncoder = $greenhouseEncoder;
        $this->greenhouseRepository = $greenhouseRepository;
    }

    /**
     * @param array $parameters
     * @return ResponseDto
     */
    public function search(array $parameters)
    {
        foreach ($parameters as $parameterName => $parameterValue) {
            $this->greenhouseRepository
                ->addFilter($parameterName, $parameterValue);
        }

        $greenhouses = $this->greenhouseRepository
            ->findAll();

        $greenhousesDto = [];

        foreach ($greenhouses as $greenhouse) {
            $greenhousesDto[] = $this->greenhouseEncoder
                ->encode($greenhouse);
        }

        $responseDto = new ResponseDto();
        $responseDto->data = $greenhousesDto;

        return $responseDto;
    }

    /**
     * @param int $greenhouseId
     * @return ResponseDto
     */
    public function searchById($greenhouseId)
    {
        $greenhouse = $this->greenhouseRepository
            ->addFilter('id', $greenhouseId)
            ->findOne();

        $greenhouseDto = $this->greenhouseEncoder
            ->encode($greenhouse);

        $responseDto = new ResponseDto();
        $responseDto->data = $greenhouseDto;

        return $responseDto;
    }
}