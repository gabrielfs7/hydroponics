<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

trait NameTrait
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
