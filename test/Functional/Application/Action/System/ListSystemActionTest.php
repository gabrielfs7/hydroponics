<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
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
        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        /** @var System $entity1 */
        $entity1 = $this->createFixture(System::class);

        /** @var System $entity2 */
        $entity2 = $this->createFixture(System::class);

        $this->runApp(
            'GET',
            sprintf('/api/greenhouses/%s/systems', $greenhouse->getId())
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
