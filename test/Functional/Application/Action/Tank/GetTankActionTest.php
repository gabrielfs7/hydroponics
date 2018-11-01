<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Tank;

use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\ResponseMock;
use GSoares\Hydroponics\Test\Mock\TankMock;

class GetTankActionTest extends WebTestCase
{
    /** @var TankRepository */
    private $tankRepository;

    public function setUp()
    {
        parent::setUp();

        $this->tankRepository = $this->getContainer()
            ->get(TankRepository::class);
    }

    public function testCanGetTankWhenProvidingExistentId() : void
    {
        /** @var Tank $entity */
        $entity = $this->createFixture(Tank::class);

        $this->runApp('GET', '/api/tanks/1');

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(TankMock::getResponseBody($entity));
    }

    public function testCannotGetTankWhenProvidingNoExistentId() : void
    {
        $this->runApp('GET', '/api/tanks/2');

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
    }
}
