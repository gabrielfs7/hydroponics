<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;

class CreateSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCreateASystemWhenProvidingCorrectRequest() : void
    {
        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        /** @var Tank $tank */
        $tank = $this->createFixture(Tank::class);

        $this->assertCount(0, $this->systemRepository->findAll());

        $this->runApp(
            'POST',
            sprintf('/api/greenhouses/%s/systems', $greenhouse->getId()),
            SystemMock::getPostRequestBody($tank->getId())
        );

        /** @var System $entity */
        $entity = $this->systemRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
        $this->assertNotNull($entity);
    }
}
