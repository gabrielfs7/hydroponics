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
        /** @var Tank $entity1 */
        $entity1 = $this->createFixture(Tank::class);

        /** @var Tank $entity2 */
        $entity2 = $this->createFixture(Tank::class);

        $this->runApp('GET', '/api/tanks');

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
