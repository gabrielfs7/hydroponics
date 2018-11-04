<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crops;

use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropsMock;

class CreateCropsActionTest extends WebTestCase
{
    /** @var CropsRepository */
    private $cropsRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropsRepository = $this->getContainer()
            ->get(CropsRepository::class);
    }

    public function testCreateASystemWhenProvidingCorrectRequest() : void
    {
        /** @var Plant $plant */
        $plant = $this->createFixture(Plant::class);

        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        /** @var System $system */
        $system = $this->createFixture(System::class);

        $this->assertCount(0, $this->cropsRepository->findAll());

        $this->runApp(
            'POST',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops',
                $greenhouse->getId(),
                $system->getId()
            ),
            CropsMock::getPostRequestBody($plant->getId())
        );

        /** @var Crops $entity */
        $entity = $this->cropsRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropsMock::getResponseBody($entity));
        $this->assertNotNull($entity);
    }
}
