<?php

namespace GSoares\Hydroponics\Application\Service;

use GSoares\Hydroponics\Domain\Factory\Greenhouse\GreenhouseFactory;
use GSoares\Hydroponics\Infrastructure\Transport\ParameterBag;

class Creator
{

    /**
     * @var ParameterBag
     */
    private $parameterBag;

    /**
     * @var GreenhouseFactory
     */
    private $greenhouseFactory;

    public function __construct(ParameterBag $parameterBag, GreenhouseFactory $greenhouseFactory)
    {
        $this->parameterBag = $parameterBag;
        $this->greenhouseFactory = $greenhouseFactory;
    }

    public function create(array $data)
    {
        $name = $this->parameterBag->get('greenhouse_name');

        $this->greenhouseFactory->make($name);
    }
}