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
        $greenhouse = $this->createFixture(Greenhouse::class);
        $tank = $this->createFixture(Tank::class);

        $this->assertCount(0, $this->systemRepository->findAll());

        $this->runApp(
            'POST',
            sprintf('/api/greenhouses/%s/systems', $greenhouse->getId()),
            SystemMock::getPostRequestBody($tank->getId())
        );

        $entity = $this->systemRepository
            ->findOne();

        // {"links":{"self":"","related":""},"data":{"id":"1","type":"system","attributes":{"name":"Name test","description":"Description test","createdAt":"2018-10-28T19:04:49+00:00"},"relationships":[],"links":{"self":"","related":""},"meta":[]}}

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
        $this->assertNotNull($entity);
    }
}
