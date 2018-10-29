<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Tank;

use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\ResponseMock;
use GSoares\Hydroponics\Test\Mock\TankMock;

class ListTankActionTest extends WebTestCase
{
    /** @var TankRepository */
    private $tankRepository;

    public function setUp()
    {
        parent::setUp();

        $this->tankRepository = $this->getContainer()
            ->get(TankRepository::class);
    }

    public function testCanListTanks() : void
    {
        $entity1 = $this->createFixture(
            Tank::class,
                [
                    'name' => 'ABC',
                    'description' => 'I am 1',
                ]
            );

        $entity2 = $this->createFixture(
                Tank::class,
                [
                    'name' => 'DEF',
                    'description' => 'I am 2',
                ]
            );

        $respose = $this->runApp(
            'GET',
            '/api/tanks'
        );

        $expectedResponse = ResponseMock::getPaginationResponse(
            [
                'meta.totalEntries' => 2,
                'data' => [
                    TankMock::getPaginationResponseBody($entity1),
                    TankMock::getPaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
