<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class GetGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCanGetGreenhouseWhenProvidingExistentId() : void
    {
        $entity = $this->createFixture(Greenhouse::class);

        $this->runApp('GET', '/api/greenhouses/1');

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getGreenhouseResponseBody($entity));
    }

    public function testCannotGetGreenhouseWhenProvidingNoExistentId() : void
    {
        $this->runApp('GET', '/api/greenhouses/2');

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
    }
}
