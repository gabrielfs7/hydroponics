<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use DateTime;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;

class UpdateSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCanUpdateSystemWhenProvidingExistentId() : void
    {
        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        /** @var Tank $tank */
        $tank = $this->createFixture(Tank::class);

        /** @var System $entity */
        $entity = $this->createFixture(System::class);

        $this->assertNull($entity->getUpdatedAt());

        $this->runApp(
            'PATCH',
            sprintf(
                '/api/greenhouses/%s/systems/%s',
                $greenhouse->getId(),
                $entity->getId()
            ),
            SystemMock::getPatchRequestBody(
                [
                    'name' => 'DEF',
                    'description' => 'Updated',
                    'greenhouseId' => $greenhouse->getId(),
                    'tankId' => $tank->getId()
                ]
            )
        );

        /** @var System $entity */
        $entity = $this->systemRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertEquals('DEF', $entity->getName());
        $this->assertEquals('Updated', $entity->getDescription());
        $this->assertInstanceOf(DateTime::class, $entity->getUpdatedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
    }
}
