<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crops;

use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropsMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class GetCropsActionTest extends WebTestCase
{
    /** @var CropsRepository */
    private $cropsRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropsRepository = $this->getContainer()
            ->get(CropsRepository::class);
    }

    public function testCanGetCropsWhenProvidingExistentId() : void
    {
        /** @var Crops $entity */
        $entity = $this->createFixture(Crops::class);

        $this->runApp(
            'GET',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops/%s',
                $entity->getSystem()->getGreenhouse()->getId(),
                $entity->getSystem()->getId(),
                $entity->getId()
            )
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropsMock::getResponseBody($entity));
    }

    public function testCannotGetCropsWhenProvidingNoExistentId() : void
    {
        /** @var System $system */
        $system = $this->createFixture(System::class);

        $this->runApp(
            'GET',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops/%s',
                $system->getGreenhouse()->getId(),
                $system->getId(),
                999
            )
        );

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
    }
}
