<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class ListGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCanListGreenhouses() : void
    {
        $entity1 = $this->createFixture(
            Greenhouse::class,
                [
                    'name' => 'ABC',
                    'description' => 'I am 1',
                ]
            );

        $entity2 = $this->createFixture(
                Greenhouse::class,
                [
                    'name' => 'DEF',
                    'description' => 'I am 2',
                ]
            );

        $this->runApp(
            'GET',
            '/api/greenhouses'
        );

        $expectedResponse = ResponseMock::getPaginationResponse(
            [
                'meta.totalEntries' => 2,
                'data' => [
                    GreenhouseMock::getGreenhousePaginationResponseBody($entity1),
                    GreenhouseMock::getGreenhousePaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
