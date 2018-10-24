<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class ListSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCanListSystems() : void
    {
        $entity1 = $this->createFixture(
            System::class,
                [
                    'name' => 'ABC',
                    'description' => 'I am 1',
                ]
            );

        $entity2 = $this->createFixture(
                System::class,
                [
                    'name' => 'DEF',
                    'description' => 'I am 2',
                ]
            );

        $this->runApp(
            'GET',
            '/api/systems'
        );

        $expectedResponse = ResponseMock::getPaginationResponse(
            [
                'meta.totalEntries' => 2,
                'data' => [
                    SystemMock::getPaginationResponseBody($entity1),
                    SystemMock::getPaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
