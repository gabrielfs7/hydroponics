<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

trait DescriptionTrait
{
    /** @var string */
    protected $description;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function changeDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
