<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Crop;

use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Crop\CropRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\CropMock;

class CreateCropActionTest extends WebTestCase
{
    /** @var CropRepository */
    private $cropRepository;

    public function setUp()
    {
        parent::setUp();

        $this->cropRepository = $this->getContainer()
            ->get(CropRepository::class);
    }

    public function testCreateASystemWhenProvidingCorrectRequest() : void
    {
        /** @var Plant $plant */
        $plant = $this->createFixture(Plant::class);

        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        /** @var System $system */
        $system = $this->createFixture(System::class);

        $this->assertCount(0, $this->cropRepository->findAll());

        $this->runApp(
            'POST',
            sprintf(
                '/api/greenhouses/%s/systems/%s/crops',
                $greenhouse->getId(),
                $system->getId()
            ),
            CropMock::getPostRequestBody($plant->getId())
        );

        /** @var Crop $entity */
        $entity = $this->cropRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(CropMock::getResponseBody($entity));
    }
}
