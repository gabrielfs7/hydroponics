<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;

class CreateGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCreateAGreenhouseWhenProvidingCorrectRequest() : void
    {
        /** @var Greenhouse $entity */
        $entity = $this->greenhouseRepository
            ->findOne();

        $this->assertNull($entity);

        $this->runApp(
            'POST',
            '/api/greenhouses',
            GreenhouseMock::getPostRequestBody()
        );

        /** @var Greenhouse $entity */
        $entity = $this->greenhouseRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getResponseBody($entity));
    }
}
