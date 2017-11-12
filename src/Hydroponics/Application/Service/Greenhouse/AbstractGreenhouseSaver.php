<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Factory\Greenhouse\GreenhouseFactory;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

abstract class AbstractGreenhouseSaver
{

    /**
     * @var DecoderInterface
     */
    private $greenhouseDecoder;

    /**
     * @var DecoderInterface
     */
    private $greenhouseEncoder;

    /**
     * @var GreenhouseAttributesFiller
     */
    private $greenhouseAttributesFiller;

    /**
     * @var GreenhouseFactory
     */
    protected $greenhouseFactory;

    /**
     * @var RepositoryInterface
     */
    protected $greenhouseRepository;

    public function __construct(
        DecoderInterface $greenhouseDecoder,
        EncoderInterface $greenhouseEncoder,
        GreenhouseFactory $greenhouseFactory,
        RepositoryInterface $greenhouseRepository,
        GreenhouseAttributesFiller $greenhouseAttributesFiller
    ) {
        $this->greenhouseDecoder = $greenhouseDecoder;
        $this->greenhouseEncoder = $greenhouseEncoder;
        $this->greenhouseFactory = $greenhouseFactory;
        $this->greenhouseRepository = $greenhouseRepository;
        $this->greenhouseAttributesFiller = $greenhouseAttributesFiller;
    }

    /**
     * @param Greenhouse $greenhouse
     * @param GreenhouseDto $greenhouseDto
     */
    protected function fillAttributes(Greenhouse $greenhouse, GreenhouseDto $greenhouseDto)
    {
        $this->greenhouseAttributesFiller
            ->fillAttributes($greenhouse, $greenhouseDto);
    }

    /**
     * @param $json
     * @return GreenhouseDto
     */
    protected function decodeJson($json)
    {
        return $this->greenhouseDecoder
            ->decode($json);
    }

    /**
     * @param Greenhouse $greenhouse
     * @return ResponseDto
     */
    protected function createResponseDto(Greenhouse $greenhouse)
    {
        $responseDto = new ResponseDto();
        $responseDto->data = $this->greenhouseEncoder
            ->encode($greenhouse);

        return $responseDto;
    }
}