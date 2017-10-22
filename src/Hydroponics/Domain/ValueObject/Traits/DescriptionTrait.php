<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

trait DescriptionTrait
{

    /**
     * @var string
     */
    protected $description;

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function changeDescription($description)
    {
        $this->description = $description;
    }
}
