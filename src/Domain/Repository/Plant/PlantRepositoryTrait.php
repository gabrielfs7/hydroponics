<?php

namespace GSoares\Hydroponics\Domain\Repository\Plant;

trait PlantRepositoryTrait
{
    /** @var  PlantRepository */
    private $plantRepository;

    public function getPlantRepository(): PlantRepository
    {
        return $this->plantRepository;
    }

    public function setPlantRepository(PlantRepository $plantRepository): self
    {
        $this->plantRepository = $plantRepository;

        return $this;
    }
}
