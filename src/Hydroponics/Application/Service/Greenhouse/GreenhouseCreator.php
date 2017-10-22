<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Factory\Greenhouse\GreenhouseFactory;
use GSoares\Hydroponics\Domain\Service\Greenhouse\GreenhouseCreator as DomainGreenhouseCreator;

class GreenhouseCreator
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
     * @var GreenhouseFactory
     */
    private $greenhouseFactory;

    /**
     * @var DomainGreenhouseCreator
     */
    private $domainGreenhouseCreator;

    public function __construct(
        DecoderInterface $greenhouseDecoder,
        EncoderInterface $greenhouseEncoder,
        GreenhouseFactory $greenhouseFactory,
        DomainGreenhouseCreator $domainGreenhouseCreator
    ) {
        $this->greenhouseDecoder = $greenhouseDecoder;
        $this->greenhouseEncoder = $greenhouseEncoder;
        $this->greenhouseFactory = $greenhouseFactory;
        $this->domainGreenhouseCreator = $domainGreenhouseCreator;
    }

    /**
     * @param $json
     * @return string
     */
    public function create($json)
    {
        $greenhouseDto = $this->greenhouseDecoder
            ->decode($json);

        $greenhouse = $this->greenhouseFactory
            ->make($greenhouseDto->name);

        $greenhouse = $this->domainGreenhouseCreator
            ->create($greenhouse);

        return $this->greenhouseEncoder
            ->encode($greenhouse);
    }
}