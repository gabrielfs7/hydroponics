<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class GetSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCanGetSystemWhenProvidingExistentId() : void
    {
        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        /** @var System $entity */
        $entity = $this->createFixture(System::class);

        $this->runApp(
            'GET',
            sprintf(
                '/api/greenhouses/%s/systems/%s',
                $greenhouse->getId(),
                $entity->getId()
            )
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
    }

    public function testCannotGetSystemWhenProvidingNoExistentId() : void
    {
        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        $this->runApp(
            'GET',
            sprintf('/api/greenhouses/%s/systems/2', $greenhouse->getId())
        );

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
    }
}
