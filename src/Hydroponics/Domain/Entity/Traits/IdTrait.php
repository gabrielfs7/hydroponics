<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

trait IdTrait
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
